<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email:rfc,dns', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone_number' => 'nullable|numeric|digits:10',
            'firstname' => ['nullable'],
            'lastname' => ['nullable'],
            'address' => ['nullable'],
            'country' => ['nullable'],
            'state' => ['nullable'],
            'city' => ['nullable'],
            'dob' => ['nullable'],
            'profile_id' => ['nullable'],
        ];
    }

    public function messages(){
        return [
            'phone_number.numeric'      => 'Please enter phone as numeric value',
        ];
    }
}
