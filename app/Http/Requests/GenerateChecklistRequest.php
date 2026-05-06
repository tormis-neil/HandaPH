<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateChecklistRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'location' => ['required', 'in:coastal,mountainous,inland,flood-prone'],
            'household_size' => ['required', 'in:1,2-4,5-7,8-plus'],
            'special_needs' => ['nullable', 'array'],
            'special_needs.*' => ['in:children,seniors,pwd,pets'],
            'house_type' => ['required', 'in:light,semi-concrete,concrete'],
        ];
    }

    /**
     * Make sure special_needs is always an array, even when empty.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'special_needs' => $this->input('special_needs', []),
        ]);
    }
}