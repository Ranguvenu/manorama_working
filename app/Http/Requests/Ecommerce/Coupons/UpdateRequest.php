<?php

namespace App\Http\Requests\Ecommerce\Coupons;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $coupon = $this->route('coupon');
        $couponclaimed = $coupon->claims()->count();
        
        return [
            'type' => 'required',
            'package_id' => 'requiredif:type,=,1',
            'code' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required|numeric',
            'valid_from' => 'required|after_or_equal:'.$coupon->valid_from,
            'valid_to' => 'required|after_or_equal:valid_from',
            'coupon_usage_limit' => 'required|gte:'.$couponclaimed,
            'user_usage_limit' => 'required|lte:coupon_usage_limit',
        ];
    }

    public function messages()
    {
        return [
            'package_id.requiredif' => 'Please select the package',
            'user_usage_limit.lte' => 'The User Usage Limit must be less than Coupon Usage Limit.',
        ];
    }
}
