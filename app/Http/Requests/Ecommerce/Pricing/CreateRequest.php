<?php

namespace App\Http\Requests\Ecommerce\Pricing;

use App\Rules\Ecommerce\PackagePricingCombination;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'actual_price' => 'required|numeric|gt:0',
            'selling_price' => 'nullable|numeric|lt:actual_price|gt:0',
            'subjects' => [
                'required',
                new PackagePricingCombination($this->route('package'), $this->get('subjects')),
            ],
            'sap_type_id' => 'required',
            'sap_sub_type_id' => 'required',
            'sap_ism_amount' => 'required|numeric|gt:0',
            'sap_ism_product_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'selling_price.required' => 'The Offer price field is required.',
            'selling_price.lt' => 'The Offer price must be less than Actual price.',
            'subjects.required' => 'Please select the subject.',
        ];
    }
}
