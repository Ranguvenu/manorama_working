<?php

namespace App\Services\PageComponents;

use App\Http\Resources\Services\PageComponents\CertificateCoursesResource;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Hierarchy;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CertificateCoursesComponent
{
    public function index(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 4;

        $packages = Packages::whereIn('id', $request->get('ids'))->active()->latest()->take($limit)->get();

        return CertificateCoursesResource::collection($packages);
    }

    public function create(Request $request)
    {
        $goals = [];

        if ($request->get('goal')) {
            $goal = Hierarchy::find($request->get('goal'));
            $goals = Collection::wrap($goal)->toArray();
        }

        return response()->json([
            'goals' => $goals,
        ], 200);
    }
}
