<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ecommerce\CheckoutResource;
use App\Http\Resources\Ecommerce\OrderCompleteResource;
use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\PackagePricing;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Country;
use App\Services\Ecommerce\CouponService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function index()
    {
        return Inertia::render('Ecommerce/Checkout/index');
    }

    public function summary(PackagePricing $variation, Request $request)
    {
        return response()->json([
            'data' => new CheckoutResource($variation, $request->get('coupon'), $request->get('batch'), $request->get('trial')),
            'form' => auth()->user(),
            'options' => [
                'countries' => Country::all(),
            ],
        ], 200);
    }

    public function complete($package, Order $order, $status)
    {
        return Inertia::render('Ecommerce/Checkout/status/index', [
            'data' => new OrderCompleteResource($order),
        ]);
    }

    public function cancelled($package, Order $order)
    {
        return Inertia::render('Ecommerce/Checkout/cancelled', [
            'data' => new OrderCompleteResource($order),
        ]);
    }

    public function profile()
    {
        $profile = auth()->user();
        $profile['country_name'] = auth()->user()->country_name;
        $profile['state_name'] = auth()->user()->state_name;

        return Inertia::render('Ecommerce/Checkout/profile/index', [
            'profile' => $profile,
        ]);
    }

    public function apply_coupon(Packages $package, Request $request)
    {
        $service = new CouponService($request->get('coupon'), $package, \Auth::user());
        $apply = $service->apply_coupon();

        return response()->json($apply, 200);
    }
}
