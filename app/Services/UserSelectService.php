<?php

namespace App\Services;

interface UserSelectService {
    public function get_variants();
    public function get_users($variant);
}
