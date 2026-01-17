<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post("/login", [AuthController::class, "login"]);

Route::post("/register", [AuthController::class, "register"]);

Route::middleware(["auth:sanctum"])->group(function () {

    Route::apiResource("products", ProductController::class);

    Route::get("/user", [AuthController::class, "user"]);

    Route::get("/logout", [AuthController::class, "logout"]);

});

//Otra forma 
// Route::get("/login", AuthController::class, "login");
// Route::apiResource("products", ProductController::class)->middleware("auth:sanctum");
// Route::get("/user", AuthController::class, "user")->middleware("auth:sanctum");
// Route::get("/logout", AuthController::class, "logout")->middleware("auth:sanctum");
