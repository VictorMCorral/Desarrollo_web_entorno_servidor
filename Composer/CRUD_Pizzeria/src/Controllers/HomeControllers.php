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

    public function listPizzas(){
        $pizzas = $this->mi_model ->loadPizzas();

        require __DIR__ . "/../Views/pizzas.php";
    }

    public function updatePizza($data){
        $pizza = $this->mi_model->loadPizza($data['id']);

        require __DIR__ . "/../Views/modificar.php";
    }

    public function updatePizza2($data){
        $id = $data['id'];
        $nombre = $data['nombre'];
        $ingredientes = $data['ingredientes'];
        $alergenos = $data['alergenos'];
        $precio = $data['precio'];

        $this->mi_model->guardarDatos($id, $nombre, $ingredientes, $alergenos, $precio);

        header("Location: /listPizzas");
    }

    public function delPizza($data){
        $this->mi_model->delPizza($data['id']);
        header("Location: /listPizzas");
    }

    public function addPizza(){
        require __DIR__ . "/../Views/agregar.php";
    }

    public function addPizza2($data){
        $nombre = $data['nombre'];
        $ingredientes = $data['ingredientes'];
        $alergenos = $data['alergenos'];
        $precio = $data['precio'];

        $this->mi_model->addDatos($nombre, $ingredientes, $alergenos, $precio);

        header("Location: /listPizzas");
    }
}
