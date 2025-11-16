<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\Usuario;

class Database
{

    public function __construct($host, $database, $username, $password)
    {
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

            error_log("Conexión exitosa a la base de datos.");
        } catch (\Exception $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        };
    }

    public function getUser($username)
    {
        return Usuario::where("username", $username)->first();
    }

    public function loadUser()
    {
        if (isset($_COOKIE['token'])) {
            try {
                $decoded = JWT::decode($_COOKIE['token'], new Key($_ENV['KEY'], 'HS256'));
                return (array)$decoded;
            } catch (\Exception $e) {
                return null;
            }
        }
        return null;
    }


    public function addUser($username, $password, $compra = null)
    {
        $existingUser = Usuario::where('username', $username)->first();
        if ($existingUser) {
            $comprobacion = [
                "success" => false,
                "error" => "El usuario ya existe"
            ];
        } else {
            $user = new \App\Models\Usuario();
            $user->username = $username;
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->compra = $compra;
            $user->save();
            $comprobacion = [
                "success" => true,
                "error" => "Usuario registrado correctamente",
                "user" => $user
            ];
        }
        return $comprobacion;
    }
}
