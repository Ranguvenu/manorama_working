<?php

namespace App\Services\PageComponents;

use App\Models\Ecommerce\Packages;
use Illuminate\Http\Request;

class FreeTestComponent
{
    public function index(Request $request)
    {
        $packages = [];
        if ($request->has('packages')) {
            $ids = collect($request->get('packages'))->pluck('package');
            $packages = Packages::whereIn('id', $ids)->get();
        }
        $response = $packages->map(function ($package) {
            return [
                'id' => $package->id,
                'title' => $package->title,
                'page' => [
                    'slug' => $package->pages ? $package->pages->slug : '',
                    'type' => ($package->board && $package->board->path) ? $package->board->path : 'something',
                ],
            ];
        });

        return $response;
    }

    public function create(Request $request)
    {
        $packages = [];

        if ($request->has('packages')) {
            $ids = collect($request->get('packages'))->pluck('package');
            $packages = Packages::whereIn('id', $ids)->get();
        }

        return response()->json([
            'packages' => $packages,
        ], 200);
    }
}
