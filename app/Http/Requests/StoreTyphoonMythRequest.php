<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTyphoonMythRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active'),
        ]);
    }

    public function rules(): array
    {
        return [
            'myth' => ['required', 'string'],
            'fact' => ['required', 'string'],
            'action' => ['required', 'string'],
            'is_active' => ['boolean'],
        ];
    }
}
