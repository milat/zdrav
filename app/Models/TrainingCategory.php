<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingCategory extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'is_active'
    ];

    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class, 'training_category_id', 'id');
    }
}
