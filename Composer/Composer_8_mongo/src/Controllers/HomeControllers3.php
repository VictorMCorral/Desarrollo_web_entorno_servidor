<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use App\Models\Database;

class HomeControllers3{
    private $twig;
    private $mi_model;

    public function __construct(){
        $loader = new FilesystemLoader(__DIR__ . "/../Views");
        $this->twig = new Environment($loader);
        $this->mi_model = new Database();
    }

    public function index_ejemplo(){

        $deps = $this->mi_model->loadDeps();

        echo $this->twig->render("producetos.html.twig", [
            "title" => "Mi pagina Web",
            "productos" => [
                ["nombre" => "Producto 1", "precio"=> 100],
                ["nombre" => "Producto 2", "precio"=> 200]
            ],
            "departamentos" => $deps,
        ]);
    }

    public function index(){
        echo $this->twig->render("home.html.twig", ["productos" => [
                ["nombre" => "Producto 1", "precio"=> 100],
                ["nombre" => "Producto 2", "precio"=> 200]
            ]]);
    }

    public function about(){
        echo $this->twig->render("about.html.twig");
    }

    public function depDept($data){
        $this->mi_model->delDep(["dept_no" => intval($data['dept_no'])]);

        $this->index();
    }
}
