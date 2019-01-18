<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\{
    Transaction,
    User,
    Cause,
};

use App\Http\Resources\StudentResource;

class PointsController extends Controller {
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
        return view("points.add", [
            "status" => "not_set",
            "causes" => Cause::orderBy("points")->get(),
            "students" => StudentResource::collection(User::where("type", "student")->get())
        ]);
    }

    public function add(Request $request) {
        $student = User::find(intval($request->student_id));
        Transaction::add(Auth::user(), $student, intval($request->points));

        return view("points.add", [
            "status" => "ok",
            "causes" => Cause::orderBy("points")->get(),
            "students" => User::where("type", "student")->get()
        ]);
    }
}
