<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\error;

class ControladorCrud extends Controller
{
    public function indice(){
        return view("prueba", ["titulo" => "Acciones"]);
    }

    public function loadUsers(){
        $path = __DIR__ . "/../../../storage/app/private/usuarios.json";
        $contenido = json_decode(file_get_contents($path), true);
        if($contenido == "" || $contenido == null){
            return [];
        }
        return $contenido;
    }
    
    public function index(){
        $contenido = $this->loadUsers();
        return view("indice", ["contenido" => $contenido, "titulo" => "Nombres en JSON: ", "error" => ""]);
    }
    
    public function create(){
        return view("form", ["titulo" => "Creacion de usuarios"]);
    }
    
    public function store(Request $request){
        $path = __DIR__ . "/../../../storage/app/private/usuarios.json";
        $contenido = $this->loadUsers();
        $idMax = 0;

        foreach($contenido as $usuario){
            if($usuario["id"]> $idMax){
                $idMax = $usuario["id"];
            }
        }
        $idMax = $idMax +1;
        
        $nuevo = [
            "name" => $request->input("nombre"),
            "email" => $request->input("email"),
            "id" => $idMax
        ];
        array_push($contenido, $nuevo);
        file_put_contents($path, json_encode($contenido));
        //return view("prueba", ["contenido" => $contenido, "titulo" => "Nombres en JSON: "]);
        return redirect("/usuarios");
    }
    
    public function show(Request $request){
        $contenido = $this->loadUsers();
        $usuarioFiltrado = null;
        foreach ($contenido as $usuario) {
            if($usuario["id"] == $request->input("id")){
                $usuarioFiltrado = $usuario; 
            }
        }
        if($usuarioFiltrado == null){
            return view("indice", ["contenido" => $contenido, "titulo" => "Nombres en JSON: ", "error" => "No se ha encontrado el usuario"]);
        }
        //error_log(print_r($usuarioFiltrado));
        return view("formUpdate", ["titulo" => "Creacion de usuarios", "usuario" => $usuarioFiltrado]);
    }

    public function update(Request $request){
        $id = $request->input("id");
        $nombre = $request->input("nombre");
        $email = $request->input("email");
        $contenido = $this->loadUsers();
        $indice = null;
        for($i = 0; $i<count($contenido); $i ++){
            if($contenido[$i]["id"] == $id){
                $indice = $i;
            }
        }
        $contenido[$indice]["name"] = $nombre;
        $contenido[$indice]["email"] = $email; 
        //error_log(print_r($contenido[$indice]));
        $path = __DIR__ . "/../../../storage/app/private/usuarios.json";
        file_put_contents($path, json_encode($contenido));
        return view("indice", ["contenido" => $contenido, "titulo" => "Nombres en JSON: ", "error" => ""]);
    }
    
    public function destroy($id){
        error_log($id);
        $contenido = $this->loadUsers();
        $indice = null;
        for($i = 0; $i<count($contenido); $i ++){
            if($contenido[$i]["id"] == $id){
                $indice = $i;
            }
        }
        unset($contenido[$indice]);
        $path = __DIR__ . "/../../../storage/app/private/usuarios.json";
        file_put_contents($path, json_encode($contenido));
        return view("indice", ["contenido" => $contenido, "titulo" => "Nombres en JSON: ", "error" => ""]);
    }
}
