<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'weight_unit_id',
        'measurement_unit_id',
        'hydration_unit_id',
        'language_id',
        'date_format_id'
    ];

    public function weightUnit(): BelongsTo
    {
        return $this->belongsTo(WeightUnit::class);
    }

    public function measurementUnit(): BelongsTo
    {
        return $this->belongsTo(MeasurementUnit::class);
    }

    public function hydrationUnit(): BelongsTo
    {
        return $this->belongsTo(HydrationUnit::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function dateFormat(): BelongsTo
    {
        return $this->belongsTo(DateFormat::class);
    }
}
