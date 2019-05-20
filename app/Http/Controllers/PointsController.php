<?php

namespace App\Http\Controllers;

use App\Cause;
use App\Http\Requests\AddPointsRequest;
use App\Http\Requests\GivePointsRequest;
use App\Http\Resources\StudentResource;
use App\Repositories\GroupRepository as Groups;
use App\Repositories\GroupRepository;
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

        $students = User::students()->get()
            ->sort(\App\Utils::get_student_cmp())
            ->map(function($user) {
                return [
                    "name" => $user->get_name(),
                    "value" => $user->id
                ];
            })
            ->values();

        $causes = Cause::all()
            ->filter(function($cause) {
                return \App\Role::has_complex_role(Auth::user(), $cause->access);
            })
            ->map(function($cause) {
                return [
                    "name" => $cause->title,
                    "value" => $cause->id
                ];
            })
            ->values();

        return view("points.add", [
            "causes" => $causes,
            "students" => $students,
            "pars" => $groups->get_pars(),
            "groups" => $groups->get_names()
        ]);
    }

    public function add(AddPointsRequest $req) {
        $this->authorize("add-points", [$req->student(), $req->cause()]);
        $this->trs->add(
            Auth::user(),
            $req->student(),
            $req->cause()
        );

        return redirect()
            ->action("PointsController@add")
            ->with("status", "ok");
    }

    public function give_index() {
        $this->authorize("give-index-points");

        $students = User::students()->get()
            ->sort(\App\Utils::get_student_cmp())
            ->map(function($user) {
                return [
                    "name" => $user->get_name(),
                    "value" => $user->id
                ];
            })
            ->values();

        return view("points.give", [
            "students" => $students
        ]);
    }

    public function give(GivePointsRequest $req) {
        $this->authorize("give-points", $req->student());

        if ($req->points() > Auth::user()->student()->get_balance())
            return redirect()
                ->action("PointsController@give")
                ->withErrors("У вас нет стольки баллов");

        $this->trs->add(
            Auth::user(),
            $req->student(),
            Cause::where("title", "Передача баллов")->first(),
            $req->points()
        );

        return redirect()
            ->action("PointsController@give")
            ->with("status", "ok");
    }

    public function delete_transaction(Transaction $tr) {
        $this->authorize("remove-transaction", $tr);

        $tr->delete();

        return "";
    }

    public function take_off_points_index(GroupRepository $group_repo) {
        $this->authorize("take-off-points");
        return view("points.take_off", [
            "groups" => $group_repo->get_all(),
        ]);
    }

    public function take_off_points(Request $request) {
        $this->authorize("take-off-points");

        $student = User::find($request->student_id);
        $points = -abs(intval($request->points));

        $cause = Cause::where("title", "Покупка на аукционе")->first();
        if (!$cause) {
            $cause = Cause::firstOrCreate([
                "points" => 0,
                "title" => "Покупка на аукционе",
                "access" => '["not", "all"]',
                "category" => "",
            ]);
        }

        $this->trs->add(
            null,
            $student,
            $cause,
            $points
        );

        return redirect()
            ->action("PointsController@take_off_points_index")
            ->with("status", "ok");
    }
}
