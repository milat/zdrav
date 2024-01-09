<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Weight extends Model
{
    protected $fillable = [
        'user_id',
        'weight_unit_id',
        'score_id',
        'value',
        'date',
        'note'
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(WeightUnit::class, 'weight_unit_id', 'id');
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class);
    }
}
