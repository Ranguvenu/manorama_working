<?php

namespace App\Http\Requests\MasterData\Categories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $taxonomy = $this->route('taxonomy');

        return [
            'name' => 'required|max:255',
            'code' => [
                'required',
                'alpha_dash',
                Rule::unique('categories')->where(function ($query) use ($taxonomy) {
                    return $query->where('taxonomy_slug', $taxonomy->slug);
                })->ignore($this->id),
                'max:255',
            ],
        ];
    }

    public function messages()
    {
        $taxonomy = $this->route('taxonomy');

        return [
            'name.required' => 'Please enter name for '.$taxonomy->name,
        ];
    }
}
