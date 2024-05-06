<?php

namespace App\Http\Requests\Website\PageComponents;

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
            'page_component_type_id'    => 'required',
            'order'                     => 'required',
            'configuration'             => 'required'
        ];
    }
}
