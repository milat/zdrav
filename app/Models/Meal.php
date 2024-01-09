<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meal extends Model
{
    protected $fillable = [
        'user_id',
        'meal_type_id',
        'score_id',
        'date_time',
        'note'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(MealType::class, 'meal_type_id', 'id');
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class);
    }
}
