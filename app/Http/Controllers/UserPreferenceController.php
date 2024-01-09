<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPreferenceRequest;
use App\Repositories\DateFormatRepository;
use App\Repositories\HydrationUnitRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\MeasurementUnitRepository;
use App\Repositories\UserPreferenceRepository;
use App\Repositories\WeightUnitRepository;
use Illuminate\View\View;

class UserPreferenceController extends Controller
{
    public function view(): View
    {
        return view('user_preference.create')->with([
            'preference' => UserPreferenceRepository::get(),
            'weight_units' => WeightUnitRepository::get(),
            'measurement_units' => MeasurementUnitRepository::get(),
            'hydration_units' => HydrationUnitRepository::get(),
            'languages' => LanguageRepository::get(),
            'date_formats' => DateFormatRepository::get()
        ]);
    }

    public function update(UserPreferenceRequest $request)
    {
        try {
            UserPreferenceRepository::update($request);
            return $this->returnViewWithSuccessMessage('user_preference.view', __('messages.update_success'));
        } catch (\Exception $e) {
            return $this->returnBackWithError($e);
        }
    }
}
