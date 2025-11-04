<?php

namespace App\Controllers;

use App\Models\Database;

class HomeControllers2{
    private $mi_model;

    public function __construct(){
        $this->mi_model = new Database();
    }

    public function index(){
        $this->render("home_2", ["tittle" => "Inicio"]);
    }

    public function listDept_2(){
        $deps = $this->mi_model->loadDeps();
        $this->render("home", ["tittle" => "Departamentos", "deps" => $deps]);
    }

    public function actualizar($data){
        $dep= $this->mi_model->loadDep(["dept_no" => intval($data['dept_no'])]);
        $dept_no = $dep['dept_no'];
        $dnombre = $dep['dnombre'];
        $loc = $dep['loc'];
        $this->render("modificar", ["tittle" => "modificar","dept_no"=>$dept_no, "dnombre" =>$dnombre, "loc"=>$loc ]);
    }

    public function modificarDept2($data){
        $this->mi_model->updateDep($data['dept_no'], $data['dnombre'], $data['loc']);

        $this->listDept_2();
    }

    public function delDeps($data){
        $this->mi_model->delDep(["dept_no" => intval($data['dept_no'])]);

        $this->listDept_2();        
    }

    public function about(){
        $this->render("about", ["tittle" => "About"]);
    }

    public function notFound(){
        $this->render("404", ["tittle" => "Pagina no encontrada"]);
    }

    public function crear_2 (){
        $this->render("form_Crear", ["tittle" => "Agregar"]);
    }

    public function crear_2b ($data){
        $dept_no = intval($data['dept_no']);
        $dnombre = $data['dnombre'];
        $loc = $data['loc'];
        $this->mi_model->addDep($dept_no, $dnombre, $loc);
        $this->listDept_2();   
    }

    public function render($view, $data = []){
        extract($data);

        $viewPath = __DIR__ . "/../Views/$view.php";
        if(file_exists($viewPath)){
            ob_start();
            require $viewPath;
            $contenido = ob_get_clean();
        } else {
            $contenido = "<h2>Vista no encontrada</h2>";
        }

        require __DIR__ . "/../Views/plantilla2.php";
    }
}
