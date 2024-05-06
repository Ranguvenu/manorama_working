<?php

namespace App\Http\Requests\MasterData\Agents;

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
            'name'      =>  'required',
            'code'      =>  'required',
            'location'  =>  'nullable',
            'locality'  =>  'nullable',
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Please enter  the name",
            "code.required" => "Please enter  the code",
            "code.unique"   => "Entered code already exists",
        ];
    }
}
