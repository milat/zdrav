<?php

namespace App\Repositories;

use App\Models\Score;

class ScoreRepository extends Repository
{
    public static function get()
    {
        return Score::orderBy('value', 'desc')->get();
    }
}
