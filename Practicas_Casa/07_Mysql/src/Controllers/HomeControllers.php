<?php

namespace App\Controllers;

use App\Models\Database;

class HomeControllers{
    private $mi_model;

    public function __construct(){
        $this->mi_model = new Database();
    }

    public function index(){
        require __DIR__ . "/../Views/home.php";
    }

    public function listDepart(){
        $departamentos = $this->mi_model->loadDeps();

        require __DIR__ . "/../Views/depart.php";
    }    

    public function listEmple(){
        $empleados = $this->mi_model->loadEmple();
        $departamentos = $this->mi_model->loadDeps();

        require __DIR__ . "/../Views/emple.php";
    }    


    public function eliminarDept($data){
        $this->mi_model->eliminarDept($data['dept_no']);

        header("Location: /listDepart");
    }

    public function modificarDept($data){
        $departamento = $this->mi_model->loadDep($data['dept_no']);
        $dept_no = $departamento[0]['dept_no'];
        $dnombre = $departamento[0]['dnombre'];
        $loc = $departamento[0]['loc'];

        require __DIR__ . "/../Views/modificar.php";
        
    }

    public function modificarDept2($data){
        $dept_no = $data['dept_no'];
        $dnombre = $data['dnombre'];
        $loc = $data['loc'];

        $this ->mi_model->modificarDept($dept_no, $dnombre, $loc);
        //Pendiente de terminar
        header("Location: /listDepart");
    }

    public function addDepart(){
        require __DIR__ . "/../Views/agregar.php";
    }

    public function addDepart2($data){
        $dept_no = $data['dept_no'];
        $dnombre = $data['dnombre'];
        $loc = $data['loc'];

        $this ->mi_model->addDepart($dept_no, $dnombre, $loc);

        header("Location: /listDepart");
    }
}
