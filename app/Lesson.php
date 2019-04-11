<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class Lesson implements TimetableItem {
    private $title;
    private $start;
    private $end;
    private $number;

    public function __construct(string $title, Carbon $start, Carbon $end, int $number) {
        $this->title = $title;
        $this->start = $start;
        $this->end = $end;
        $this->number = $number;
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

    public function get_number() {
        return $this->number;
    }
}
