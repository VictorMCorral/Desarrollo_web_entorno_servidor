<?php

namespace App\Models;

use MongoDB\Client;

class Database{
    private $db;

    public function __construct(){
        try {
            $client = new Client("mongodb://developer:devpassword@db:27017");
            
            $this->db = $client->empledepart;
            
            error_log("Conexion exitosa a MongoDB");
        } catch (\Exception $e){
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }


    public function loadDeps(){
        $collection = $this->db->depart;
        $deps = $collection->find();

        return $deps;
    }


    public function loadDep($id){
        $collection = $this->db->depart;
        $deps = $collection->findOne($id);
        return $deps;
    }


    public function delDep($claveValor){
        $collection = $this->db->depart;
        $collection->deleteOne($claveValor);
    }

    public function updateDep($dept_no, $dnombre, $loc){
        $collection = $this->db->depart;
        $dep = $this->loadDep(["dept_no" => $dept_no]);
        $collection->updateOne(["dept_no" => intval($dept_no)], ['$set' => ["dnombre"=>$dnombre, "loc" => $loc]]);
    }

    public function addDep($dept_no, $dnombre, $loc){
        $collection = $this->db->depart;
        $collection->insertOne([
                            "dept_no" => $dept_no,
                            "dnombre" => $dnombre,
                            "loc" => $loc]
                            );
    }
}
