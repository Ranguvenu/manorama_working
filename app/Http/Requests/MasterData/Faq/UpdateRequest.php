<?php

namespace App\Http\Requests\MasterData\Faq;

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
            'title'  =>  'required',
            'category_id'=>'required|unique:schools,code',
            'description'=>'required',
            'status'=>'nullable',
        ];
    }
    public function messages()
    {
        return [
            "title.required" => "Please enter  the title",
            "category_id.required" => "Please enter  the category_id",
            "description.required" => "Please enter  the description",


        ];
    }

}
