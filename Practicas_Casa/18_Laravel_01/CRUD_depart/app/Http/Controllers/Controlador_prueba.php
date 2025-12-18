<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depart;
use App\Models\Emple;

class Controlador_prueba extends Controller
{
    public function prueba2($nombre){
        echo "<h1>Hola " . $nombre . " esto es una prueba desde prueba2</h1>";
    }

    public function prueba3($nombre = "Pepito"){
        echo "<h1>Hola " . $nombre . " esto es una prueba desde prueba3</h1>";
    }

    public function departamento(Depart $dpto){
        error_log($dpto);
        if($dpto){
            echo "<h1>Hola " . $dpto->dnombre . " esto es una prueba desde prueba3</h1>";
        } else {
            echo "Es nulo";
        }
    }

    public function empleado(Emple $emple){
        if($emple){
            echo "<h1>Hola " . $emple->apellido . " esto es una prueba desde prueba3</h1>";
        } else {
            echo "Es nulo";
        }
    }

    public function formprueba1(){
        return view("formprueba");
    }

    public function formprueba(Request $request){
        $request->validate([
            "nombre" => "required|string|max:5"
        ]);

        // $nombre = $request->input("nombre");
        // $nombre = $request->nombre;
        $nombre = $request->get("nombre");
        return redirect()->route("form.show")->with("success", $nombre . " Agregado correctamente");
    }
}
