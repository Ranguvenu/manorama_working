<?php

namespace App\Services\PageComponents;

use App\Models\Ecommerce\Packages;
use Illuminate\Http\Request;

class MCLandingBannerComponent
{
    public function index(Request $request)
    {
    }

    public function show(Request $request)
    {
        $package = Packages::find($request->get('package'));
        $pricing = $package->pricing()->first();

        return [
            'rating' => round($package->average_rating(), 1),
            'pricing' => $pricing,
        ];
    }
}
