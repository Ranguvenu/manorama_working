<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $packages = $this->packages->map(function ($package) {
            return $package->package->title;
        })->toArray();

        return [
            'id' => $this->id,
            'code' => $this->code,
            'type' => $this->package_id == 0 ? 'Global' : 'Package Lead',
            'package' => $packages ? implode(',', $packages) : 'NA',
            // 'package' => $this->package ? $this->package->title : 'Global',
            'number_of_codes' => $this->coupon_usage_limit,
            'discount_type' => $this->discount_type == 0 ? 'Fixed Amount' : 'Percentage Based Amount',
            'discount_value' => $this->discount_value,
            'valid_from' => get_date($this->valid_from, 'd M Y'),
            'valid_to' => get_date($this->valid_to, 'd M Y'),
            'availed' => $this->claims()->count(),
        ];
    }
}
