<?php

namespace App\Http\Requests\Content\DownloadableResources;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'publish_from' => 'required|date|after_or_equal:today',
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
          'publish_from.date' => 'Please enter valid date',
          'publish_from.after_or_equal' => 'Publish from should be greater than or equals to todays date',
          'publish_to' => 'Please select publish to date',
          'publish_to.date' => 'Please enter valid date',
          'publish_to.after_or_equal' => 'Publish to cannot be less that publish from date',
          'resource_type_id' => 'Please select resouce type',
          'resource_id' => 'Please upload resource file',
        ];
    }
}
