<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocController extends Controller
{
    public function __invoke($page = null) {
        if (!$page)
            return redirect("/doc/index.md");

        $page = str_finish($page, ".md");

        if (!Storage::disk("doc")->exists($page))
            abort(404);

        $text = Storage::disk("doc")->get($page);

        return view("doc_base", [
            "text" => (new \Parsedown())->text($text)
        ]);
    }
}
