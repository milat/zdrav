<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HydrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'score_id' => 'required|integer',
            'amount' => 'required|integer',
            'date' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [
            'score_id' => __('fields.hydration.score'),
            'amount' => __('fields.hydration.amount'),
            'date' => __('fields.hydration.date'),
        ];
    }
}
