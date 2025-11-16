<?php

namespace App\Controllers;

use App\Models\Database;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;


class HomeControllers
{
    private $twig;
    private $mi_model;

    public function __construct(){
        $this->mi_model = new Database();

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
        echo $this->twig->render("home.html.twig");
    }

    public function log(){
        echo $this->twig->render("form.html.twig");
    }

    public function logDat($data){
        $usuario = strtolower($data["usuario"]);
        $usuarioSanitizado = filter_input(INPUT_POST, "usuario",FILTER_SANITIZE_SPECIAL_CHARS);
        $passSanitizada = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);


        $usuarios = $this->mi_model->loadUser($usuarioSanitizado);

        if ($usuarioSanitizado == $usuarios["usuario"] && password_verify($passSanitizada, $usuarios["password"])) {
            if(isset($_SESSION["producto"])){
                $producto = $_SESSION["producto"];
            } else {
                $producto = "";
            }

            $this ->twig->addGlobal("variableTwig",[
                "sesionValida" => true,
                "usuario" => $usuario,
                "producto" => $producto,
            ]);
            $_SESSION["usuario"] = $usuario;
            echo $this->twig->render("sucess.html.twig", [
                "usuario" => $usuarios["usuario"]
            ]);
        } else {
            echo $this->twig->render("nosucess.html.twig");
        }
    }

    public function register(){
        echo $this->twig->render("register.html.twig");
    }

    public function register2($data){

        $usuarioSanitizado = filter_input(INPUT_POST, "usuario",FILTER_SANITIZE_SPECIAL_CHARS);
        $passSanitizada = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);
        $hashedPass = password_hash($passSanitizada, PASSWORD_BCRYPT);


        $this->mi_model->addOne($usuarioSanitizado, $hashedPass);
        echo $this->twig->render("sucess.html.twig", [
            "usuario" => $data["usuario"]
        ]);
    }

    public function logOut($data){
        if(session_status() == PHP_SESSION_ACTIVE){
            $usuario = $_SESSION["usuario"];
            session_unset();

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

    public function compra($data){
        
        if(isset($data["producto"])){
            $producto = $data["producto"];
            $_SESSION["producto"] = $producto;
        } else {
            $producto = "";
        }

        

        $this ->twig->addGlobal("variableTwig",[
            "sesionValida" => true,
            "usuario" => $_SESSION["usuario"],
            "producto" => $producto,
        ]);


        echo $this->twig->render("compra.html.twig");
    }
}
