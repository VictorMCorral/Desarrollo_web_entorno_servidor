<?php

use App\Http\Controllers\Controlador_Depart;
use App\Http\Controllers\Controlador_Emple;
use App\Http\Controllers\Controlador_prueba;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('emple', Controlador_Emple::class);
});


Route::resource('departs', Controlador_Depart::class);
Route::get('/saludo/{nombre}', [Controlador_Emple::class, 'prueba2'])
    ->name('saludo.prueba')
    ->where("nombre", "[a-zA-Z]+");
Route::get('/saludoOpcional/{nombre?}', [Controlador_Emple::class, 'prueba3'])
    ->name('saludo.prueba')
    ->where("nombre", "[a-zA-Z]+");



    //EJEMPLOS prueba
Route::get('/departamento/{dpto}', [Controlador_prueba::class, 'departamento']);
Route::get('/empleado/{emple}', [Controlador_prueba::class, 'empleado']);
Route::post('/formPrueba', [Controlador_prueba::class, 'formprueba'])->name("form.prueba");
Route::get('/formp', [Controlador_prueba::class, 'formprueba1'])->name("form.show");



require __DIR__.'/auth.php';
