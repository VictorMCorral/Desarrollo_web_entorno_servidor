<?php

namespace App\Controllers;

use App\Models\Database;

use Dotenv\Dotenv;


class HomeControllers
{
    private $database;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../..");
        $dotenv->load();

        $host = $_ENV["DB_HOST"];
        $database = $_ENV["DB_DATABASE"];
        $username = $_ENV["DB_USERNAME"];
        $password = $_ENV["DB_PASSWORD"];
        $this->database = new Database($host, $database, $username, $password);
    }
    public function index(){
        require __DIR__ . "/../Views/cliente.html";
    }

    public function getAll(){
        $departamentos = $this->database->getAll();
        http_response_code(200);
        echo json_encode($departamentos);
    }

    public function getId($id){
        $departamento = $this->database->getId($id);
        http_response_code(200);
        echo json_encode($departamento);
    }

    public function create($userData){
        $datos = json_decode(file_get_contents("php://input"), true);
        print_r($datos);
        $this->database->create($datos["depart_no"], $datos["dnombre"], $datos["loc"]);
        
        http_response_code(201);
        echo json_encode(["mensaje" => "Departamento creado exitosamente",
                        "Creado por: " => $userData["user_id"]]);
    }

    public function update($id, $userData){
        $datos = json_decode(file_get_contents("php://input"), true);
        print_r($datos);
        $this->database->update($id, $datos["dnombre"], $datos["loc"]);
        http_response_code(200);
        echo json_encode(["mensaje" => "Departamento con ID $id actualizado exitosamente",
                        "Actualizado por: " => $userData["user_id"]]);
    }

    public function delete($id, $userData){
        $this->database->delete($id);
        http_response_code(200);
        echo json_encode(["mensaje" => "Departamento con ID $id eliminado exitosamente",
                        "Borrado por: " => $userData["user_id"]]);
    }
}
