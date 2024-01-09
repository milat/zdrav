<?php

namespace App\Repositories;

use App\Models\WeightUnit;

class WeightUnitRepository extends Repository
{
    public static function get()
    {
        return WeightUnit::all();
    }
}
