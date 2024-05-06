<?php

namespace App\Http\Requests\MasterData\Testimonials;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'profile'  => 'required',
            'avatar_id' => 'nullable',
            'name'=>'required',
            'title'=>'required',
            'testimonial_type'=>'required',
            'testimonial'=>'required',
            'product_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            "profile.required" => "Please enter the Profile",
            "name.required" => "Please enter the Name",
            "title.required" => "Please enter the Title",
            "product_id.required" => "Please select the Product",
        ];
    }
}
