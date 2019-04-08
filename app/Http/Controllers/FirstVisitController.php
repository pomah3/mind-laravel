<?php

namespace App\Http\Controllers;

use App\Services\MarkdownService;
use Illuminate\Http\Request;

class FirstVisitController extends Controller {
    private $markdown;

    public function __construct(MarkdownService $markdown) {
        $this->markdown = $markdown;
    }

    public function __invoke() {
        return view("first_visit", [
            "text" => $this->markdown->get_file(
                resource_path("content/personal-data-consent.md")
            )
        ]);
    }
}
