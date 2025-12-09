<?php

use App\Http\Controllers\Controlador_Depart;
use App\Http\Controllers\Controlador_Emple;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('departs', Controlador_Depart::class);
Route::resource('emples', Controlador_Emple::class);

