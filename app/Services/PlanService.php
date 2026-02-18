<?php

namespace App\Services;

use App\Models\Plan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PlanService
{
    public function getActivePlans(): Collection
    {
        return Cache::rememberForever('plans:active', function () {
            return Plan::where('is_active', 1)
                ->orderBy('sort_order')
                ->get();
        });
    }

    public function clearCache(): void
    {
        Cache::forget('plans:active');
    }
}
