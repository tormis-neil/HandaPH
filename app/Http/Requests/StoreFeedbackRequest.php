<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'effectiveness' => ['required', 'integer', 'between:1,5'],
            'efficiency' => ['required', 'integer', 'between:1,5'],
            'satisfaction_usefulness' => ['required', 'integer', 'between:1,5'],
            'satisfaction_trust' => ['required', 'integer', 'between:1,5'],
            'satisfaction_pleasure' => ['required', 'integer', 'between:1,5'],
            'satisfaction_comfort' => ['required', 'integer', 'between:1,5'],
            'risk_economic' => ['required', 'integer', 'between:1,5'],
            'risk_health_safety' => ['required', 'integer', 'between:1,5'],
            'risk_environmental' => ['required', 'integer', 'between:1,5'],
            'context_coverage' => ['required', 'integer', 'between:1,5'],
            'flexibility' => ['required', 'integer', 'between:1,5'],
            'comments' => ['nullable', 'string', 'max:2000'],
        ];
    }
}