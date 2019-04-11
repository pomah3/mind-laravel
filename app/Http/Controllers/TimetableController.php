<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Repositories\LessonRepository;
use App\User;
use App\ViewModels\TimetableViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimetableController extends Controller {
    private $lessons_repo;

    public function __construct(LessonRepository $lessons_repo) {
        $this->lessons_repo = $lessons_repo;
    }

    public function show() {
        return $this->show_for_user(Auth::user());
    }

    public function show_for_user(User $user) {
        $view = "timetable.student";

        $lessons = $this->lessons_repo->get_lessons(
            $user,
            now()->startOfWeek(),
            now()->endOfWeek()
        );

        return view($view, new TimetableViewModel($lessons, $user));
    }
}
