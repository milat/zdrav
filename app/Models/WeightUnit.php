<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightUnit extends Model
{
    protected $fillable = [
        'description',
        'abbreviation'
    ];
}
