<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TimetableRepository;

class TimetableController extends Controller
{
    public function show(TimetableRepository $tt) {
        return view("timetable.show", [
            "lessons" => $tt->get_lessons(Auth::user())
        ]);
    }
}
