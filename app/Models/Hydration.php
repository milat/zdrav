<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hydration extends Model
{
    protected $fillable = [
        'user_id',
        'hydration_unit_id',
        'score_id',
        'amount',
        'date',
        'note',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(HydrationUnit::class, 'hydration_unit_id', 'id');
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class);
    }
}
