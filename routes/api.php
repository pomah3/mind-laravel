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

use App\Services\TransactionService;
use App\Repositories\TimetableRepository;
use App\Repositories\GroupRepository;

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

        Route::get("check/edu/{login}/{password}",
            function (App\EduTatar\EduTatarAuth $eta, $login, $password) {
                $user = $eta->get_user($login, $password);

                if (!$user)
                    return response()->json(["error" => "not"], 403); //todo

                $user->edu_tatar_login = $login;
                $user->edu_tatar_password = $password;
                $user->save();

                return new UserResource($user);
            }
        );

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
            function(TransactionService $tr, User $from, User $to, Cause $cause, ?int $points=null) {
                if ($points === null) {
                    if (!Gate::forUser($from)->allows("add-points", $to, $cause))
                        return response()->json(['error'=>"not allowed"], 403);
                } else {
                    if (!Gate::forUser($from)->allows("give-points", $to))
                        return response()->json(['error'=>"not allowed"], 403);
                }

                return $tr->add($from, $to, $cause, $points);
            }
        );
    });

    Route::get("/causes", function() {
        return Cause::all();
    });

    Route::get("/groups", function(GroupRepository $gr) {
        return $gr->get_names();
    });

    Route::get("/timetable/{user}",
        function(TimetableRepository $ttr, User $user) {
            return $ttr->get_lessons($user);
        }
    );
});


