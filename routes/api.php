<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

use App\User;
use App\EduTatarAuth;
use App\Transaction;
use App\Cause;
use App\Http\Resources\{UserResource, StudentResource};

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
            return Transaction::all();
        });
        Route::get('{tr}', function(Transaction $tr) {
            return $tr;
        });
        Route::get('of_user/{user}', function(User $user) {
            return Transaction::of_student($user)->get();
        });
        Route::post("/add/{from}/{to}/{cause}/{points?}",
            function(User $from, User $to, Cause $cause, ?int $points=null) {
                if ($points !== null) {
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
        Route::get("", function() {
            return DB::table("roles")
                ->select('role_arg as name')
                ->where('role', 'student')
                ->groupBy('role_arg')
                ->orderBy('role_arg')
                ->get();
        });
    });
});


