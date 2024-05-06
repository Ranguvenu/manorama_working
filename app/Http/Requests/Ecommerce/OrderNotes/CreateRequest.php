<?php

namespace App\Http\Requests\Ecommerce\OrderNotes;

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
            'note' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'note.required' => 'Notes Cannot be Empty',
        ];
    }
}
