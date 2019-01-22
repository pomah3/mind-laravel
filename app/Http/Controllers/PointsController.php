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
            "transactions" => Transaction::of_student($student)->orderBy("created_at", "desc")->get()
        ]);
    }

    public function mine() {
        return $this->of_student(Auth::user());
    }

    public function add_index() {
        return view("points.add", [
            "causes" => Cause::orderBy("points")->get(),
            "students" => StudentResource::collection(User::where("type", "student")->get())
        ]);
    }

    public function add(Request $request) {
        $data = $request->validate([
            "student_id" => "required|exists:users,id",
            "cause_id" => "required|exists:causes,id"
        ]);

        $student = User::find($data["student_id"]);
        $cause   = Cause::find($data["cause_id"]);
        Transaction::add(Auth::user(), $student, $cause);

        return redirect("/points/add")->with("status", "ok");
    }
}

