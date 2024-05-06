<?php

namespace App\Http\Controllers\UserManagement;
use Inertia\Inertia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserManagement\Roles\CreateRequest as CreateRoleRequest;
use App\Http\Requests\UserManagement\Roles\UpdateRequest as UpdateRoleRequest;

use App\Models\UserManagement\Role;
use App\Models\UserManagement\Permission;
use App\Http\Resources\UserManagement\RoleResource;
use App\Http\Resources\UserManagement\PermissionResource;
use App\Services\Moodle\Roles as RolesService;

class RolesController extends Controller
{
    public $service;

    public function __construct() 
    {
        $this->service = new RolesService();
        $this->middleware(['role_or_permission:view-role'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-role'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-role'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-role'])->only('destroy');
    }

    public function index(Request $request){
        return Inertia::render('UserManagement/Roles/index');
    }

    public function results(Request $request){
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $roles = Role::filterBy($request->all())->paginate($perpage);
        return RoleResource::collection($roles);
    }

    public function create(){
        $data = Permission::all();
        $mdlroles = $this->service->get_roles();

        return response()->json([
            "data"  => $data,
            "mdlroles" => $mdlroles,
        ], 200);
    }

    public function store(CreateRoleRequest $request){
        try{
            $role = Role::create([
                'name'          => $request->get('name'),
                'fullname'      => $request->get('fullname'),
                'description'   => $request->get('description'),
                'mdlrole'       => $request->get('mdlrole'),
            ]);
            $role->syncPermissions($request->get('permissions'));
            return response()->json([
                'success'   => true,
                'message'   => 'Role created successfully'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'success'   => false,
                'message'   => 'Failed to create role'
            ], 422);
        }
    }

    public function edit(Role $role) {
        return response()->json([
            'data'  => array(
                'name'          => $role->name,
                'fullname'      => $role->fullname,
                'description'   => $role->description,
                'permissions'   => $role->permissions->pluck('id'),
                'mdlrole'       => $role->mdlrole,
            )
        ], 200);
    }

    public function update(Role $role, UpdateRoleRequest $request) {
        try{
            $role->update($request->validated());
            $role->syncPermissions($request->get('permissions'));
            return response()->json([
                'success'   => true,
                'message'   => 'Role updated successfully'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'success'   => false,
                'message'   => 'Failed to update role'
            ], 200);
        }
    }

    public function destroy(Role $role){
        try{
            $delete = $role->delete();       
            return response()->json([
                'success'   => true,
                'message'   => 'Role deleted successfully'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'success'   => false,
                'message'   => 'Failed to delete role'
            ], 422);
        }
    }
}
