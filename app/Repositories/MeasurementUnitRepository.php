<?php

namespace App\Repositories;

use App\Models\MeasurementUnit;

class MeasurementUnitRepository extends Repository
{
    public static function get()
    {
        return MeasurementUnit::all();
    }
}
