<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use App\Models\Database;

class HomeControllers{
    private $twig;
    private $mi_model;

    public function __construct(){
        $loader = new FilesystemLoader(__DIR__ . "/../Views");
        $this->twig = new Environment($loader);
        $this->mi_model = new Database();
    }

    public function index(){
        $villanos = $this->mi_model->loadPjs();
        echo $this->twig->render("personajes.html.twig", [
            "villanos" => $villanos
        ]);
    }
}
