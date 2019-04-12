<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangelogController extends Controller {
    public function index(Request $query) {
        $show_not_published = $query->show_not_published ?? false;

        extract(require base_path("versions.php"));
        $versions = collect($versions)->reverse();
        $published = collect($published);

        if (!$show_not_published) {
            $versions = $versions->filter(function($version) use ($published) {
                $published->contains($version["name"]);
            });
        }

        return view("changelog", [
            "versions" => $versions->all()
        ]);
    }
}
