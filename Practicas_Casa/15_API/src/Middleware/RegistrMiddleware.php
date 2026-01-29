<?php
namespace App\Middleware;


class RegistrMiddleware{
    private $path;

    public function __construct(){
        $this->path = __DIR__ . "./registros.txt";

    }

    public function handle($method, $path, $userData){

        if(isset($userData)){
            $contenido = "\nPeticion: \n\tMetodo: " . $method . "; \n\tUrl: " . $path . "; \n\tUsuario: " . $userData["user_id"] . "; \n\tHora: " . date("D M j G:i:s T Y", time()) . "\n";
        } else {
            $contenido = "\nMetodo: " . $method . " Url: " . $path . " Usuario: No autentificado Hora: " . date("D M j G:i:s T Y", time());
        }
        file_put_contents("registros.txt", $contenido, FILE_APPEND);
    }

}