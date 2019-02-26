<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

use App\User;
use App\EduTatarAuth;
use App\Transaction;
use App\Cause;
use App\Http\Resources\{UserResource, StudentResource, TransactionResource, LessonResource};

Route::middleware("api_token")->group(function() {

    Route::prefix("/users")->group(function() {
        Route::get('', function() {
            return UserResource::collection(User::all());
        });

        Route::get('{user}', function (User $user) {
            if ($user->type == "student")
                return new StudentResource($user);
            return new UserResource($user);
        });

        Route::get("check/edu/{login}/{password}", function ($login, $password) {
            $user = (new EduTatarAuth)->login($login, $password);

            if (!$user)
                return ["error" => "not"]; //todo

            return new UserResource($user);
        });

        Route::get("check/{user}/{password}", function (User $user, $password) {
            return [
                "data" => $user->password == $password
            ];
        });
    });

    Route::prefix("students")->group(function() {
        Route::get("", function() {
            return StudentResource::collection(User::where("type", "student")->get());
        });

        Route::get("{user}", function(User $user) {
            if ($user->type != "student")
                return response()->json(['error'=>"no student"], 404);
            return new StudentResource($user);
        });
    });


    Route::prefix("/transactions")->group(function() {
        Route::get('', function() {
            return TransactionResource::collection(Transaction::all());
        });

        Route::get('{tr}', function(Transaction $tr) {
            return new TransactionResource($tr);
        });

        Route::get('of_user/{user}', function(User $user) {
            return TransactionResource::collection(
                Transaction::of_student($user)->get()
            );
        });

        Route::post("/add/{from}/{to}/{cause}/{points?}",
            function(User $from, User $to, Cause $cause, ?int $points=null) {
                if ($points === null) {
                    if (!Gate::forUser($from)->allows("add-points", $to, $cause))
                        return response()->json(['error'=>"not allowed"], 403);
                } else {
                    if (!Gate::forUser($from)->allows("give-points", $to))
                        return response()->json(['error'=>"not allowed"], 403);
                }

                return Transaction::add($from, $to, $cause, $points);
            }
        );
    });

    Route::prefix("/causes")->group(function() {
        Route::get('', function() {
            return Cause::all();
        });
    });

    Route::prefix("/groups")->group(function() {
        Route::get("", function(\App\Repositories\GroupRepository $gr) {
            return $gr->get_names();
        });
    });

    Route::prefix("/timetable")->group(function() {
        Route::get("{user}", function(User $user) {
            $group = $user->student()->get_group();
            $lessons = [];
            $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

            foreach($days as $day) {
                $lessons[$day] = App\Lesson::where("weekday", $day)
                                           ->where("group", $group)
                                           ->orderBy("number")
                                           ->get();

                $lessons[$day] = LessonResource::collection($lessons[$day]);
            }

            return $lessons;
        });
    });
});


