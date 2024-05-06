<?php

namespace App\Http\Requests\MasterData\Schools;

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
            'name'  =>  'required',
            'code'=>'nullable',
            'location'=>'required',
            'district'=>'required',
            'state'=>'required',
            'country'=>'required',
            'address'=>'nullable',
            'is_published'=>'nullable',
            'contact_details'=>'nullable'
        ];
    }
    
    public function messages()
    {
        return [
            "name.required" => "Please enter  the Name",         
            "location.required" => "Please enter  the Location",
            "district.required" => "Please enter  the District",
            "state.required" => "Please enter  the State",
            "country.required" => "Please enter  the Country",
        ];
    }




}
