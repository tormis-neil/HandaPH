<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChecklistRuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active'),
            'locations' => $this->locations ?? [],
            'sizes' => $this->sizes ?? [],
            'special_needs' => $this->special_needs ?? [],
            'house_types' => $this->house_types ?? [],
        ]);
    }

    public function rules(): array
    {
        return [
            'item_text' => ['required', 'string'],
            'phase' => ['required', 'in:before,during,after'],
            'tag' => ['required', 'string', 'max:255'],
            'tag_class' => ['required', 'string', 'max:255'],
            'locations' => ['nullable', 'array'],
            'sizes' => ['nullable', 'array'],
            'special_needs' => ['nullable', 'array'],
            'house_types' => ['nullable', 'array'],
            'is_active' => ['boolean'],
        ];
    }
}
