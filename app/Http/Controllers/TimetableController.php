<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TimetableRepository;

class TimetableController extends Controller
{
    public function show(TimetableRepository $tt) {
        if (Auth::user()->type == "teacher")
            $view = "timetable.teacher";
        else
            $view = "timetable.student";

        return view($view, [
            "lessons" => $tt->get_lessons(Auth::user())
        ]);
    }
}
