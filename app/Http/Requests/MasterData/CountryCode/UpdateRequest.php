<?php

namespace App\Http\Requests\MasterData\CountryCode;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UpdateRequest extends FormRequest
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
            'name'  =>  'required|max:255',
            'code'  =>  'required|numeric|unique:country_codes,code,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Please enter  the Name",
            "code.required" => "Please enter  the Code",   
            "code.numeric" => "Please enter the code as numeric value",
        ];
    }
}
