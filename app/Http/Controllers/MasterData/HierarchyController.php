<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\Hierarchy\CreateRequest as CreateHierarchyRequest;
use App\Http\Requests\MasterData\Hierarchy\UpdateRequest as UpdateHierarchyRequest;
use App\Http\Resources\MasterData\HierarchyResource;
use App\Models\MasterData\Hierarchy;
use App\Services\Moodle\Hierarchy as HierarchyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HierarchyController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new HierarchyService();
        $this->middleware(['role_or_permission:view-hierarchy'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-hierarchy'])->only('store');
        $this->middleware(['role_or_permission:edit-hierarchy'])->only('update', 'edit');
        $this->middleware(['role_or_permission:delete-hierarchy'])->only('destroy');
    }

    public function index()
    {
        return Inertia::render('MasterData/Hierarchy/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $hierarchy = Hierarchy::onlyGoals()->filterBy($request->all())->paginate($perpage);

        return HierarchyResource::collection($hierarchy);
    }

    public function children(Hierarchy $hierarchy)
    {
        if ($hierarchy->depth == 2) {
            return $hierarchy->children()->where('type_id', 4)->get();
        }

        return $hierarchy->children;
    }

    public function store(CreateHierarchyRequest $request)
    {
        DB::beginTransaction();

        try {
            $hierarchy = Hierarchy::create($request->validated());
            $mdl_id = $this->service->create_hierarchy($hierarchy);

            if ($mdl_id) {
                try {
                    $hierarchy->mdl_id = $mdl_id;
                    $hierarchy->save();

                    DB::commit();

                    return response()->json([
                        'success' => true,
                        'message' => 'Hierarchy created successfully',
                    ], 200);
                } catch (\Exception $e) {
                    DB::rollback();

                    return response()->json([
                        'errors' => $e,
                        'success' => false,
                        'message' => 'Hierarchy Creation Failed',
                    ], 200);
                }
            } else {
                DB::rollback();

                return response()->json([
                    'success' => false,
                    'message' => 'Hierarchy Creation Failed',
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    public function edit(Hierarchy $hierarchy)
    {
        return response()->json([
            'id' => $hierarchy->id,
            'title' => $hierarchy->title,
            'code' => $hierarchy->code,
            'fields' => ($hierarchy->type_id == 4) ? true : false,
            'description' => $hierarchy->description,
            'image' => $hierarchy->type_id,
            'tags' => $hierarchy->tags,
        ], 200);
    }

    public function update(Hierarchy $hierarchy, UpdateHierarchyRequest $request)
    {
        DB::beginTransaction();

        try {
            $hierarchy->update($request->validated());
            $mdl_id = $this->service->create_hierarchy($hierarchy);

            if ($mdl_id) {
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Hierarchy Updated successfully',
                ], 200);
            } else {
                DB::rollback();

                return response()->json([
                    'success' => false,
                    'message' => 'Hierarchy Updation Failed',
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'errors' => $e,
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Hierarchy $hierarchy)
    {
        DB::beginTransaction();

        try {
            $hierarchy->delete();
            $result = $this->service->delete_hierarchy($hierarchy);

            if ($result) {
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Deleted successfully',
                ], 200);
            } else {
                DB::rollback();

                return response()->json([
                    'success' => false,
                    'message' => 'Failed',
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 200);
        }
    }
}
