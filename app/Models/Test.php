<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Test extends Model
{
    protected $fillable = [
        'user_id',
        'test_reference_id',
        'description',
        'value',
        'unit',
        'date',
        'note',
    ];

    public function reference(): BelongsTo
    {
        return $this->belongsTo(TestReference::class, 'test_reference_id', 'id');
    }
}
