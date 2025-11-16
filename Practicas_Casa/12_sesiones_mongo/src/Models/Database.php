<?php

namespace App\Models;

use MongoDB\Client;

class Database{
    private $db;

    public function __construct(){
        try {
            $client = new Client("mongodb://developer:devpassword@db:27017");
            
            $this->db = $client->users;
            
            error_log("Conexion exitosa a MongoDB");
        } catch (\Exception $e){
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public function loadUsers($usuario){
        $collection = $this->db->Usuarios;
        $usuarios = $collection->findOne(["username" => $usuario]);

        return $usuarios;
    }




}
