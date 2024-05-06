<?php

namespace App\Http\Requests\Modules\PackageRating;

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
            'rating' => 'required',
            'review' => 'nullable',

        ];
    }

    public function messages()
    {
        return [
            'rating.required' => 'Please select rating stars',
        ];
    }
}
