<?php

use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;

Route::get('/*', function () {
    return "<h1>Hola mundo enviado directamente</h1>";
});



Route::get('/', function () {
    return response()->json(["Usuario" => "Victor", "Apellido" => "Corral", "Apellido 2" => "Ruiz"]);
});

Route::get("/prueba", function (){
    //Pruba con php normal
    $path = __DIR__ . "/../public/static.html";
    $contenido = file_get_contents($path);
    error_log($contenido);
    echo $contenido;
});


Route::get('/prueba2', function () {
    //Prueba con blade
    $contenido = "Esto es el contenido";
    return view('Prueba.prueba', ["contenido" => $contenido]);
});


Route::get('/prueba3', function () {
    return redirect('static.html');
});

Route::get('/prueba4', function () {
    //Forma Manual
    $controller = new ProductosController;
    $contenido = $controller->mostrarManual() . " de forma manual";
    return view('Prueba.prueba', ["contenido" => $contenido]);
});

Route::get('/prueba5', [ProductosController::class, "mostrar"]);

