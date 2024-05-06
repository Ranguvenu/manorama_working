<?php

namespace App\Http\Requests\MasterData\Colleges;

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
            // All validation logics goes here
            'name'                      => 'required|max:255',
            'established_year'          => 'required|numeric|max:'.date('Y'),
            'type'                      => 'required',
            'address'                   => 'required',
            'country'                   => 'required',
            'state'                     => 'required',
            'district'                  => 'required',
            'pincode'                   => 'required|numeric',
            'contact_person'            => 'nullable',
            'phone'                     => 'nullable|numeric|digits:10',
            'fax'                       => 'nullable',
            'email'                     => 'required|email:rfc,dns|unique:colleges,email',
            'website'                   => 'required|url|active_url',
            'student_intake'            => 'nullable|numeric',
            'nat_rank'                  => 'nullable|numeric',
            'is_deemed'                 => 'nullable',
            'name_of_principal'         => 'nullable',
            'contact_no_of_principal'   => 'nullable|numeric|digits:10',
            'email_of_principal'        => 'nullable|email:rfc,dns',
            'admin'                     => 'required',
            'short_description'         => 'nullable',
            'why_join'                  => 'nullable',
            'high_light_text'           => 'nullable',
            'similar_location'          => 'nullable',
            'similar_college'           => 'nullable',
            'logo_id'                   => 'nullable',
            'brochure_id'               => 'nullable',
            'application_form_id'       => 'nullable',
            'facilities'                => 'nullable'
        ];
    }
    public function messages(){
          return [
            // All validation logics goes here
            'name.required'             => 'Please enter name',
            'established_year.required' => 'Please enter established year of college',
            'established_year.max'      => 'Please enter established year less than current year',
            'type.required'             => 'Please enter type of college',
            'address.required'          => 'Please enter address',
            'country.required'          => 'Please enter country name',
            'state.required'            => 'Please enter state name',
            'district.required'         => 'Please enter district name',
            'pincode.required'          => 'Please enter pincode',
            'pincode.numeric'           => 'Please enter pincode as numeric value',
            'phone.numeric'             => 'Please enter phone as numeric value',
            'email.required'            => 'Please enter email id',
            'email.email'               => 'Please enter valid email id',
            'email.unique'              => 'The email has already been taken',
            'website.required'          => 'Please enter college website url',
            'website.url'               => 'Please enter a valid url',
            'website.active_url'        => 'Please enter which is active',
            'student_intake.numeric'    => 'Please enter student intake in numbers',
            'nat_rank.numeric'          => 'Please enter nat rank in numbers',
            'admin.required'            => 'Please enter college admin name',
        ];
    }
}
