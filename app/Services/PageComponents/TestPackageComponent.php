<?php

namespace App\Services\PageComponents;

use App\Models\Ecommerce\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TestPackageComponent
{
    public function index(Request $request)
    {
    }

    public function create(Request $request)
    {
        $packages = [];
        if ($request->get('packages')) {
            $package = Packages::find($request->get('packages'));
            $packages = Collection::wrap($package)->toArray(); 
        
        }

        return response()->json([
            'packages' => $packages,
        ], 200);
    }

    public function show(Request $request)
    {
        $package = Packages::with('pricing.courses')->find($request->get('package'));

        $courses = $package->courses->map(function ($course) {
            return $course->course;
        });

        $pricings = $package->pricing->groupBy('package_pricing_id')->map(function ($group) {
            return $group->pluck('courses')->flatten()->unique('id')->values();
        })->collapse();

        $pricings = collect($pricings)->groupBy('package_pricing_id')->map(function ($group) {
            return $group->pluck('course_id')->unique()->values()->toArray();
        });

        return response()->json([
            'package_id' => $package->id,
            'title' => $package->title,
            'subjects' => $courses,
            'is_trial_available' => $package->is_trial_available,
            'has_purchased' => $package->hasPurchased(),
            'has_trial' => $package->hasTrialSubscription(),
            'batches' => $package->activeBatches(),
            'pricing' => $pricings,
            'can_enroll' => $package->isAcceptingEnrolments(),
        ], 200);
    }
}
