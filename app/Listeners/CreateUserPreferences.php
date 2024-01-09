<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\DateFormat;
use App\Models\HydrationUnit;
use App\Models\Language;
use App\Models\MeasurementUnit;
use App\Models\UserPreference;
use App\Models\WeightUnit;
use Database\Seeders\DateFormatSeeder;
use Database\Seeders\HydrationUnitSeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\MeasurementUnitSeeder;
use Database\Seeders\WeightUnitSeeder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserPreferences
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;

        $weightUnit = WeightUnit::where('description', WeightUnitSeeder::getData()[0]['description'])->first();
        $measurementUnit = MeasurementUnit::where('description', MeasurementUnitSeeder::getData()[0]['description'])->first();
        $hydrationUnit = HydrationUnit::where('description', HydrationUnitSeeder::getData()[0]['description'])->first();
        $language = Language::where('description', LanguageSeeder::getData()[0]['description'])->first();
        $dateFormat = DateFormat::where('description', DateFormatSeeder::getData()[0]['description'])->first();

        UserPreference::create([
            'user_id' => $user->id,
            'weight_unit_id' => $weightUnit->id,
            'measurement_unit_id' => $measurementUnit->id,
            'hydration_unit_id' =>$hydrationUnit->id,
            'language_id' => $language->id,
            'date_format_id' => $dateFormat->id
        ]);
    }
}
