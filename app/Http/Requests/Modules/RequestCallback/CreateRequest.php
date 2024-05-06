<?php

namespace App\Http\Requests\Modules\RequestCallback;

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
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone.code' => 'required',
            'phone.number' => 'required|digits:10',
            'channel' => 'required',
            'received_from' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email',
            'email.email' => 'Please enter valid email',
            'phone.code.required' => 'Country code is required',
            'phone.number.required' => 'Phone number is required',
            'phone.number.digits' => 'Please enter valid 10 digits phone number',
        ];
    }
}
