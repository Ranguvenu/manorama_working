<?php

namespace App\Services\PageComponents;

use App\Http\Resources\Services\PageComponents\TestimonialsResource;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TestimonialsComponent
{
    public function index(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $testimonials = Testimonial::filterBy($request->all())->paginate($perpage);

        return TestimonialsResource::collection($testimonials);
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
}
