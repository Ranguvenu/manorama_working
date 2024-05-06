<?php

namespace App\Http\Requests\Content\Videolist;
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
            'video' => 'required', 
            'thumbnail' => 'required',    
            'published_from' => 'required',
            'published_to' => 'required|after_or_equal:published_from',
            'category_id' => 'required'
     
        ];
    }
}
