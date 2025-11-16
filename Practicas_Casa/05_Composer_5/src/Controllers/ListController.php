<?php

namespace victor\Listanombres\Controllers;

use victor\Listanombres\Models\Model;

class ListController{
    private $model;

    public function __construct(){
        $this->model = new Model();
    }

    public function index(){
        $path = __DIR__ . "/../Views/form.php";

        $lineas = $this->model->getUsers();
        $cantidad = count($lineas);
        
        
        if (file_exists($path)) {
            require __DIR__ .  "/../Views/form.php";
        } else {
            echo "no existe la ruta";
        }
    }

    public function crearUsuario($data){
        if (isset($data['Usuario']) && !empty($data['Usuario'])) {
            $usuario = $data['Usuario'] . "\n";

            $this->model->crearUsuario($usuario);

            require __DIR__ . "/../Views/bienvenidaUsuario.php";

        } else {
            echo "No has introducido usuario";
        }
    }

    public function delUser($data){
        if (isset($data['id'])) {
            $usuarioBorrar = $data['id'];
            $usuario = $this->model->delUsers($usuarioBorrar);
        }

        require __DIR__ . "/../Views/despedidaUsuario.php";
    }



    public function editUser($data){
        if (isset($data['id'])) {
            $usuarioEditar = $data['id'];
            $usuario = $this->model->getUser($usuarioEditar);
            require __DIR__ . "/../Views/modificarUsuario.php";
        }
    }

    public function guardarUsuarioEditado($data){   
        if (isset($data['user']) && !empty($data['user'])){
            if (isset($data['pos'])){
                $user = $data['user'];
                $pos = $data['pos'];
                $this ->model ->editUser($user, $pos);
                require __DIR__ . "/../Views/usuarioModificado.php";
                
            } else {
                echo "No encuentra pos";
            }
        } else {
            echo "No encuentra user";
        }
    }
}
