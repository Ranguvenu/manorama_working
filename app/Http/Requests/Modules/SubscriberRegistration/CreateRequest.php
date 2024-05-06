<?php

namespace App\Http\Requests\Modules\SubscriberRegistration;

use App\Models\User;
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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|string|email:rfc,dns|max:255|unique:'.User::class,
            'phone.code' => 'required',
            'phone.number' => 'required|numeric|digits:10',
            'password' => 'required',
            'otp' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'First name is required',
            'lastname.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'phone.code.required' => 'Country code is required',
            'phone.number.required' => 'Phone number is required',
            'phone.number.digits' =>'Please enter valid 10 digit phone number',
            'phone.number.numeric' =>'Please enter valid phone number',
            'password' => 'Password is required',
        ];
    }
}
