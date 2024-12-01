<?php

use App\Http\Controllers\UserController; 
use App\Http\Controllers\Views\BackendViewController;
use App\Http\Controllers\Views\FrontendViewController;
use Illuminate\Support\Facades\Route;


Route::group(["prefix" => "admin"], function () {

    Route::get("/login",[BackendViewController::class,"login"]);
    Route::post("/login", [UserController::class, "login"]);

    Route::middleware(["auth"])->group(function(){

        Route::get("/", [BackendViewController::class, "index"]);
        Route::get("/category", [BackendViewController::class, "category"]);
        Route::get("/content", [BackendViewController::class, "content"]);

    });


});

Route::group(["prefix"=>"/"],function(){
    Route::get("/",[FrontendViewController::class,"index"]);
});