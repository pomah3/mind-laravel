<?php

namespace App\Http\Requests;

use App\Services\UserSelectService;

trait UserSelectTrait {
    public function get_users() {
        $user_select = resolve(UserSelectService::class);

        $users = collect();
        foreach ($this->users as $user_raw) {
            $user_raw = json_decode($user_raw, true);
            $user_raw = $user_select->get_users($user_raw);
            $users = $users->merge($user_raw);
        }

        return $users;
    }
}
