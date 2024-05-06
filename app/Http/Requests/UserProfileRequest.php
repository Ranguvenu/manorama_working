<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserProfileRequest extends FormRequest
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
            'name' => 'nullable',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
            'dob' => 'nullable|before_or_equal:today',
            'gender' => 'nullable',
            'address' => 'nullable',
            'address2' => 'nullable',
            'country' => 'nullable',
            'state' => 'nullable',
            'city' => 'nullable',
        ];
    }

    public function messages(){
        return [
            'dob.before_or_equal' => 'The Date of Birth must be a date before or equal to date today.',
        ];
    }
}
