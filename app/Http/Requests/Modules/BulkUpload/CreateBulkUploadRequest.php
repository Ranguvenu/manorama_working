<?php

namespace App\Http\Requests\Modules\BulkUpload;

use Illuminate\Foundation\Http\FormRequest;

class CreateBulkUploadRequest extends FormRequest
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
            'component' => 'required',
            'file' => 'required|mimes:csv,txt',
        ];
    }
}
