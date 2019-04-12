<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangelogController extends Controller {
    public function index(Request $query) {
        $show_not_public = $query->show_not_public ?? false;

        $versions = require base_path("versions.php");
        $versions = collect($versions)->reverse();

        if (!$show_not_public) {
            $versions = $versions->filter(function($version) {
                return $version["public"];
            });
        }

        return view("changelog", [
            "versions" => $versions
        ]);
    }
}
