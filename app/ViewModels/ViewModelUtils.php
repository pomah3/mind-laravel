<?php

namespace App\ViewModels;

use Illuminate\Support\Facades\Auth;

trait ViewModelUtils {
    public function show_user_name() {
        return $this->user->id != Auth::user()->id;
    }
}
