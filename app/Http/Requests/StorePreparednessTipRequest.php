<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePreparednessTipRequest extends FormRequest
{
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
            'logic_id' => ['required', 'string', 'max:255', 'unique:preparedness_tips,logic_id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'tag' => ['required', 'in:before,during,after'],
            'is_active' => ['boolean'],
        ];
    }
}
