<?php

namespace App\Http\Requests\Ecommerce\Orders;

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
            'user_id' => 'required',
            'package_id' => 'required',
            'package_pricing_id' => 'required',
            'order_amount' => '',
            'discount_amount' => '',
            'net_payable' => '',
            'status' => 'required',
            'transaction_id' => '',
            'courses' => 'required',
            'batches' => 'required',
            'cheque' => 'required',
            'agent_id' => 'nullable',
        ];
        if ($this->get('status') == 6) {
            $rules['days'] = 'required|gt:0';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Please select User',
            'package_id.required' => 'Please select a Package',
            'package_pricing_id.required' => 'Please select  Pricing',
            'status.required' => 'Please select Status',
            'courses.required' => 'Please select Course',
            'batches.required' => 'Please select Batches',
            'cheque.required' => 'Please enter the Payment Reference Number',
            'days.required' => 'No of days is required for freetrial orders',
            'days.gt' => 'No of days is required for freetrial orders',
        ];
    }
}
