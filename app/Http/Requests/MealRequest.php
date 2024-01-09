<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealRequest extends FormRequest
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
            'meal_type_id' => 'required|integer',
            'score_id' => 'required|integer',
            'date_time' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [
            'meal_type_id' => __('fields.meal.type'),
            'score_id' => __('fields.meal.score'),
            'date_time' => __('fields.meal.date_time'),
        ];
    }
}
