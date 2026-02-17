<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait ClearsDashboardCache
{
    public static function bootClearsDashboardCache()
    {
        static::saved(fn($model) => static::clearCache($model));
        static::deleted(fn($model) => static::clearCache($model));
    }

    protected static function clearCache($model)
    {
        // Adjust this to match your Service's key naming
        Cache::forget("dashboard:stats:{$model->user_id}");
    }
}
