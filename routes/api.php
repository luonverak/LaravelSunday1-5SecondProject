<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);

Route::group(["prefix" => "admin"], function () {

        Route::middleware("api.admin")->group(function () {
                Route::post("/add-category", [CategoryController::class, "addCategory"]);
                Route::post("/get-category", [CategoryController::class, "getCategory"]);
                Route::post("/edit-category", [CategoryController::class, "editCategory"]);
        });
});
