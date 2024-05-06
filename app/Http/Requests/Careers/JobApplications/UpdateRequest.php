<?php

namespace App\Http\Requests\Careers\JobApplications;

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
            'resume' => 'required',
            'qualification' => 'required',
            'status' => 'required',
            'assignments.*.url' => 'required',
            'assignments.*.assignment_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'resume.required' => 'Please upload resume',
            'qualification.required' => 'Please enter your qualification',
            'assignments.*.url.required' => 'Please upload or enter the url for document',
        ];
    }
}
