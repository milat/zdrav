<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MindfulnessRequest extends FormRequest
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
            'length' => 'required|integer',
            'date_time' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [
            'score_id' => __('fields.hydration.score'),
            'length' => __('fields.hydration.length'),
            'date_time' => __('fields.hydration.date_time'),
        ];
    }
}
