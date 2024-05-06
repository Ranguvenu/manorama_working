<?php

namespace App\Http\Requests\Careers\JobPostings;

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
            'title' => 'required|max:255',
            'subject' => 'required',
            'tags' => 'nullable',
            'publish_from' => 'required',
            'category_id' => 'required',
            'description' => 'nullable',
            'open' => 'nullable',
            'assignments.*.title' => 'required',
            'assignments.*.description' => 'required',
            'assignments.*.meta.accepts' => 'nullable',
            'assignments.*.meta.accepts_help' => 'nullable',
            'assignments.*.meta.upload_button_label' => 'nullable',
            'assignments.*.meta.upload_button_help' => 'nullable',
            'assignments.*.meta.link_button_label' => 'nullable',
            'assignments.*.meta.link_button_help' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter  the title',
            'category_id.required' => 'Please select the category',
            'subject.required' => 'Please enter  the subject',
            'publish_from.required' => 'Please enter  the publish from',
            'assignments.*.title.required' => 'Assignment title is required',
            'assignments.*.description.required' => 'Assignment Description is required',
        ];
    }
}
