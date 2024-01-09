<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
            'test_reference_id' => 'required|integer',
            'description' => 'required|max:100',
            'value' => 'required|decimal:1',
            'unit' => 'required|max:20',
            'date' => 'required|date'
        ];
    }

    public function attributes(): array
    {
        return [
            'test_reference_id' => __('fields.test.test_reference'),
            'description' => __('fields.test.description'),
            'value' => __('fields.test.value'),
            'unit' => __('fields.test.unit'),
            'date' => __('fields.test.date'),
        ];
    }
}
