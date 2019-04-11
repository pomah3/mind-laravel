<?php

namespace App\ViewModels;

use App\Lesson;
use App\TimetableItem;
use Illuminate\Support\Facades\Auth;

trait TimetableUtils {
    public function number(TimetableItem $item) {
        if ($item instanceof Lesson) {
            return $item->get_number();
        }

        return "";
    }

    public function sort_events($events) {
        return collect($events)->sortBy(function($event) {
            return $event->get_start();
        });
    }
}
