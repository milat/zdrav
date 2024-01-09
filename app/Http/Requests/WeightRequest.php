<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightRequest extends FormRequest
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
            'value' => 'required|decimal:1',
            'date' => 'required|date'
        ];
    }

    public function attributes(): array
    {
        return [
            'score_id' => __('fields.weight.score'),
            'value' => __('fields.weight.value'),
            'date' => __('fields.weight.date'),
        ];
    }
}
