<?php

namespace App\Http\Requests\MasterData\Hierarchy;

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
            'type_id' => 'required',
            'title' => 'required|max:255',
            'code' => 'required|alpha_dash|max:255|unique:App\Models\MasterData\Hierarchy,code',
            'parent_id' => 'required',
            'depth' => 'required',
            'description' => '',
            'image' => '',
            'tags' => '',
        ];
    }
    public function messages(){
        return [
          'title.required'  => 'Please Enter Title',
          'code.required'   => 'Please Enter Code',
        ];
    }
}
