<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangelogController extends Controller {
    public function index(Request $query) {
        if ($query->show_not_published)
            $versions = config("versions.all");
        else
            $versions = config("versions.published");

        $versions = collect($versions)->reverse();
        $current = last(config("versions.published"));

        return view("changelog", [
            "versions" => $versions,
            "current" => $current
        ]);
    }
}
