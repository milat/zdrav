<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected const PER_PAGE = 10;

    protected static function validateOwner(?Model $model): void
    {
        if (!$model) {
            abort(404);
        }
        if ($model->user_id != Auth()->user()->id) {
            abort(401);
        }
    }
}
