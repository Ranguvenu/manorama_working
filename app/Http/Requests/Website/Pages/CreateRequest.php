<?php

namespace App\Http\Requests\Website\Pages;

use App\Models\Website\PageBuilder\Page;
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
        $rules = [
            'title' => 'required',
            'status' => 'required',
            'page_type' => 'required',
            'description' => 'required',
            'seo_configuration.title' => 'nullable',
            'seo_configuration.description' => 'nullable',
            'seo_configuration.card' => 'nullable',
            'seo_configuration.follow_links' => 'nullable',
            'seo_configuration.robots' => 'nullable',
            'seo_configuration.canonical_url' => 'nullable',
            'seo_configuration.schema' => 'nullable',
            'seo_configuration.twitter_handle' => 'nullable',
            'seo_configuration.keywords' => 'nullable',
            'seo_configuration.meta_data' => 'nullable',
        ];

        if ($this->get('page_type') == 'package') {
            $rules['package_id'] = 'required|unique:'.Page::class;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'package_id.required' => 'Package is required',
            'package_id.unique' => 'This package is already associated with different page',
        ];
    }
}
