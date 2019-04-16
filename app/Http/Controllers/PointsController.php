<?php

namespace App\Http\Controllers;

use App\Cause;
use App\Http\Resources\StudentResource;
use App\Repositories\GroupRepository as Groups;
use App\Services\TransactionService as Trans;
use App\Transaction;
use App\User;
use App\ViewModels\TransactionViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointsController extends Controller {
    private $trs;

    public function __construct(Trans $trs) {
        $this->trs = $trs;
    }

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

    public function add_index(Groups $groups) {
        $this->authorize("add-index-points");

        $students = StudentResource::collection(
            User::students()
            ->get()
            ->sort(\App\Utils::get_student_cmp())
        );

        $causes = Cause::all()
            ->filter(function($cause) {
                return \App\Role::has_complex_role(Auth::user(), $cause->access);
            })
            ->values();

        return view("points.add", [
            "causes" => $causes,
            "students" => $students,
            "pars" => $groups->get_pars(),
            "groups" => $groups->get_names()
        ]);
    }

    public function add(Request $request) {
        $data = $request->validate([
            "student_id" => "required|exists:users,id",
            "cause_id" => "required|exists:causes,id"
        ]);

        $student = User::find($data["student_id"]);
        $cause   = Cause::find($data["cause_id"]);

        $this->authorize("add-points", [$student, $cause]);

        $this->trs->add(Auth::user(), $student, $cause);

        return redirect("/points/add")->with("status", "ok");
    }

    public function give_index() {
        $this->authorize("give-index-points");

        return view("points.give", [
            "students" => StudentResource::collection(
                User::students()
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

        if ($points > Auth::user()->student()->get_balance())
            return redirect("/points/give")->withErrors("У вас нет стольки баллов");

        $this->trs->add(
            Auth::user(),
            $student,
            Cause::where("title", "Передача баллов")->first(),
            $points
        );

        return redirect("/points/give")->with("status", "ok");
    }

    public function delete_transaction(Transaction $tr) {
        $this->authorize("remove-transaction", $tr);

        $tr->delete();

        return "";
    }
}

