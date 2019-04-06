<?php

namespace App\Services;

use Parsedown;

class MarkdownServiceImpl implements MarkdownService {
    private $parsedown;

    public function __construct() {
        $this->parsedown = new Parsedown;
    }

    public function get_file(string $file): string {
        return $this->get(file_get_contents($file));
    }

    public function get(string $string): string {
        return $this->parsedown->text($string);
    }
}
