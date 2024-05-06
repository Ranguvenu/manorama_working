<?php

namespace App\Http\Requests\Ecommerce\Pricing;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'actual_price' => 'required|numeric|gt:0',
            'selling_price' => 'nullable|numeric|lt:actual_price|gt:0',
            'subjects' => 'required|Array',
            'sap_type_id' => 'required',
            'sap_sub_type_id' => 'required',
            'sap_ism_amount' => 'required|numeric|gt:0',
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
