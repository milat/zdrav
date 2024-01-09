<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'password' => ['nullable', 'confirmed', 'min:8', 'max:32']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('fields.user.name'),
            'password' => __('fields.user.password'),
        ];
    }
}
