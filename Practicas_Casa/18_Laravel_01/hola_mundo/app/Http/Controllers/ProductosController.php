<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function mostrarManual(){
        $contenido = file_get_contents(storage_path("app/datos.txt"));
        return $contenido;
    }


    public function mostrar(){
        $contenido = file_get_contents(storage_path("app/datos.txt")) . " de forma mas automatizada";
        return view("Prueba.prueba", ["contenido" => $contenido]);
    }
}
