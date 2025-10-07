<?php

namespace Victor\Dockercomposer\Controllers;

class HomeController{
    public function index(){
        $filePath = __DIR__ . '/../Views/home.html';

        if (file_exists($filePath)) {
            echo file_get_contents($filePath);
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }

    public function form(){
        $filePath = __DIR__ . '/../Views/form.html';;
        if (file_exists($filePath)) {
            echo file_get_contents($filePath);
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }

    public function about(){
        $filePath = __DIR__ . '/../Views/about.html';;
        if (file_exists($filePath)) {
            echo file_get_contents($filePath);
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }

    public function procesar($data){
        if (isset($data['nombre']) && !empty($data['nombre'])) {
            $nombre = htmlspecialchars($data['nombre']);
            echo "<h1>¡Hola {$nombre}! Bienvenido a nuestra pagina</h1> \n <ul><li><a href=\"/\">Index</a></li></ul>";
        } else if (isset($data['ip']) && !empty($data['ip']) && isset($data['apodo']) && !empty($data['apodo'])){
            $ip = htmlspecialchars($data['ip']);
            $apodo = htmlspecialchars($data['apodo']);
            echo "<h1>¡La ip {$ip}! ha sido agregada como $apodo. </h1> \n <ul><li><a href=\"/\">Index</a></li></ul>";
        } else {
            echo "<h1>Por favor, introduce un nombre valido</h1>";
        }
    }

    public function ips(){
        $filePath = __DIR__ . '/../Views/ips.html';;
        if (file_exists($filePath)) {
            echo file_get_contents($filePath);
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }

    public function nueva(){
        $filePath = __DIR__ . '/..Views/nueva.html';
        if(file_exists($filePath)){
            echo file_get_contents($filePath);
        } else {
            http_response_code(418);
            echo "<h1>Error 418: Soy una tetera</h1>";
        }
    }
}
