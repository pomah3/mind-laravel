<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\transaction;
use Illuminate\Support\Facades\DB;

Route::middleware("api_token")->group(function() {

    Route::prefix("/users")->group(function() {
        Route::get('', function() {
            return User::all();
        });

        Route::get('{user}', function (User $user) {
            return $user;
        });

        Route::get("/check/{user}/{password}", function (User $user, $password) {
            return [
                "data" => $user->password == $password
            ];
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
            return Transaction::of_student($user);
        });
        Route::post("/add", function(Request $request) {
            //todo
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


