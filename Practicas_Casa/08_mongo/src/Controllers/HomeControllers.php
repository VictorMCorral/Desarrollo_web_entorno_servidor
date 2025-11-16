<?php

namespace App\Controllers;

use App\Models\Database;

class HomeControllers{
    private $mi_model;

    public function __construct(){
        $this->mi_model = new Database();
    }

    public function loadDeps(){
        $deps = $this->mi_model->loadDeps();
        $contenido = "home.php";
        require __DIR__ . "/../Views/Plantilla.php";
    }

    public function delDeps($data){
        $this->mi_model->delDep(["dept_no" => intval($data['dept_no'])]);

        header("Location: /");
        
    }

    public function updateDeps($data){
        $dep= $this->mi_model->loadDep(["dept_no" => intval($data['dept_no'])]);
        $dept_no = $dep['dept_no'];
        $dnombre = $dep['dnombre'];
        $loc = $dep['loc'];
        $contenido = "modificar.php";

        require __DIR__ . "/../Views/Plantilla.php";
    }
    
    public function updateDeps2($data){
        $this->mi_model->updateDep($data['dept_no'], $data['dnombre'], $data['loc']);

        header("Location: /");
    }

    public function addDep(){

        $contenido = "form_Crear.php";

        require __DIR__ . "/../Views/Plantilla.php";
    }

    public function addDep2($data){
        $dept_no = intval($data['dept_no']);
        $dnombre = $data['dnombre'];
        $loc = $data['loc'];
        $this->mi_model->addDep($dept_no, $dnombre, $loc);
        header("Location: /");
    }
}
