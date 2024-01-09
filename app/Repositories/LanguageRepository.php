<?php

namespace App\Repositories;

use App\Models\Language;

class LanguageRepository extends Repository
{
    public static function get()
    {
        return Language::all();
    }
}
