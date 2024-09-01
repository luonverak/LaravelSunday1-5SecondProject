<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Views\BackendViewController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "admin"], function () {

    Route::get("/", [BackendViewController::class, "index"]);
    Route::get("/category", [BackendViewController::class, "category"]);

});

