<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPreferenceRequest extends FormRequest
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
            'weight_unit_id' => 'required|integer',
            'measurement_unit_id' => 'required|integer',
            'hydration_unit_id' => 'required|integer',
            'language_id' => 'required|integer',
            'date_format_id' => 'required|integer',
        ];
    }

    public function attributes(): array
    {
        return [
            'weight_unit_id' => __('fields.user_preference.weight_unit'),
            'measurement_unit_id' => __('fields.user_preference.measurement_unit'),
            'hydration_unit_id' => __('fields.user_preference.hydration_unit'),
            'language_id' => __('fields.user_preference.language'),
            'date_format_id' => __('fields.user_preference.date_format')
        ];
    }
}
