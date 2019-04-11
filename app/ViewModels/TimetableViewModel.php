<?php

namespace App\ViewModels;

use App\User;
use Spatie\ViewModels\ViewModel;

class TimetableViewModel extends ViewModel {
    use ViewModelUtils;

    public $lessons;
    public $user;
    public $lessons_by_day;

    public function __construct($lessons, User $user) {
        $this->lessons = $lessons;
        $this->user = $user;

        $this->dayize_lessons();
    }

    public function days() {
        return [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
        ];
    }

    private function dayize_lessons() {
        $this->lessons_by_day = [];
        foreach ($this->days() as $day) {
            $this->lessons_by_day[$day] = [];
        }

        foreach ($this->lessons as $lesson) {
            $day = $lesson->get_start()->format('l');
            $this->lessons_by_day[$day][] = $lesson;
        }
    }
}
