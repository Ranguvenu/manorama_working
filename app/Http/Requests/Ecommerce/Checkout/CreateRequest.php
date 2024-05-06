<?php

namespace App\Http\Requests\Ecommerce\Checkout;

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
        return [
            'profile.firstname' => 'required',
            'profile.lastname' => 'required',
            'profile.phone_number' => 'required',
            'profile.address' => 'required',
            'profile.address2' => 'required',
            'profile.country' => 'required',
            'profile.state' => 'required',
            'profile.city' => 'required',
            'profile.pincode' => 'required|numeric|digits:6',
            'summary.total' => 'required|numeric',
            'summary.package_id' => 'required|numeric',
            'summary.selling_price' => 'required|numeric',
            'summary.coupon' => 'nullable',
            'summary.coupon_discount' => 'nullable',
            'summary.batches' => 'nullable',
            'summary.trial' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
          'profile.firstname.required' => 'Please enter First Name',
          'profile.lastname.required' => 'Please enter Last Name',
          'profile.phone_number.required' => 'Please enter Phone Number',
          'profile.address.required' => 'Please enter Address Line 1',
          'profile.address2.required' => 'Please enter Address Line 2',
          'profile.country.required' => 'Please select Country',
          'profile.state.required' => 'Please select State',
          'profile.city.required' => 'Please enter City',
          'profile.pincode.required' => 'Please enter Pincode',
          'profile.pincode.digits' => 'Please enter valid 6 digits Pincode',
        ];
    }
}
