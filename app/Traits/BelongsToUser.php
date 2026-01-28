<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait BelongsToUser
{
    protected static function bootBelongsToUser()
    {
        static::addGlobalScope('user_id', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('user_id', Auth::id());
            }
        });

        // This part automatically sets user_id when you CREATE a record
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->user_id = Auth::id();
            }
        });
    }
}
