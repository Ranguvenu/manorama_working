<?php

namespace App\Http\Requests\Ecommerce\Coupons;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
        $rules = [
            'type' => 'required',
            'packages' => 'requiredif:type,=,1',
            'code' => 'required|alpha_num|uppercase|unique:coupons,code',
            'discount_type' => 'required',
            'discount_value' => 'required|numeric',
            'valid_from' => 'required|after_or_equal:today',
            'valid_to' => 'required|after_or_equal:valid_from',
            'coupon_usage_limit' => 'required',
            'user_usage_limit' => 'required|lte:coupon_usage_limit',
        ];

        if ($this->get('discount_type') == 0) {
            $rules['discount_value'] = 'required|numeric|max:1000000';
        } elseif ($this->get('discount_type') == 1) {
            $rules['discount_value'] = 'required|numeric|max:100';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        $messages['packages.requiredif'] = 'Please select the package.' ;
        $messages['code.unique'] = 'This code already exists.' ;
        $messages['code.alpha_num'] = 'The code must only contain letters and numbers without space.' ;
        $messages['user_usage_limit.lte'] = 'The User Usage Limit must be less than Coupon Usage Limit.' ;

        if ($this->discount_type == 0) {
            $messages[ 'discount_value.max'] = 'The discount value must not be greater than 10,00,000.';
        }

        return $messages;
    }
}
