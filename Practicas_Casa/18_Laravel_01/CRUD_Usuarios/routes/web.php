<?php

use App\Http\Controllers\ControladorCrud;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/index', [ControladorCrud::class, "index"]);
// Route::get('/create', [ControladorCrud::class, "create"]);
// Route::post('/store', [ControladorCrud::class, "store"]);

Route::get('/', [ControladorCrud::class, "indice"])->name("indice");
Route::get('/usuarios', [ControladorCrud::class, "index"])->name("usuarios.index");
Route::get('/usuarios/create', [ControladorCrud::class, "create"])->name("usuarios.create");
Route::post('/usuarios', [ControladorCrud::class, "store"])->name("usuarios.store");
Route::get('/usuarios/{id}', [ControladorCrud::class, "show"])->name("usuarios.show");
Route::get('/usuarios/{id}/edit', [ControladorCrud::class, "edit"])->name("usuarios.edit");
Route::put('/usuarios/{id}', [ControladorCrud::class, "update"])->name("usuarios.update");
Route::delete('/usuarios/{id}', [ControladorCrud::class, "destroy"])->name("usuarios.destroy");