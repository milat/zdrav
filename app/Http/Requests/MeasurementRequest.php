<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeasurementRequest extends FormRequest
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
            'neck' => 'nullable|decimal:1',
            'left_biceps' => 'nullable|decimal:1',
            'right_biceps' => 'nullable|decimal:1',
            'left_forearm' => 'nullable|decimal:1',
            'right_forearm' => 'nullable|decimal:1',
            'chest_bust' => 'nullable|decimal:1',
            'abdomen' => 'nullable|decimal:1',
            'waist' => 'nullable|decimal:1',
            'hips' => 'nullable|decimal:1',
            'left_thigh' => 'nullable|decimal:1',
            'right_thigh' => 'nullable|decimal:1',
            'left_calf' => 'nullable|decimal:1',
            'right_calf' => 'nullable|decimal:1',
            'left_ankle' => 'nullable|decimal:1',
            'right_ankle' => 'nullable|decimal:1',
            'date' => 'required|date'
        ];
    }

    public function attributes(): array
    {
        return [
            'score_id' => __('fields.measurement.score'),
            'neck' => __('fields.measurement.neck'),
            'left_biceps' => __('fields.measurement.left_biceps'),
            'right_biceps' => __('fields.measurement.right_biceps'),
            'left_forearm' => __('fields.measurement.left_forearm'),
            'right_forearm' => __('fields.measurement.right_forearm'),
            'chest_bust' => __('fields.measurement.chest_bust'),
            'abdomen' => __('fields.measurement.abdomen'),
            'waist' => __('fields.measurement.waist'),
            'hips' => __('fields.measurement.hips'),
            'left_thigh' => __('fields.measurement.left_thigh'),
            'right_thigh' => __('fields.measurement.right_thigh'),
            'left_calf' => __('fields.measurement.left_calf'),
            'right_calf' => __('fields.measurement.right_calf'),
            'left_ankle' => __('fields.measurement.left_ankle'),
            'right_ankle' => __('fields.measurement.right_ankle'),
            'date' => __('fields.measurement.date'),
        ];
    }
}
