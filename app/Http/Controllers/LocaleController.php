<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocaleController extends Controller
{
    public function set(string $locale) {
        $user = Auth::user();

        $user->locale = $locale;
        $user->save();

        return redirect()->back();
    }
}
