<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class Lesson implements TimetableItem {
    private $title;
    private $start;
    private $end;

    public function __construct(string $title, Carbon $start, Carbon $end) {
        $this->title = $title;
        $this->start = $start;
        $this->end = $end;
    }

    public function get_start() {
        return $this->start->copy();
    }

    public function get_end() {
        return $this->end->copy();
    }

    public function get_title() {
        return $this->title;
    }

    public function get_url() {
        return null;
    }
}
