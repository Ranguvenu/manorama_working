<?php

namespace App\Http\Requests\LeadManagement\UserResponse;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'response' => 'required',
            'status' => 'required',
            'callback' => 'required',
            'callback_on' => 'required|after_or_equal:now',
        ];
    }

    public function messages()
    {
        return [
            'callback_on.after_or_equal' => 'The date time must be a date after or equal to today and the current time.',
        ];
    }
}
