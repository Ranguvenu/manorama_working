<?php

namespace App\Services\PageComponents;

use App\Http\Resources\Services\PageComponents\StudyMaterialsResource;
use App\Models\Content\StudyMaterial;
use App\Models\MasterData\Hierarchy;
use Illuminate\Http\Request;

class StudyMaterialsComponent
{
    public function index(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $studymaterials = StudyMaterial::active()->filterBy($request->all())->paginate($perpage);

        return StudyMaterialsResource::collection($studymaterials);
    }

    public function create()
    {
        return response()->json([
            'goals' => Hierarchy::onlyGoals()->get(),
            'boards' => [],
            'classes' => [],
            'subjects' => [],
        ], 200);
    }
}
