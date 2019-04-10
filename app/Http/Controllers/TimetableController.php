<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Repositories\TimetableRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimetableController extends Controller {
    private $ttr;

    public function __construct(TimetableRepository $ttr) {
        $this->ttr = $ttr;
    }

    public function show() {
        return $this->show_for_user(Auth::user());
    }

    public function show_for_user(User $user) {
        if ($user == "teacher")
            $view = "timetable.teacher";
        else
            $view = "timetable.student";

        return view($view, [
            "lessons" => $this->ttr->get_lessons($user)
        ]);
    }
}
