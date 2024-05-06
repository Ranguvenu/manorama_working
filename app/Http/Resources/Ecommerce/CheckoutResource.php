<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckoutResource extends JsonResource
{
    protected $coupon;

    protected $batches;

    protected $trial;

    public function __construct($resource, $coupon, $batches, $trial)
    {
        parent::__construct($resource);
        $this->coupon = $coupon;
        $this->batches = $batches;
        $this->trial = $trial;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'variation' => $this->id,
            'package_id' => $this->package_id,
            'package' => $this->package,
            'course' => $this->package->title,
            'subjects' => $this->courses->map(function ($course) {
                return $course->course ? $course->course->title : '';
            }),
            'batches' => $this->batches,
            'trial' => $this->trial,
            // 'batches' => $this->courses->map(function ($course) {
            //     return $course->course->batches->pluck('id');
            // })->collapse(),
            'has_trial' => $this->package->hasTrialSubscription(),
            'has_purchased' => $this->package->hasPurchased(),
            'has_purchased_variation' => $this->hasPurchasedThisVariation(),
            'validity' => $this->package->valid_for,
            'actual_price' => $this->actual_price,
            'selling_price' => $this->selling_price,
            'discount' => $this->discount,
            'delivery' => 0,
            'coupon_discount' => $this->coupon_discount(),
            'total' => $this->total(),
            'coupon' => ($this->coupon && isset($this->coupon['id'])) ? $this->coupon['id'] : 0,
        ];
    }

    protected function coupon_discount()
    {
        if ($this->coupon && !$this->coupon['error']) {
            if ($this->coupon['type'] == 0) {
                return $this->coupon['value'];
            } elseif ($this->coupon['type'] == 1) {
                return $this->percentage($this->selling_price, $this->coupon['value']);
            }
        }

        return 0;
    }

    public function total()
    {
        return max(0, $this->selling_price - $this->coupon_discount());
    }

    public function percentage($amount, $percentage)
    {
        return $amount * ($percentage / 100);
    }
}
