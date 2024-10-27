<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Views\BackendViewController;
use App\Http\Controllers\Views\FrontendViewController;
use Illuminate\Support\Facades\Route;

Route::get("/login",function(){
    return "login";
});

Route::group(["prefix" => "admin"], function () {

    Route::get("/", [BackendViewController::class, "index"]);
    Route::get("/category", [BackendViewController::class, "category"]);

});

Route::group(["prefix"=>"/"],function(){
    Route::get("/",[FrontendViewController::class,"index"]);
});