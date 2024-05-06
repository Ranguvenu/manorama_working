<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponCodeClaimsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->coupon_code->code,
            'claimed_by' => $this->used_by->email,
            'package' => $this->order->package->title,
            'discount_availed' => $this->order->discount_amount,
            'claimed_on' => date($this->created_at),
        ];
    }
}
