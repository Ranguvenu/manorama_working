<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Coupons;
use App\Models\Ecommerce\Packages;
use App\Models\User;
use Carbon\Carbon;

class CouponService
{
    protected $code;

    protected $coupon;

    protected $package;

    protected $user;

    public function __construct($coupon, Packages $package = null, User $user = null)
    {
        $this->code = $coupon;
        $this->package = $package;
        $this->user = $user;
    }

    protected function is_coupon_valid()
    {
        $this->coupon = Coupons::where('code', $this->code)->first();
        if (!$this->coupon) {
            return [
                'error' => 'true',
                'message' => 'Invalid Coupon Code',
            ];
        }

        $rules = ['is_coupon_inactive', 'is_coupon_not_applicable', 'is_user_usage_limit_exceeded', 'is_limit_exceeded'];
        foreach ($rules as $rule) {
            $valid = call_user_func([$this, $rule]);
            if ($valid) {
                return [
                    'error' => true,
                    'message' => $this->get_error_message($rule),
                ];
            }
        }

        return [
            'error' => false,
            'message' => 'Coupon code is valid',
        ];
    }

    protected function is_user_usage_limit_exceeded()
    {
        if ($this->coupon->user_usage_limit) {
            if ($this->user->claims()->count() >= $this->coupon->user_usage_limit) {
                return true;
            }
        }

        return false;
    }

    protected function is_limit_exceeded()
    {
        if ($this->coupon->coupon_usage_limit) {
            if ($this->coupon->claims()->count() >= $this->coupon->coupon_usage_limit) {
                return true;
            }
        }

        return false;
    }

    protected function is_coupon_inactive()
    {
        $valid_from = Carbon::parse($this->coupon->valid_from);
        $valid_to = Carbon::parse($this->coupon->valid_to);
        $today = Carbon::today();
        if ($today->between($valid_from, $valid_to)) {
            return false;
        }

        return true;
    }

    protected function is_coupon_not_applicable()
    {
        $packages = $this->coupon->packages()->pluck('package_id')->toArray();
        if ($packages && sizeof($packages)) {
            if (in_array($this->package->id, $packages)) {
                return false;
            }

            return true;
            // return $this->package ? (($this->package->id == $this->coupon->package_id) ? false : true) : true;
        }

        return false;
    }

    public function apply_coupon()
    {
        $validate = $this->is_coupon_valid();

        if ($validate['error']) {
            return $validate;
        }

        return [
            'id' => $this->coupon->id,
            'error' => $validate['error'],
            'code' => $this->coupon->code,
            'type' => $this->coupon->discount_type,
            'value' => $this->coupon->discount_value,
        ];
    }

    protected function get_error_message($code)
    {
        $codes = $this->error_codes();

        return isset($codes[$code]) ? $codes[$code] : '';
    }

    protected function error_codes()
    {
        return [
            'is_limit_exceeded' => 'This coupon is not valid',
            'is_coupon_inactive' => 'This coupon is inactive',
            'is_user_usage_limit_exceed' => 'You cannot use this coupon anymore',
            'is_coupon_not_applicable' => 'This coupon is not valid on this package',
        ];
    }
}
