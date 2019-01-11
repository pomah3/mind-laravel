<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Transaction, User};
use Illuminate\Support\Facades\Auth;

class Points extends Controller {
    public function of_student(User $student) {
        if ($student->type !== "student")
            abort(404);

        return view("points.show", [
            "student" => $student,
            "transactions" => Transaction::of_student($student)
        ]);
    }

    public function mine() {
        return $this->of_student(Auth::user());
    }

    public function add_index() {
        return view("points.add", ["status" => "not_set"]);
    }

    public function add(Request $request) {
        $student = User::find(intval($request->student_id));
        Transaction::add(Auth::user(), $student, intval($request->points));

        return view("points.add", ["status" => "ok"]);
    }
}
