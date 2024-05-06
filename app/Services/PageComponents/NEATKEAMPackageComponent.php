<?php

namespace App\Services\PageComponents;

use App\Models\Ecommerce\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Ecommerce\PackagePricing;
class NEATKEAMPackageComponent
{
    public function index(Request $request)
    {
    }

    public function create(Request $request)
    {
        $packages = [];

        if ($request->get('package')) {
            $package = Packages::find($request->get('package'));
            $packages = Collection::wrap($package)->toArray();
        }

        return response()->json([
            'packages' => $packages,
        ], 200);
    }

    public function show(Request $request)
    {   
        $package = Packages::with('pricing.courses','pricing')->find($request->get('package'));
        

        $courses = $package->courses->map(function ($course) {
            return $course->course;
        });
        $pricings = $package->pricing->groupBy('package_pricing_id')->map(function ($group) {
            return $group->pluck('courses')->flatten()->unique('id')->values();
        })->collapse();


        $pricings = collect($pricings)->groupBy('package_pricing_id')->map(function ($group) {
            return $group->pluck('course_id')->unique()->values()->toArray();
        });


        $array_result = collect($pricings)->map(function ($item, $key) use ($courses) {
            $prices =  PackagePricing::where('id', $key)->get();
           
         
            return array_merge(
                collect($item)->map(function ($id) use ($courses) {
                    return collect($courses)->where('id', $id)->first();
                })->toArray(),
                ['prices' => $prices] 
            );
        })->toArray();

        return response()->json([
            'subject'   => [

            ],
            'package_id' => $package->id,
            'title' => $package->title,
            'is_trial_available' => $package->is_trial_available,
            'has_purchased' => $package->hasPurchased(),
            'has_trial' => $package->hasTrialSubscription(),
            'subjects' => $courses,
            'pricing' => $pricings,
            'batches' => $package->activeBatches(),
            'can_enroll' => $package->isAcceptingEnrolments(),
            'is_published' => $package->is_published,
            'prices'    => $array_result
        ], 200);
    }
}
