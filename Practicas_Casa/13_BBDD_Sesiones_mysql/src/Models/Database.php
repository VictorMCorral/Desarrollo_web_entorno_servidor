<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public function __construct(){
        try {
            $capsule = new Capsule;

            $capsule->addConnection([
                "driver" => 'mysql',
                "host" => 'localhost',
                "database" => 'alumnos',
                "username" => 'root',
                "password" => 'Noteolvides@01',
                "charset" => 'utf8mb4',
                "collation" => 'utf8mb4_unicode_ci',
                "prefix" => '',
            ]);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            error_log("Conexión exitosa a la base de datos con Eloquent.");
        } catch (\Exception $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }


    public function addUser(string $username, string $password): Usuario
    {
        return Usuario::create([
            'username' => $username,
            'password' => $password
        ]);
    }


    public function getUserByName(string $username): ?Usuario
    {
        return Usuario::where('username', $username)->first();
    }


    public function updateCompra(string $username, string $compra): bool
    {
        $usuario = $this->getUserByName($username);
        if($usuario){
            $usuario->compra = $compra;
            return $usuario->save();
        }
        return false;
    }


    public function deleteUser(string $username): bool
    {
        $usuario = $this->getUserByName($username);
        if($usuario){
            return $usuario->delete();
        }
        return false;
    }
}
