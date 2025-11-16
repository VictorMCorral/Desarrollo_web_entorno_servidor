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

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        $sesionValida = isset($_SESSION["usuario"]);
        $usuario = $sesionValida ? $_SESSION["usuario"] : "";

        $this->twig->addGlobal("variableTwig", [
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

    public function logDat(){
        $usuarioSanitizado = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_SPECIAL_CHARS);
        $passSanitizada = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);

        $usuarioObj = $this->mi_model->getUserByName($usuarioSanitizado);

        if($usuarioObj && password_verify($passSanitizada, $usuarioObj->password)) {
            $_SESSION["usuario"] = $usuarioSanitizado;
            $producto = $_SESSION["producto"] ?? "";

            $this->twig->addGlobal("variableTwig", [
                "sesionValida" => true,
                "usuario" => $usuarioSanitizado,
                "producto" => $producto
            ]);

            echo $this->twig->render("sucess.html.twig", [
                "usuario" => $usuarioSanitizado
            ]);
        } else {
            echo $this->twig->render("nosucess.html.twig");
        }
    }

    public function register(){
        echo $this->twig->render("register.html.twig");
    }

    public function register2($data){
        $usuarioSanitizado = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_SPECIAL_CHARS);
        $passSanitizada = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);
        $hashedPass = password_hash($passSanitizada, PASSWORD_BCRYPT);

        $this->mi_model->addUser($usuarioSanitizado, $hashedPass);

        echo $this->twig->render("sucess.html.twig", [
            "usuario" => $usuarioSanitizado
        ]);
    }

    public function logOut($data){
        if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION["usuario"])){
            $usuario = $_SESSION["usuario"];
            session_unset();
            session_destroy();

            $this->twig->addGlobal("variableTwig", [
                "sesionValida" => false,
                "usuario" => $usuario
            ]);

            echo $this->twig->render("logout.html.twig", [
                "usuario" => $usuario
            ]);
        } else {
            echo $this->twig->render("home.html.twig");
        }
    }

    public function compra($data){
        $producto = $data["producto"] ?? "";
        if($producto) {
            $_SESSION["producto"] = $producto;
        }

        $this->twig->addGlobal("variableTwig", [
            "sesionValida" => isset($_SESSION["usuario"]),
            "usuario" => $_SESSION["usuario"] ?? "",
            "producto" => $producto
        ]);

        echo $this->twig->render("compra.html.twig");
    }
}
