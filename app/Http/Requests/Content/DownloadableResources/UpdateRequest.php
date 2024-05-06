<?php

namespace App\Http\Requests\Content\DownloadableResources;

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
            'title' => 'required',
            'description' => 'required',
            'publish_from' => 'required',
            'publish_to' => 'required|date',
            'publish_to' => 'required|date|after_or_equal:publish_from',
            'resource_type_id' => 'required',
            'resource_id' => 'required|gt:0',
            'is_active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
          'title.required' => 'Please enter title',
          'description' => 'Please enter description',
          'publish_from' => 'Please select publish from date',
          'publish_to' => 'Please select publish to date',
          'resource_id' => 'Please upload resource file',
          'publish_to.date' => 'Please enter valid date',
          'publish_to.after_or_equal' => 'Publish to cannot be less that publish from date',
          'resource_type_id' => 'Please select resouce type',
        ];
    }
}
