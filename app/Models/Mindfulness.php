<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mindfulness extends Model
{
    protected $fillable = [
        'user_id',
        'score_id',
        'length',
        'date_time',
        'note',
    ];

    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class);
    }
}
