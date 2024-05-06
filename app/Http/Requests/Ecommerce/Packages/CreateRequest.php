<?php

namespace App\Http\Requests\Ecommerce\Packages;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'goal_id' => 'required|integer|min:1',
            'board_id' => 'required|integer|min:1',
            'class_id' => 'required|integer|min:1',
            'thumbnail_id' => 'required|gt:0',
            'title' => 'required',
            'code' => 'required|alpha_dash|unique:packages,code',
            'description' => 'required',
            'valid_from' => 'required|date_format:Y-m-d|after_or_equal:today',
            'valid_to' => 'required|date_format:Y-m-d|after_or_equal:valid_from',
            'enrollment_start_date' => 'required|date_format:Y-m-d|after_or_equal:valid_from',
            'enrollment_end_date' => 'required|date_format:Y-m-d|after_or_equal:enrollment_start_date|before_or_equal:valid_to',
            'is_trial_available' => 'nullable',
            'is_paid' => 'nullable',
            'package_type' => 'required',
            'validity_type' => 'required',
            'valid_for' => 'required',
            'is_published' => 'required',
            'is_paid' => 'required',
            'is_external_course' => 'nullable',
        ];

        if ($this->get('validity_type') == 'days') {
            $rules['valid_for'] = 'required|integer';
        } elseif ($this->get('validity_type') == 'date') {
            $rules['valid_for'] = 'required|date_format:Y-m-d|after_or_equal:valid_from|before_or_equal:valid_to';
        }

        if ($this->get('package_type') == 0) {
            $rules['subjects'] = 'required';
        } else {
            $rules['subjects'] = 'nullable';
        }

        if ($this->get('is_external_course')) {
            $rules['instructions'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'goal_id.required' => 'Please select goal',
            'goal_id.min' => 'Please select goal',
            'board_id.required' => 'Please select board',
            'board_id.min' => 'Please select board',
            'class_id.required' => 'Please select class',
            'class_id.min' => 'Please select class',
            'validity_value.required' => 'Please select validity',
            'valid_for.date_format' => 'Please enter the date',
            'is_paid.required' => 'Please Select Payment Type',
            'thumbnail_id.required' => 'Please upload an image',
            'thumbnail_id.gt' => 'Please upload an image',
            'instructions.required' => 'Please enter Instructions to enroll',
        ];

        if ($this->validity_type == 'days') {
            $messages['valid_for.required'] = 'Please enter the duration in days';
        } else {
            $messages['valid_for.required'] = 'Please enter the expiry date';
            $messages['valid_for.after_or_equal'] = 'The Expiry date must be a date after or equal to Valid from date.';
            $messages['valid_for.before_or_equal'] = 'The Expiry date must be a date before or equal to Valid to date.';
        }

        return $messages;
    }
}
