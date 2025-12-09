<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Depart;
use App\Models\Emple;

use Dotenv\Dotenv;

use GuzzleHttp\Psr7\Header;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class HomeControllers{
    private $mi_model;
    private $twig;

    public function __construct(){
        // DOTENV
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
        $dotenv->load();
        $host = $_ENV["DB_HOST"];
        $port = $_ENV["DB_PORT"];
        $database = $_ENV["DB_DATABASE"];
        $user = $_ENV["DB_USERNAME"];
        $password = $_ENV["DB_PASSWORD"];

        // ELOQUENT
        $this->mi_model = new Database($host, $port, $database, $user, $password);
        
        // VISTA
        $loader = new FilesystemLoader(__DIR__ . "/../Views");
        $this->twig = new Environment($loader);

        // CON SESIONES
        // if(session_status() === PHP_SESSION_NONE){
        //     session_start();
        // } 

        
        
    }
    


    // METODOS ELOQUENT
    public function listDepart(){
        $departamentos = Depart::all();

        require __DIR__ . "/../Views/depart.php";
    }
    public function listEmple(){
        $empleados = Emple::all();
        $departamentos = Depart::all();

        require __DIR__ . "/../Views/emple.php";
    }

    // CON SESSIONES 
    public function index(){
        if(isset($_SESSION["user"])){
            $sesionActiva = true;
        } else {
            $sesionActiva = false;
        }
        
        echo $this->twig->render("home.php.twig", [
            "sesionActiva" => $sesionActiva,
            "mensaje" => ""
        ]);
    }
    

    public function login($post){
        $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);

        $hasehdPass = password_hash("aaa", PASSWORD_BCRYPT);

        if($user === "Victor" && password_verify($pass, $hasehdPass)){
            $_SESSION["sesionActiva"] = true;
            $_SESSION["user"] = $post["user"];
            $mensaje = "Login correcto";
        } else {
            $_SESSION["sesionActiva"] = false;
            unset($_SESSION["user"]);
            $mensaje = "Login incorrecto";
        }
        
        Header("Location: /");
    }

    
    public function logout(){
        session_destroy();
        Header("Location: /");
    }

    //CON COOKIES Y JWT

    public function indexCookie(){
        $token = $_COOKIE["token"] ?? null;
        $key = $_ENV["JWT_KEY"];
        if($token){
            try{
                $decoded = JWT::decode($token, new Key ($key, "HS256"));
                echo $this->twig->render("home.php.twig", [
                    "sesionActiva" => true,
                    "mensaje" => $token
                ]);
            } catch (\Exception $e){
                setcookie("token", "", time() -3600, "/");
            }
        } else {
            echo $this->twig->render("home.php.twig", [
                "sesionActiva" => false,
                "mensaje" => "No logeado"
            ]);
        }
    }

    public function loginCookie($post){
        $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);

        $hasehdPass = password_hash("aaa", PASSWORD_BCRYPT);

        if($user === "Victor" && password_verify($pass, $hasehdPass)){
            $key = $_ENV["JWT_KEY"];
            $payload = [
                "user_id" => $user,
                "role" => "admin",
                "iat" => time(),
                "exp" => time() + 3600
            ];

            $jwt = JWT::encode ($payload, $key, "HS256");

            setcookie("token", $jwt, time()+3600, "/", "", false, true);

            echo $this->twig->render("home.php.twig", [
                "sesionActiva" => true,
                "mensaje" => $jwt
            ]);
        } else {
            Header("Location: /");
        }
    }
    public function logoutCookie(){
        setcookie("token", "", time() -3600, "/");
        Header("Location: /");
    }
}
