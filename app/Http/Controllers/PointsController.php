<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\{
    Transaction,
    User,
    Cause
};

use App\Http\Resources\StudentResource;

class PointsController extends Controller {
    public function __construct() {
        $this->middleware('role:teacher')->only([
            "add_index", "add"
        ]);

        $this->middleware('role:student')->only([
            "give_index", "give"
        ]);
    }

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
             "students" => StudentResource::collection(
                User::where("type", "student")
                ->get()
                ->sort(\App\Utils::get_student_cmp())
            )
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

    public function give_index() {
        return view("points.give", [
            "students" => StudentResource::collection(
                User::where("type", "student")
                ->get()
                ->sort(\App\Utils::get_student_cmp())
            )
        ]);
    }

    public function give(Request $request) {
        $data = $request->validate([
            "student_id" => "required|exists:users,id",
            "points" => "required|min:1"
        ]);

        $student = User::find($data["student_id"]);
        if ($student->type != "student")
            return redirect("/points/give")->withErrors("Баллы только студенту");

        if ($student->id == Auth::user()->id)
            return redirect("/points/give")->withErrors("Самому себе нельзя");

        $points = intval($data['points']);

        if ($points >= Auth::user()->student()->get_balance())
            return redirect("/points/give")->withErrors("У вас нет стольки баллов");

        Transaction::add(Auth::user(), $student, Cause::where("title", "Передача баллов")->first(), $points);

        return redirect("/points/give")->with("status", "ok");
    }
}

