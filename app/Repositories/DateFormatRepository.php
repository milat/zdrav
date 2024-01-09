<?php

namespace App\Repositories;

use App\Models\DateFormat;

class DateFormatRepository extends Repository
{
    public static function get()
    {
        return DateFormat::all();
    }
}
