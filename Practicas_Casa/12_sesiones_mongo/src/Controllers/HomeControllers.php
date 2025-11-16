<?php

namespace App\Controllers;

use App\Models\Database;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;


class HomeControllers{
    private $twig;
    private $mi_model;

    public function __construct(){
        $this->mi_model = new Database();

        $loader = new FilesystemLoader(__DIR__ . "/../Views");
        $this->twig = new Environment($loader);
        $this->mi_model = new Database();
    }

    public function index(){
        echo $this->twig->render("home.html.twig");
    }

    public function log(){
        echo $this->twig->render("form.html.twig");
    }

    public function logDat($data){
        $usuario = $data["usuario"];
        $usuarios = $this->mi_model->loadUsers($usuario);
        print_r($usuarios);
        echo $this->twig->render("sucess.html.twig", [
            "usuario" => $usuarios["username"]
        ]);
    }
}
