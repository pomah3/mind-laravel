<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\{
    Transaction,
    User,
    Cause
};

use App\ViewModels\TransactionViewModel;
use App\Http\Resources\StudentResource;

class PointsController extends Controller {
    public function of_student(User $student) {
        $this->authorize("see-points", $student);

        return view(
            "points.show",
            new TransactionViewModel(
                $student,
                Transaction::of_student($student)->get()
            )
        );
    }

    public function mine() {
        $this->authorize("receive-points");
        return $this->of_student(Auth::user());
    }

    public function add_index() {
        $this->authorize("add-index-points");

        $students = StudentResource::collection(
            User::where("type", "student")
            ->get()
            ->sort(\App\Utils::get_student_cmp())
        );

        $causes = Cause::orderBy("points")
            ->get()
            ->filter(function($cause) {
                return \App\Role::has_complex_role(Auth::user(), $cause->access);
            })
            ->values();

        return view("points.add", [
            "causes" => $causes,
            "students" => $students
        ]);
    }

    public function add(Request $request) {
        $data = $request->validate([
            "student_id" => "required|exists:users,id",
            "cause_id" => "required|exists:causes,id"
        ]);

        $student = User::find($data["student_id"]);
        $cause   = Cause::find($data["cause_id"]);

        $this->authorize("add-points", $student, $cause);

        Transaction::add(Auth::user(), $student, $cause);

        return redirect("/points/add")->with("status", "ok");
    }

    public function give_index() {
        $this->authorize("give-index-points");

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

        $this->authorize("give-points", $student);

        $points = intval($data['points']);

        if ($points >= Auth::user()->student()->get_balance())
            return redirect("/points/give")->withErrors("У вас нет стольки баллов");

        Transaction::add(Auth::user(), $student, Cause::where("title", "Передача баллов")->first(), $points);

        return redirect("/points/give")->with("status", "ok");
    }
}

