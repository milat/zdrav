<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Training extends Model
{
    protected $fillable = [
        'user_id',
        'training_category_id',
        'score_id',
        'length',
        'date_time',
        'note',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(TrainingCategory::class, 'training_category_id', 'id');
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class);
    }
}
