<?php

namespace App\Http\Requests\Modules\Testimonials;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'profile' => 'required',
            'name' => 'required',
            'title' => 'required',
            'testimonial' => 'required',
            'product_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'profile.required' => 'Please enter the Profile',
            'name.required' => 'Please enter the Name',
            'title.required' => 'Please enter the Title',
            'product_id.required' => 'Please select the Product',
        ];
    }
}
