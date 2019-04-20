<?php

use App\Cause;
use App\EduTatarAuth;
use App\Http\Resources\LessonResource;
use App\Http\Resources\StudentResource;
use App\Http\Resources\TimetableItemResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Repositories\GroupRepository;
use App\Repositories\TimetableRepository;
use App\Services\TransactionService;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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
                    return ["data" => false];

                $user->edu_tatar_login = $login;
                $user->edu_tatar_password = $password;
                $user->save();

                return ["data" => true, "id" => $user->id];
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

    Route::get("/timetable/{user}/{from?}/{until?}",
        function(TimetableRepository $ttr, User $user, $from=null, $until=null) {
            $from = $from ?? now()->startOfWeek();
            $until = $until ?? now()->endOfWeek();
            $lessons = $ttr->get_items($user, $from, $until);
            return TimetableItemResource::collection($lessons);
        }
    );
});


