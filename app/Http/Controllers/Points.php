<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class Points extends Controller {
    public function of_student(User $student) {
        if ($student->type !== "student")
            abort(404);

        return view("points", [
            "student" => $student,
            "transactions" => Transaction::of_student($student)
        ]);
    }
}
