<?php

namespace App\Controllers;

use App\Models\Database;

use App\Models\Depart;

class HomeControllers{
    private $mi_model;

    public function __construct(){
        $this->mi_model = new Database();
    }

    public function index(){
        require __DIR__ . "/../Views/home.php";
    }

    public function listDepart(){
        $departamentos =$this->mi_model->loadDeps();
        $empleados = $this->mi_model->loadEmples();

        require __DIR__ . "/../Views/depart.php";
    }    


    public function eliminarDept($data){
        $cantidad = $this->mi_model->comprobarEmple($data['dept_no']);
        if($cantidad == 0){
            $this->mi_model->eliminarDept($data['dept_no']);
        } else {
            error_log("El departamento tiene {$cantidad}");
            header("Location: /listDepart");
        }

        header("Location: /listDepart");
    }

    public function eliminarEmple($data){
            $this->mi_model->eliminarEmple($data['emple_no']);
        header("Location: /listDepart");
    }

    public function modificarDept($data){
        $departamento = $this->mi_model->loadDep($data['dept_no']);
        
        $dept_no = $departamento->dept_no;
        $dnombre = $departamento->dnombre;
        $loc = $departamento->loc;

        require __DIR__ . "/../Views/modificar.php";
        
    }

    public function modificarDept2($data){
        $dept_no = $data['dept_no'];
        $dnombre = $data['dnombre'];
        $loc = $data['loc'];

        $this ->mi_model->modificarDept($dept_no, $dnombre, $loc);
        header("Location: /listDepart");
    }

    public function addDepart(){
        require __DIR__ . "/../Views/agregar.php";
    }

    public function addDepart2($data){
        $dept_no = $data['dept_no'];
        $dnombre = $data['dnombre'];
        $loc = $data['loc'];

        $this ->mi_model->agregarDatos($dept_no, $dnombre, $loc);

        header("Location: /listDepart");
    }
}
