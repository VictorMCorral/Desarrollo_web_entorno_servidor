<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database{
    private $capsule;

    public function __construct($host, $port, $database, $user, $password){
        try {
            $this->capsule = new Capsule;
            $this->capsule->addConnection([
                "driver" => "mysql",
                "host" => $host,
                "database" => $database,
                "username" => $user,
                "password" => $password,
                "charset" => "utf8",
                "collation" => "utf8_unicode_ci",
                "prefix" => "",
            ]);

            $this->capsule->setAsGlobal();
            $this->capsule->bootEloquent();
            error_log("Conexion exitosa con eloquent");
            
        } catch (\Exception $e){
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

}
