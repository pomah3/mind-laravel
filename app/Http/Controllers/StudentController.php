<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller {
    public function index() {
        return view("student.show", [
            "students" => User::students()->get()
        ]);
    }
}
