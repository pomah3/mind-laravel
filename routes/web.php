<?php

Route::get('/', "Profile@index")
    ->middleware("auth")
    ->name("profile");

Route::get('/signin', "Signin@index")
    ->middleware("guest")
    ->name("signin");

Route::post("/signin", "Signin@enter")
    ->middleware("guest");

Route::get("/out", "Signin@logout")
    ->middleware("auth");

Route::get("/setlocale/{locale}", "SetLocale@set")
    ->middleware("auth");
