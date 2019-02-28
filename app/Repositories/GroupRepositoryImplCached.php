<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

class GroupRepositoryImplCached extends GroupRepositoryImpl {
    public function get_names() {
        return Cache::remember("group_names", 5, function() {
            return parent::get_names();
        });
    }

    public function get_pars() {
        return Cache::remember("group_pars", 5, function() {
            return parent::get_pars();
        });
    }

    public function get_all() {
        return Cache::remember("group_all", 5, function() {
            return parent::get_all();
        });
    }
}
