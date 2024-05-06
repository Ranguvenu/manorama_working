<?php

namespace App\Http\Controllers\Modules;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\PackageRating\CreateRequest as CreatePackageRatingRequest;
use App\Http\Requests\Modules\PackageRating\UpdateRequest as UpdatePackageRatingRequest;
use App\Http\Resources\Modules\PackageRatingResource;
use App\Models\Content\Enrollment;
use App\Models\Ecommerce\Packages;
use App\Models\Modules\PackageRating;
use Illuminate\Http\Request;

class PackageRatingController extends Controller
{
    public function store(Packages $package, CreatePackageRatingRequest $request)
    {
        try {
            $create = $package->ratings()->create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Created Package Rating Successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Packages $package)
    {
        $userrating = $package->hasRated();
        $enrolleduser = $package->hasPurchased();
        $allowreview = ($userrating == false) && ($enrolleduser) ? true : false;

        return response()->json([
            'average' => round($package->average_rating(), 1),
            'data' => PackageRatingResource::collection($package->ratings),
            'allowreview' => $allowreview,
        ], 200);
    }

    public function edit(PackageRating $rating, Request $request)
    {
        return response()->json([
            'data' => $rating,
        ], 200);
    }

    public function update(PackageRating $rating, UpdatePackageRatingRequest $request)
    {
        try {
            $update = $rating->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Updated Package Rating Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
