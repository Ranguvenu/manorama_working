<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\StudyMaterials\CreateRequest as CreateStudyMaterialsRequest;
use App\Http\Requests\Content\StudyMaterials\UpdateRequest as UpdateStudyMaterialsRequest;
use App\Http\Resources\Content\StudyMaterialResource;
use App\Http\Resources\Content\StudyMaterialsResource;
use App\Meta;
use App\Models\Blog\Author;
use App\Models\Content\StudyMaterial;
use App\Models\MasterData\Hierarchy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudyMaterialsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-studymaterial'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-studymaterial'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-studymaterial'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-studymaterial'])->only('destroy');
    }

    public function index()
    {
        return Inertia::render('Content/StudyMaterials/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $studymaterials = StudyMaterial::filterBy($request->all())->paginate($perpage);

        return StudyMaterialsResource::collection($studymaterials);
    }

    public function show(StudyMaterial $material, Request $request)
    {
        if ($material && $material->seo_configuration) {
            foreach ($material->seo_configuration as $key => $value) {
                if (is_array($value)) {
                    $value = implode(',', $value);
                } else {
                    $value = $value;
                }
                Meta::addMeta($key, $value, $request->fullUrl());
            }
        }

        return Inertia::render('Content/StudyMaterials/view', [
            'material' => new StudyMaterialResource($material),
        ]);
    }

    public function create()
    {
        $authors = Author::get();

        return response()->json([
            'authors' => $authors,
            'goals' => Hierarchy::onlyGoals()->get(),
            'boards' => [],
            'classes' => [],
            'subjects' => [],
        ], 200);
    }

    public function store(CreateStudyMaterialsRequest $request)
    {
        $create = StudyMaterial::create($request->validated());
        try {
            return response()->json([
                'success' => true,
                'message' => 'Created Study  Material successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(StudyMaterial $studymaterial)
    {
        return response()->json([
            'data' => $studymaterial,
        ], 200);
    }

    public function update(StudyMaterial $studymaterial, UpdateStudyMaterialsRequest $request)
    {
        try {
            $update = $studymaterial->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Updated Study Material Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(StudyMaterial $studymaterial)
    {
        try {
            $delete = $studymaterial->delete();

            return response()->json([
                'success' => true,
                'message' => 'Deleted Study Material successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
