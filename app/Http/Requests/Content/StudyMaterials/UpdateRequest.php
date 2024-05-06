<?php

namespace App\Http\Requests\Content\StudyMaterials;

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
            'goal_id' => 'required',
            'board_id' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'thumbnail_id' => 'required',
            'author_id' => 'required',
            'status' => 'required',
            'published_on' => 'required',
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
    }
}
