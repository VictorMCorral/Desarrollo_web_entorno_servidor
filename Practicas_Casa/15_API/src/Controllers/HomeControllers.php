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

    public function create(){
        $datos = json_decode(file_get_contents("php://input"), true);
        print_r($datos);
        $this->database->create($datos["depart_no"], $datos["dnombre"], $datos["loc"]);
        http_response_code(201);
        echo json_encode(["mensaje" => "Departamento creado exitosamente"]);
    }

    public function update($id){
        $datos = json_decode(file_get_contents("php://input"), true);
        print_r($datos);
        $this->database->update($id, $datos["dnombre"], $datos["loc"]);
        http_response_code(200);
        echo json_encode(["mensaje" => "Departamento con ID $id actualizado exitosamente"]);
    }

    public function delete($id){
        $this->database->delete($id);
        http_response_code(200);
        echo json_encode(["mensaje" => "Departamento con ID $id eliminado exitosamente"]);
    }
}
