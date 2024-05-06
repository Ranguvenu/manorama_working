<?php

namespace App\Http\Requests\MasterData\Universities;

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
            'name'           => 'required',
            'established_on' => 'nullable|before_or_equal:today',
            'location'       => 'nullable',
            'address'        => 'nullable',
            'pincode'        => 'nullable|numeric',
            'state'          => 'nullable',
            'country'        => 'nullable',
            'phone'          => 'nullable',
            'fax'            => 'nullable',
            'website'        => 'nullable',
            'logo_id'        => 'nullable',
            'description'    => 'nullable',
            'is_published'   => 'nullable',
            'email'         => 'nullable',
            'code'         => 'nullable',
          
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter the University Name',
        ];
    }
}
