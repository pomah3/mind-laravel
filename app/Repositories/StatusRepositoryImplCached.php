<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

class StatusRepositoryImplCached extends StatusRepositoryImpl {
    public function get_statistics_by_day(\DateTime $date) {
        if ($date->copy()->startOfDay() == now()->copy()->startOfDay())
            return parent::get_statistics_by_day($date);

        $sdate = (string) $date;

        return Cache::rememberForever("status.$sdate", function() use ($date) {
            return parent::get_statistics_by_day($date);
        });
    }
}
