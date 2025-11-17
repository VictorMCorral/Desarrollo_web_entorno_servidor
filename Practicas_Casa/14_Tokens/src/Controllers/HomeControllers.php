<?php

namespace App\Controllers;

use App\Models\Database;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class HomeControllers
{
    private $twig;
    private $mi_model;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../..");
        $dotenv->load();

        $host = $_ENV["DB_HOST"];
        $database = $_ENV["DB_DATABASE"];
        $username = $_ENV["DB_USERNAME"];
        $password = $_ENV["DB_PASSWORD"];

        $this->mi_model = new Database($host, $database, $username, $password);


        $loader = new FilesystemLoader(__DIR__ . "/../Views");
        $this->twig = new Environment($loader);


        $sesionValida = false;
        $usuario = "";

        $key = $_ENV["KEY"];
        $token = $_COOKIE["token"] ?? null;

        if ($token) {
            try {
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                $sesionValida = true;
                $usuario = $decoded->username;
            } catch (\Exception $e) {
                $sesionValida = false;
            }
        }

        $this->twig->addGlobal("variableTwig", [
            "sesionValida" => $sesionValida,
            "usuario" => $usuario
        ]);
    }

    public function index()
    {
        $this->mi_model->loadUser();
        echo $this->twig->render("home.html.twig");
    }

    public function log()
    {
        echo $this->twig->render("form.html.twig");
    }

    public function logDat()
    {

        $username = $_POST['usuario'] ?? '';
        $password = $_POST['pass'] ?? '';
        $user = $this->mi_model->getUser($username);

        if ($user && password_verify($password, $user->password)) {
            $key = $_ENV["KEY"];
            $payload = [
                "id" => $user->id,
                "username" => $user->username,
                "role" => "admin",
                "iat" => time(),
                "exp" => time() + 3600
            ];
            $jwt = JWT::encode($payload, $key, 'HS256');

            setcookie("token", $jwt, time() + 3600, "/", "", false, true);

            $this->twig->addGlobal("variableTwig", [
                "sesionValida" => true,
                "usuario" => $user->username
            ]);

            echo $this->twig->render("sucess.html.twig", ["usuario" => $user->username]);
        } else {
            echo $this->twig->render("form.html.twig", ["error" => "Usuario o contraseña incorrectos"]);
        }
    }

    public function register()
    {
        echo $this->twig->render("register.html.twig");
    }

    public function register2($data)
    {

        $username = $data['usuario'] ?? '';
        $password = $data['pass'] ?? '';
        
        $result = $this->mi_model->addUser($username, $password);

        if ($result['success']) {
            echo $this->twig->render("sucess.html.twig", ["usuario" => $username]);
        } else {
            echo $this->twig->render("register.html.twig", ["error" => $result['error']]);
        }
    }




    public function logOut()
    {
        setcookie("token", "", time() - 3600, "/");

        $this->twig->addGlobal("variableTwig", [
            "sesionValida" => false
        ]);


        echo $this->twig->render("logout.html.twig");
    }
}
