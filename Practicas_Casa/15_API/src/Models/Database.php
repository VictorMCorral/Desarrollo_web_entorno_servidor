<?php

namespace App\Models;

use PDO;
use PDOException;

class Database{
    private $pdo;

    public function __construct($host, $database, $username, $password)
    {
        try {
            $this->pdo = new PDO(
                "mysql:host={$host};dbname={$database};", $username, $password);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log("Conexión exitosa a la base de datos.");
        } catch (PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        };
    }
    public function query($instruccion, $parametros = []){
        try {
            $stmt = $this->pdo->prepare($instruccion);
            $stmt->execute($parametros);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e){
            die("Error en la consulta: " . $e->getMessage());
        }
    }
    public function execute($instruccion, $parametros = []){
        try{
            $stmt = $this->pdo->prepare($instruccion);
            $stmt->execute($parametros);
            return $stmt->rowCount();
        } catch(PDOException $e){
            die("Error en la ejecución: " . $e->getMessage());
        }
    }


    public function getAll(){
        return $this->query("SELECT * FROM depart");
    }

    public function getId($id){
        return $this->query("SELECT * FROM depart WHERE depart_no=:id", ["id" => $id]);
    }

    public function create($depart_no, $dnombre, $loc){
        return $this->execute("INSERT INTO depart(depart_no, dnombre, loc) VALUES(:depart_no, :dnombre, :loc)", 
                            ["depart_no" => $depart_no, "dnombre" => $dnombre, "loc" => $loc ]);
    }

    public function update($depart_no, $dnombre, $loc){
        return $this->execute("UPDATE depart SET dnombre = :dnombre, loc=:loc WHERE depart_no=:depart_no" ,
        ["depart_no" => $depart_no, "dnombre" => $dnombre, "loc" => $loc]);
    }

    public function delete($id){
        return $this->execute("DELETE FROM depart WHERE depart_no=:id", ["id"=> $id]);
    }
}
