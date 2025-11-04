<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

use App\Models\Pizzas;

class Database{

    public function __construct(){
        try {
            $capsule = new Capsule;

            $capsule->addConnection([
                "driver" => 'mysql',
                "host" => 'db',
                "database" => 'myapp',
                "username" => 'developer',
                "password" => 'devpassword',
                "charset" => 'utf8mb4',
                "collation" => 'utf8mb4_unicode_ci',
                "prefix" => '',
            ]);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            error_log("consexion exitosa a la base de datos con Eloquent. ");
        } catch (\Exception $e) {
            die("Error al conectar a la base de datos: " . $e ->getMessage());
        };
    }

    public function loadPizzas (){
        return Pizzas::all();
    }

    public function loadPizza ($id){
        return Pizzas::find($id);
    }

    public function guardarDatos($id, $nombre, $ingredientes, $alergenos, $precio){
        $pizza = $this->loadPizza($id);
        $pizza->nombre = $nombre;
        $pizza->ingredientes = $ingredientes;
        $pizza->alergenos = $alergenos;
        $pizza->precio = $precio;
        $pizza->save();
    }

    public function delPizza($id){
        $pizza = $this->loadPizza($id);
        $pizza->delete();
    }

    public function addDatos($nombre, $ingredientes, $alergenos, $precio){
        $pizza = new Pizzas();
        $pizza->nombre = $nombre;
        $pizza->ingredientes = $ingredientes;
        $pizza->alergenos = $alergenos;
        $pizza->precio = $precio;
        $pizza->save();
    }
}