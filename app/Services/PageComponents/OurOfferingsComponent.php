<?php

namespace App\Services\PageComponents;

use App\Http\Resources\Services\PageComponents\OurOfferingsResource;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Hierarchy;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OurOfferingsComponent
{
    public function index(Request $request)
    {
        $response = [];

        if ($request->get('slug')) {

            $limit = $request->get('limit') ? $request->get('limit') : 4;
            $filters = [
                'goal' => $request->get('goal'),
                'timeline' => $request->get('timeline'),
                ];

            $packages = Packages::latest()->filterBy($filters)->take($limit)->get();


            $response = OurOfferingsResource::collection($packages);
        } else {
            $limit = $request->get('limit') ? $request->get('limit') : 10;
            $packages = Packages::latest()->take($limit)->get();
            $response = OurOfferingsResource::collection($packages);
        }

        return response()->json([
            'data' => $response,
        ], 200);
    }

    public function create(Request $request)
    {
        $goaldata = $request->get('goal');
        $goals = [];
        foreach ($goaldata as $goal) {
            if ($goal['goal']) {
                $hierarchy = Hierarchy::find($goal['goal']);
                $goals[] = Collection::wrap($hierarchy)->toArray();
            }
        }

        return response()->json([
            'goals' => $goals,
        ], 200);
    }
}
