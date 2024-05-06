<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\Pricing\CreateRequest as CreatePricingRequest;
use App\Http\Requests\Ecommerce\Pricing\UpdateRequest as UpdatePricingRequest;
use App\Http\Resources\MasterData\PricingResource;
use App\Models\Ecommerce\PackagePricing;
use App\Models\Ecommerce\Packages;

class PricingController extends Controller
{
    public function index(Packages $package)
    {
        $pricing = $package->pricing()->latest()->get();

        return PricingResource::collection($pricing);
    }

    public function show(PackagePricing $pricing)
    {
        $package = $pricing->package_id;
        $batches = $pricing->courses->map(function ($course) use ($package) {
            return $course->course->activeBatchesInPackage($package);
        })->collapse();

        return [
            'pricing' => $pricing->only(['id', 'selling_price', 'actual_price']),
            'batches' => $batches,
            'has_purchased_variation' => $pricing->hasPurchasedThisVariation(),
        ];
    }

    public function create(Packages $package)
    {
        $courses = $package->courses->map(function ($course) {
            return $course->course;
        });

        return response()->json([
            'courses' => $courses,
        ], 200);
    }

    public function store(Packages $package, CreatePricingRequest $request)
    {
        try {
            // // return $package->pricing;
            // $exists = $package->pricing()->whereHas('courses', function ($query) use ($request) {
            //     $query->whereIn('course_id', $request->get('subjects'));
            // }, '=', count($request->get('subjects')))->exists();

            // return $exists;
            $data = $request->validated();
            if ($data && !$data['selling_price']) {
                $data['selling_price'] = $data['actual_price'];
            }
            $pricing = $package->pricing()->create($data);

            $courses = array_map(function ($course) {
                return ['course_id' => $course];
            }, $request->get('subjects'));

            $pricing->courses()->createUpdateOrDelete($courses);

            return response()->json([
                'success' => true,
                'message' => 'Created Pricing',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e,
                'success' => false,
                'message' => 'Failed to create',
            ], 422);
        }
    }

    public function edit(PackagePricing $pricing)
    {
        return new PricingResource($pricing);
    }

    public function update(UpdatePricingRequest $request)
    {
        try {
            $data = $request->validated();
            if ($data && !$data['selling_price']) {
                $data['selling_price'] = $data['actual_price'];
            }
            $pricing = PackagePricing::updateOrCreate(['id' => $request->get('id')], $data);

            return response()->json([
                'success' => true,
                'message' => 'Pricing Updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Pricing',
            ], 200);
        }
    }

    public function destroy(PackagePricing $pricing)
    {
        try {
            if ($pricing->orders->first()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You already have some orders associated with this pricing and it cannot be deleted',
                ], 200);
            }
            $delete = $pricing->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pricing deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Pricing',
            ], 422);
        }
    }
}
