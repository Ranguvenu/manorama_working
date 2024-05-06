<?php

namespace App\Http\Requests\Ecommerce\Batch;

use App\Rules\Ecommerce\ActiveBatch;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $batch = $this->route('batch');
        $startdate = date('d-M-Y', strtotime($batch->package->valid_from));
        $enddate = date('d-M-Y', strtotime($batch->package->valid_to));
        $enrollstart = date('d-M-Y', strtotime($batch->package->enrollment_start_date));
        $enrollend = date('d-M-Y', strtotime($batch->package->enrollment_end_date));
        $lowerlimit = $batch->enrollments->count();
        $rules = [
            'batch_start_date' => 'required|date_format:Y-m-d||after_or_equal:'.$startdate,
            'batch_end_date' => 'required|date_format:Y-m-d|after_or_equal:batch_start_date|before_or_equal:'.$enddate,
            'enrollment_start_date' => 'required|date_format:Y-m-d||after_or_equal:'.$enrollstart.'|before_or_equal:'.$enrollend,
            'enrollment_end_date' => 'required|date_format:Y-m-d|after_or_equal:enrollment_start_date|before_or_equal:'.$enrollend,
            'duration' => 'required|integer',
            'student_limit' => 'required|integer|min:'.$lowerlimit,
            'batch_provider_id' => 'required',
            'is_active' => [
                'required',
                new ActiveBatch($batch->package, $this->get('hierarchy_id')),
            ],
        ];

        if ($this->get('is_active') != $batch->is_active) {
            $rules['is_active'] = [
                'required',
                new ActiveBatch($batch->package, $this->get('hierarchy_id')),
            ];
        } else {
            $rules['is_active'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'hierarchy_id.required' => 'Please select the subject',
            'hierarchy_id.numeric' => 'Please select the subject',
            'hierarchy_id.gt' => 'Please select the subject',
        ];
    }
}
