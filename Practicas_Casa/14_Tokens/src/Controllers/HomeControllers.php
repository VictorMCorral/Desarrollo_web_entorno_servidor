<?php

namespace App\Controllers;

use App\Models\Database;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class HomeControllers
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAll(){
        http_response_code(200);
        echo json_encode(["mensaje" => "Listado de todos los departamentos"]);
    }

    public function getId($id){
        http_response_code(200);
        echo json_encode(["mensaje" => "Mostrando departamento con ID: $id"]);
    }

    public function create(){
        http_response_code(201);
        echo json_encode(["mensaje" => "Departamento creado exitosamente"]);
    }

    public function update($id){
        http_response_code(200);
        echo json_encode(["mensaje" => "Departamento con ID $id actualizado exitosamente"]);
    }

    public function delete($id){
        http_response_code(200);
        echo json_encode(["mensaje" => "Departamento con ID $id eliminado exitosamente"]);
    }
}
