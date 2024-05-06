<?php

namespace App\Http\Requests\Notifications\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
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
            'template_id' => 'required',
            'from_address' => 'required|max:255',
            'from_name' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'settings.required' => 'Please select the appropriate setting',
            'template_id.required' => 'Please select the template',
        ];
    }
}
