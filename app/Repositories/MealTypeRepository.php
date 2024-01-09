<?php

namespace App\Repositories;

use App\Models\MealType;

class MealTypeRepository extends Repository
{
    public static function get()
    {
        return MealType::all();
    }
}
