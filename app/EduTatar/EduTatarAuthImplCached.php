<?php

namespace App\EduTatar;
use Illuminate\Support\Facades\Cache;

class EduTatarAuthImplCached extends EduTatarAuthImpl  {
    public function get_key($login, $password) {
        return Cache::remember("edu.$login.dnsid", 30, function() use ($login, $password) {
            return parent::get_ket($login, $password);
        });
    }
}
