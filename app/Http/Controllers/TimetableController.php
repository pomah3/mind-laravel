<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Repositories\TimetableRepository;
use App\User;
use App\ViewModels\TimetableViewModel;
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
        $lessons = $this->ttr->get_items(
            $user,
            now()->startOfWeek(),
            now()->endOfWeek()
        );

        return view(
            "timetable.show",
            new TimetableViewModel($lessons, $user)
        );
    }
}
