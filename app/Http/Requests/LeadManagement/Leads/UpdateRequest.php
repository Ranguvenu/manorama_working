<?php

namespace App\Http\Requests\LeadManagement\Leads;

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
            'name'                =>  'required',
            'phone.number'        =>  'required|digits:10',
            'phone.code'          =>  'required',
            'email'               =>  'required|email:rfc,dns',
            'product_id'          =>  'nullable',
            'tags'                =>  'nullable',
            'source'              =>  'required',
            'status'              =>  'nullable',
            'associated_product'  =>  'nullable',
        ];
    }

    public function messages(){
          return [
            'name.required'             =>  'Please enter name',
            'phone.number.required'     =>  'Please enter a valid phone number',
            'phone.code'                =>  'Please select country code',
            'phone.number.digits'       =>  'Please enter valid 10 digit phone number',
            'email.email'               =>  'Please enter valid email address',
            'source.required'           =>  'Please select the Lead Source',
        ];
    }
}
