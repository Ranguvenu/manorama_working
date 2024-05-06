<?php

namespace App\Http\Requests\Integration\SSO;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SSOSettingsRequest extends FormRequest
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
            'lms_token'         => 'required',
            'lms_url'           => 'required',
            'lms_encryption_key'=> 'required'
        ];
    }
}
