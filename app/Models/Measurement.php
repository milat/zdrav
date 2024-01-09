<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Measurement extends Model
{
    protected $fillable = [
        'user_id',
        'measurement_unit_id',
        'score_id',
        'neck',
        'left_biceps',
        'right_biceps',
        'left_forearm',
        'right_forearm',
        'chest_bust',
        'abdomen',
        'waist',
        'hips',
        'left_thigh',
        'right_thigh',
        'left_calf',
        'right_calf',
        'left_ankle',
        'right_ankle',
        'date',
        'note',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(MeasurementUnit::class, 'measurement_unit_id', 'id');
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class);
    }
}
