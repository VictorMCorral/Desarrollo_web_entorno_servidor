<?php

namespace App\Controllers;

use App\Models\Database;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Dotenv\Dotenv;

class HomeControllers
{
    private $twig;
    private $mi_model;

    public function __construct(){
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../..");
        $dotenv->load();
        $host = $_ENV["DB_HOST"];
        $database = $_ENV["DB_DATABASE"];
        $username = $_ENV["DB_USERNAME"];
        $password = $_ENV["DB_PASSWORD"];

        $this->mi_model = new Database($host, $database, $username, $password);

        $loader = new FilesystemLoader(__DIR__ . "/../Views");
        $this->twig = new Environment($loader);
        $this->mi_model = new Database();

        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }

        if(isset($_SESSION["usuario"])){
            $sesionValida = true;
            $usuario= $_SESSION["usuario"];
        } else {
            $sesionValida= false;
            $usuario = "";
        }

        $this ->twig->addGlobal("variableTwig",[
            "sesionValida" => $sesionValida,
            "usuario" => $usuario
        ]);
    }

    public function index(){
        $this->mi_model->loadUser();
        echo $this->twig->render("home.html.twig");
    }

    public function log(){
        echo $this->twig->render("form.html.twig");
    }

    public function logDat(){

    }

    public function register(){
        echo $this->twig->render("register.html.twig");
    }

    public function register2(){

    }

    public function logOut(){

    }






}
