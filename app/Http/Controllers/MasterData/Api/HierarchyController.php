<?php

namespace App\Http\Controllers\MasterData\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MasterData\Api\HierarchyResource;
use App\Models\MasterData\Hierarchy;
use Illuminate\Http\Request;

class HierarchyController extends Controller
{
    public function index(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $hierarchy = Hierarchy::filterBy($request->all())->latest()->paginate($perpage);

        return HierarchyResource::collection($hierarchy);
    }
}
