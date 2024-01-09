<?php

namespace App\Repositories;

use App\Models\TestReference;

class TestReferenceRepository extends Repository
{
    public static function get()
    {
        return TestReference::all();
    }
}
