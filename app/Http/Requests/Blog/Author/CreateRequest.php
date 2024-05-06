<?php

namespace App\Http\Requests\Blog\Author;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class CreateRequest extends FormRequest
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
            'name'          => 'required|max:255',
            'image'         => 'required',
            'bio'           => 'required',
            'student_editor'=> 'nullable',
        ];
    }

    public function messages(){
        return [
            "name.required"     => "Please enter the name",
            "image.required"    => "Please upload author image",
            "bio.required"      => "Please enter bio",
        ];
    }
}
