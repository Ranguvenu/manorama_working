<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\InternalStaff\CreateRequest;
use App\Http\Requests\UserManagement\InternalStaff\UpdateRequest;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserManagement\InternalStaffResource;
use App\Models\MasterData\Category;
use App\Models\MasterData\Taxonomy;
use App\Models\User;
use App\Models\UserManagement\Role;
use App\Models\UserManagement\UserMeta;
use App\Services\Moodle\Users as UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->middleware(['role_or_permission:view-staff'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-staff'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-staff'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-staff'])->only('destroy');
    }

    public function index(Category $category, Request $request)
    {
        return Inertia::render('UserManagement/Users/index', ['type' => $category]);
    }

    public function results(Category $category, Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $staff = $category->users()->filterBy($request->all())->latest()->paginate($perpage);
      

        return InternalStaffResource::collection($staff);
    }

    public function create()
    {
        $source = Taxonomy::findOrFail('question_source');
        $caegories = Taxonomy::findOrFail('user_category');

        return response()->json([
            'roles' => Role::all(),
            'others' => [
                'sources' => $source->categories,
                'categories' => $caegories->categories,
            ],
        ], 200);
    }

    public function store(Category $category, CreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['phone_number'] = $request->get('phone')['number'];
            $data['country_code'] = $request->get('phone')['code'];
            $user = $category->users()->create($data);
            $user->assignRole($request->get('roles'));
            foreach ($request->get('metadata') as $key => $value) {
                if ($value) {
                    $user->user_meta()->updateOrCreate([
                        'key' => $key,
                    ], [
                        'value' => $value,
                    ]);
                }
            }

            $sources = $request->get('metadata')['sources'];
            $srccodes = $category->where('taxonomy_slug', 'question_source')->whereIn('id', $sources)->get(['name', 'code'])->toArray();
            $laravelroles = $request->get('roles');
            $mdlroles = [];
            foreach ($laravelroles as $laravelrole) {
                $mdlrole = Role::where('name', $laravelrole)->first();
                if ($mdlrole !== null && $mdlrole->mdlrole != null) {
                    $mdlroles[] = $mdlrole->mdlrole;
                }
            }

            $mdl_id = $this->service->createorupdate_user($request->all(), $srccodes, $mdlroles);
            if (!empty($mdl_id['success'])) {
                $user->mdl_user = $mdl_id['data']['id'];
                $user->save();
                
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Created user',
                ], 200);
            } else {
                DB::rollback();

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create',
                ], 422);
            }
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create',
            ], 422);
        }
    }

    public function edit(Category $category, User $user)
    {
        $usermetadata = [];
        $usermetadata = UserMeta::where('user_id', $user->id)->get();
        foreach ($usermetadata as $metadata) {
            $metainfo[$metadata->key] = $metadata->value;
        }

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'phone' => [
                'number' => $user->phone_number,
                'code' => $user->country_code,
            ],
            'roles' => $user->roles->pluck('name'),
            'metadata' => [
                'sources' => !empty($metainfo['sources']) ? $metainfo['sources'] : [],
                'categories' => !empty($metainfo['categories']) ? $metainfo['categories'] : [],
                'biography' => !empty($metainfo['biography']) ? $metainfo['biography'] : '',
                'address' => !empty($metainfo['address']) ? $metainfo['address'] : '',
                'logo' => !empty($metainfo['logo']) ? $metainfo['logo'] : '',
                'isfeatured' => !empty($metainfo['isfeatured']) ? $metainfo['isfeatured'] : '',
                'profile' => !empty($metainfo['profile']) ? $metainfo['profile'] : '',
                'profileimage' => !empty($metainfo['profileimage']) ? $metainfo['profileimage'] : '',
            ],
        ], 200);
    }

    public function update(Category $category, User $user, UpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['phone_number'] = $request->get('phone')['number'];
            $data['country_code'] = $request->get('phone')['code'];
            $update = $user->update($data);
            $user->assignRole($request->get('roles'));
            foreach ($request->get('metadata') as $key => $value) {
                if ($value) {
                    $user->user_meta()->updateOrCreate([
                        'key' => $key,
                    ], [
                        'value' => !empty($value) ? $value : '',
                    ]);
                }
            }
            $user->syncRoles($request->get('roles'));

            $roles = $request->get('roles');
            $selectedroles = [];
            foreach ($roles as $role) {
                $fields = '';
                switch ($role) {
                    case 'moderator':
                        $fields = ['categories'];
                        break;
                    case 'blog-writer':
                        $fields = ['profile', 'profileimage'];
                        break;
                    case 'expert':
                        $fields = ['categories', 'biography', 'address', 'logo', 'isfeatured', 'profile', 'profileimage'];
                        break;
                    case 'test-center-expert':
                        $fields = ['sources'];
                        break;
                    case 'creator':
                        $fields = ['sources'];
                        break;
                }
                array_push($selectedroles, $fields);
            }
            if (is_array($selectedroles) && is_array($selectedroles[0])) {
                $array = array_filter($selectedroles);
                $metacomponents = array_merge(...$array);
                UserMeta::where('user_id', $user->id)->whereNotIn('key', $metacomponents)->delete();
            }

            $sources = $request->get('metadata')['sources'];
            $srccodes = $category->where('taxonomy_slug', 'question_source')->whereIn('id', $sources)->get(['name', 'code'])->toArray();
            $laravelroles = $request->get('roles');
            $mdlroles = [];
            foreach ($laravelroles as $laravelrole) {
                $mdlrole = Role::where('name', $laravelrole)->first();
                if ($mdlrole !== null && $mdlrole->mdlrole != null) {
                    $mdlroles[] = $mdlrole->mdlrole;
                }
            }
            $mdl_id = $this->service->createorupdate_user($request->all(), $srccodes, $mdlroles);

            if (!empty($mdl_id['success'])) {
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Updated Successfully',
                ], 200);
            } else {
                DB::rollback();

                return response()->json([
                    'success' => true,
                    'message' => 'Failed to Update',
                ], 422);
            }
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update user',
            ], 422);
        }
    }

    public function show(Category $category, User $user)
    {
        return ProfileResource::make($user);
    }

    public function destroy(Category $category, User $user)
    {
        // DB::beginTransaction();
        try {
            $user->is_deleted = true;
            $user->save();
            // $result = $this->service->delete_user($user->name);
            // if ($result) {
            // DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'User deleted',
            ], 200);
            // } else {
            //     // DB::rollback();

            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Failed to delete user',
            //     ], 422);
            // }
        } catch (Exception $e) {
            // DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user',
            ], 422);
        }
    }

    public function reset(User $user, Request $request)
    {
        $request->validate([
            'password' => ['required', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        try {
            $user->password = $request->get('password');
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password reset successful',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reset password',
            ], 422);
        }
    }

    public function users_role(Role $role)
    {
        return response()->json([
            'data' => $role->users,
        ], 200);
    }

    public function activate(Category $category, User $user)
    {
        try {
            $user->is_deleted = 0;
            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'User Activated Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to Activate User',
            ], 422);
        }
    }
}
