<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "admin"], function () {

    Route::post("/add-category", [CategoryController::class, "addCategory"]);
    Route::post("/get-category", [CategoryController::class, "getCategory"]);
});
