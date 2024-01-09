<?php

namespace App\Repositories;

use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserPreferenceRequest;

class UserPreferenceRepository extends Repository
{
    public static function get()
    {
        return UserPreference::where('user_id', Auth::user()->id)->first();
    }

    public static function update(UserPreferenceRequest $request)
    {
        $preference = self::get();

        $preference->weight_unit_id = $request->weight_unit_id;
        $preference->measurement_unit_id = $request->measurement_unit_id;
        $preference->hydration_unit_id = $request->hydration_unit_id;
        $preference->language_id = $request->language_id;
        $preference->date_format_id = $request->date_format_id;

        return $preference->save();
    }
}
