<?php

namespace App\Http\Resources\MasterData;

use App\Models\Ecommerce\PackagePricingHasCourses;
use App\Models\MasterData\Hierarchy;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PricingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $testing = Hierarchy::whereIn('id', PackagePricingHasCourses::where('package_pricing_id', $this->id)->pluck('course_id'))->pluck('title')->join(',');
        // dd($testing);
        
        return [
            'id' => $this->id,
            'name' => 'ddsdsd',
            'package_id' => $this->package_id,
            'actual_price' => $this->actual_price,
            'selling_price' => $this->selling_price,
            'sap_type_id' => $this->sap_type_id,
            'sap_sub_type_id' => $this->sap_sub_type_id,
            'sap_ism_amount' => $this->sap_ism_amount,
            'sap_ism_product_code' => $this->sap_ism_product_code,
            'courses' => Hierarchy::whereIn('id', PackagePricingHasCourses::where('package_pricing_id', $this->id)->pluck('course_id'))->pluck('title')->join(','),
            'subjects' => PackagePricingHasCourses::where('package_pricing_id', $this->id)->pluck('course_id'),
        ];
    }
}
