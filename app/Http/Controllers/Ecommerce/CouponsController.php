<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\Coupons\CreateRequest as CreateCouponRequest;
use App\Http\Requests\Ecommerce\Coupons\UpdateRequest as UpdateCouponRequest;
use App\Http\Resources\Ecommerce\CouponCodeClaimsResource;
use App\Http\Resources\Ecommerce\CouponsResource;
use App\Models\Ecommerce\Coupons;
use App\Models\Ecommerce\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-coupons'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-coupon'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-coupon'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-coupon'])->only('destroy');
    }

    public function index()
    {
        return Inertia::render('Ecommerce/Coupons/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $coupons = Coupons::filterBy($request->all())->latest()->paginate($perpage);

        return CouponsResource::collection($coupons);
    }

    public function create()
    {
        $packages = Packages::all();

        return response()->json([
            'packages' => $packages,
        ], 200);
    }

    public function store(CreateCouponRequest $request)
    {
        DB::beginTransaction();
        try {
            $coupons = Coupons::create($request->validated());
            if ($request->get('packages')) {
                $packages = array_map(function ($package) {
                    return ['package_id' => $package];
                }, $request->get('packages'));
                $coupons->packages()->createUpdateOrDelete($packages);
            }
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Created Coupon Successfully',
            ], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(Coupons $coupon)
    {
         $data = [
            'id' => $coupon->id,
            'packages' => $coupon->packages->pluck('package_id'),
            'code' => $coupon->code,
            'discount_type' => $coupon->discount_type,
            'discount_value' => $coupon->discount_value,
            'valid_from' => $coupon->valid_from,
            'valid_to' => $coupon->valid_to,
            'coupon_usage_limit' => $coupon->coupon_usage_limit,
            'user_usage_limit' => $coupon->user_usage_limit,
        ];

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function update(Coupons $coupon, UpdateCouponRequest $request)
    {
        try {
            $update = $coupon->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Updated Coupon Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function claims(Coupons $coupon, Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $claims = $coupon->claims()->latest()->paginate($perpage);

        return CouponCodeClaimsResource::collection($claims);
    }

    public function destroy(Coupons $coupon)
    {
        try {
            $delete = $coupon->delete();

            return response()->json([
             'success' => true,
             'message' => 'Deleted Coupons Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
