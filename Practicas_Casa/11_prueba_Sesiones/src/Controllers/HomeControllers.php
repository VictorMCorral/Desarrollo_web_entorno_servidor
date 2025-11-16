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

        $this->mi_model = new Database();
    }

    public function index(){
        if(isset($_SESSION["usuario"])){
            $sesionValida = true;
            $usuario= $_SESSION["usuario"];
        } else {
            $sesionValida= false;
            $usuario = "";
        }

        echo $this->twig->render("home.html.twig", [
            "usuario" => $usuario
        ]);
    }

    public function log(){
        echo $this->twig->render("form.html.twig");
    }

    public function logDat(){
        $usuarioSanitizado = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_SPECIAL_CHARS);
        $passSanitizada = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);
        $hashedPass = password_hash("aaa", PASSWORD_BCRYPT);

        if(password_verify($passSanitizada, $hashedPass) && $usuarioSanitizado == "Victor"){
            $_SESSION["usuario"] = $usuarioSanitizado;

            $this ->twig->addGlobal("variableTwig",[
                "sesionValida" => true,
                "usuario" => $usuarioSanitizado
            ]);

            echo $this->twig->render("sucess.html.twig", [
                "usuario" => $usuarioSanitizado
            ]);
        } else {
            echo $this->twig->render("nosucess.html.twig");
        }
    }

    public function logOut($data){
        if(session_status() == PHP_SESSION_ACTIVE){
            $usuario = $_SESSION["usuario"];
            session_unset();
            
            session_destroy();

            $this ->twig->addGlobal("variableTwig",[
                "sesionValida" => false,
                "usuario" => $usuario
            ]);

            echo $this->twig->render("logout.html.twig", [
                "usuario" => $data["usuario"]
            ]);
        } else {
            echo $this->twig->render("home.html.twig");
        }

    }
}
