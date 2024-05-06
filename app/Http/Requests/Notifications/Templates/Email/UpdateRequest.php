<?php

namespace App\Http\Requests\Notifications\Templates\Email;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'notification_type_id' => 'required',
            'title' => 'required|max:255',
            'subject' => 'required',
            'content' => 'required',
            'status' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'notification_type_id.required' => 'Please select the notification type',
            'title.required' => 'Please enter the title',
            'content.required' => 'Please enter the content for template',
            'subject.required' => 'Please enter the subject for template',
        ];
    }
}
