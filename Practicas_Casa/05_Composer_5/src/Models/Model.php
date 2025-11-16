<?php

namespace victor\Listanombres\Models;

class Model{
    private $filepath;

    public function __construct(){
        $this->filepath = __DIR__ . "/../Databases/usuarios.txt";
    }

    public function getUsers(){
        $lineas = file($this->filepath);
        return $lineas;
    }

    public function delUsers($usuarioEliminar){
        $lineas = file($this->filepath);
        $usuario = $lineas[$usuarioEliminar];
        array_splice($lineas, $usuarioEliminar, 1);

        file_put_contents($this->filepath, "");

        foreach($lineas as $linea){
            file_put_contents($this->filepath, $linea, FILE_APPEND);
        }
        
        return $usuario;
    }


    public function crearUsuario($usuarioNuevo){
        $usuarioNuevo = trim($usuarioNuevo) . "\n";
        file_put_contents($this->filepath, $usuarioNuevo, FILE_APPEND);
    }



    public function editUser($user, $pos){
        $lineas = file($this->filepath);
        $lineas[$pos] = $user . "\n";

        file_put_contents($this->filepath, "");

        foreach($lineas as $linea){
            file_put_contents($this->filepath, $linea, FILE_APPEND);
        }
    }


    public function getUser($index){
        $lineas = file($this ->filepath);
        return $lineas[$index];
    }
}
