<?php

namespace App\Repositories;

use App\Models\HydrationUnit;

class HydrationUnitRepository extends Repository
{
    public static function get()
    {
        return HydrationUnit::all();
    }
}
