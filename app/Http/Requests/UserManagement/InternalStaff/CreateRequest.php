<?php

namespace App\Http\Requests\UserManagement\InternalStaff;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Validation\Rules;
use App\Models\User;

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
            'name'          => 'required|string|max:255|alpha_dash|lowercase|unique:'.User::class,
            'email'         => 'required|string|email:rfc,dns|max:255|unique:'.User::class,
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'firstname'     => 'required|string|max:255',
            'lastname'      => 'required|string|max:255',
            'phone.code'    => 'required|string|max:255',
            'phone.number'  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'roles'         => 'required|array'
        ];
    }

    public function messages(){
          return [
            'name.unique'               =>  'The username has already been taken.',
            'phone.code'                =>  'Please select country code',
            'phone.number.required'     =>  'Please enter phone number',
            'phone.number.digits'       =>  'Please enter valid 10 digit phone number',
            'roles.required'            =>  'Please select role for the staff',
        ];
    }
}
