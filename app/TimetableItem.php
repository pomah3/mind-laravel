<?php

namespace App;

interface TimetableItem {
    public function get_start();
    public function get_end();
    public function get_title();
    public function get_url();
}
