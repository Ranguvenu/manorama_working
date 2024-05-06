<?php

namespace App\Http\Requests\UserManagement\Roles;

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
            'name'          => 'required|unique:roles',
            'fullname'      => 'required',
            'description'   => 'required',
            'permissions'   => 'required|array',
            'mdlrole'       => 'required'
        ];
    }

    public function messages(){
          return [
            'name.required' => 'Please enter the  Role short  name',
            'fullname.required'=>'Please enter the Role name',
            'permissions.required' => 'Please select permissions from given list below.',
            'mdlrole.required'     => 'Please select LMS Role.',
        ];
    }
}
