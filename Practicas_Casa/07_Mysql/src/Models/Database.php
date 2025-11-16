<?php

namespace App\Models;

use PDO;
use PDOException;

class Database{
    private $pdo;

    public function __construct(){
        try {
            $this->pdo = new PDO('mysql:host=db;dbname=myapp', 'developer', 'devpassword');
            $this->pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public function consulta($instruccion, $parametros = []){
        try {

            $stmt = $this->pdo->prepare($instruccion);
            $stmt->execute($parametros);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e){
            die("Error en la consulta: " . $e->getMessage());
        }
    }

    public function consultaDML($instruccion, $parametros = []){
        try {

            $stmt = $this->pdo->prepare($instruccion);
            $stmt->execute($parametros);
            return $stmt->rowCount();

        } catch (PDOException $e){
            die("Error en la consulta: " . $e->getMessage());
        }
    }

    public function loadDeps(){
        return $this->consulta("SELECT * FROM depart");
    }

    public function loadEmple(){
        return $this->consulta("SELECT * FROM emple");
    }

    public function loadDep($id){
        return $this->consulta("SELECT * FROM depart WHERE dept_no = :id", [":id"=>$id]);
    }

    public function eliminarDept($dept_no){
        $this->consultaDML("DELETE FROM depart WHERE dept_no = :dept_no", [":dept_no" => $dept_no]);
    }

    public function modificarDept($dept_no, $dnombre, $loc){
        $this->consultaDML("UPDATE depart SET dnombre = :dnombre, loc = :loc WHERE dept_no = :dept_no",    
        [":dept_no" => $dept_no, ":dnombre" => $dnombre, ":loc" => $loc]);
    }

    public function addDepart($dept_no, $dnombre, $loc){
        $this->consultaDML("INSERT INTO depart VALUES (:dept_no, :dnombre, :loc)", [":dept_no" => $dept_no, ":dnombre" => $dnombre, ":loc" => $loc]);
    }
}
