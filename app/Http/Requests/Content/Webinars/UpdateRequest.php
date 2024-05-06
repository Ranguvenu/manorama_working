<?php

namespace App\Http\Requests\Content\Webinars;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'thumbnail_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'date_time' => 'required|after_or_equal:now',
            'about_presenter' => 'required',
            'meeting_information' => 'nullable',
            'recording_url' => 'nullable',
            'status' => 'required',
            'published_on' => 'required|after_or_equal:today',
        ];
    }

    public function messages() {
        return [
            'category_id' => 'Please select the category',
            'thumbnail_id' => 'Please provide a thumbnail for webinar',
            'date_time.after_or_equal' => 'The date time must be a date after or equal to today and the current time.',
        ];
    }
}
