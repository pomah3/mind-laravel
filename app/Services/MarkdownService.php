<?php

namespace App\Services;

interface MarkdownService {
    public function get_file(string $file): string;
    public function get(string $content): string;
}
