<?php

namespace App\Http\Requests\LeadManagement\ContactUsRequests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone.code' => 'required',
            'phone.number' => 'required|digits:10',
            'message' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
          'name.required' => 'Please enter your name',
          'phone.code' => 'Please select country code',
          'phone.number.required' => 'Please enter a valid phone number',
          'phone.number.digits' => 'Please enter valid 10 digit phone number',
          'email.email' => 'Please enter valid email address',
        ];
    }
}
