<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

use App\Models\Depart;
use App\Models\Emple;

class Database{

    public function __construct($host, $database, $username, $password){
        try {
            $capsule = new Capsule;

            $capsule->addConnection([
                "driver" => 'mysql',
                "host" => $host,
                "database" => $database,
                "username" => $username,
                "password" => $password,
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

    public function loadUser(){
        
    }

}