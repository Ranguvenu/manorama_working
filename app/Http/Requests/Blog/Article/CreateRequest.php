<?php

namespace App\Http\Requests\Blog\Article;

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
            'image_id' => 'required',
            'category' => 'nullable',
            'video_id' => 'required',
            'thumbnail_id' => 'required',
            'short_description' => 'required',
            'author_id' => 'required',
            'is_published' => 'required',
            'order' => 'required',
            'published_on' => 'required',
            'labels' => 'required',
            'tags' => 'required',
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

    public function messages()
    {
        return [
            'title.required' => 'Please enter  the title',
            'description.required' => 'Please enter  the description',
            'image_id.required' => 'Please upload the image',
            'video_id.required' => 'Please upload  the video',
            'thumbnail_id.required' => 'Please upload  the thumbnail',
            'short_description.required' => 'Please enter  the description',
            'author_id.required' => 'Please select the author',
            'is_published.required' => 'Please enter  the image',
            'order.required' => 'Please enter numeric values',
            'image.required' => 'Please enter  the image',
            'published_on.required' => 'Please enter  the published date',
            'labels.required' => 'Please enter  the labels',
            'tags.required' => 'Please enter  the tags',
        ];
    }
}
