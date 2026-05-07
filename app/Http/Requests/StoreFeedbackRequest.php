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
            'rating' => ['required', 'integer', 'between:1,5'],
            'easy_to_understand' => ['nullable', 'in:yes_very_easy,somewhat,confusing'],
            'helpful_prepare' => ['nullable', 'in:yes_very_helpful,somewhat_helpful,no_not_really'],
            'improve_comments' => ['nullable', 'string', 'max:2000'],
            'region' => ['nullable', 'string', 'max:50'],
        ];
    }
}