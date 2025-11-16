<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

use App\Models\Depart;
use App\Models\Emple;

class Database{

    public function __construct(){
        try {
            $capsule = new Capsule;

            $capsule->addConnection([
                "driver" => 'mysql',
                "host" => 'db',
                "database" => 'myapp',
                "username" => 'developer',
                "password" => 'devpassword',
                "charset" => 'utf8mb4',
                "collation" => 'utf8mb4_unicode_ci',
                "prefix" => '',
            ]);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            error_log("consexion exitosa a la base de datos con Eloquent. ");
        } catch (\Exception $e) {
            die("Error al conectar a la base de datos: " . $e ->getMessage());
        };
    }


    public function agregarDatos($depart_no, $dnombre, $loc){
        $depart = new Depart();
        $depart->dept_no = $depart_no;
        $depart->dnombre = $dnombre;
        $depart->loc = $loc;
        $depart->save();
    }

    public function loadEmples(){
        return Emple::all();
    }

    public function loadEmple($emple_no){
        return Emple::find($emple_no);
    }

    public function comprobarEmple($id){
        $departamento = $this->loadDep($id);

        return Emple::where("dept_no", $id)->count();
    }

    public function loadDeps(){
        return Depart::all();
    }

    public function loadDep($id){
        return Depart::find($id);
    }

    public function modificarDept($dept_no, $dnombre, $loc){
        $departamento = $this->loadDep($dept_no);

        if($departamento){
            $departamento->dnombre = $dnombre;
            $departamento->loc = $loc;
            $departamento->save();
            error_log("Departamento actualizado: {$dnombre}");
        } else {
            error_log("Departamento no encontrado: {$dnombre}");
        }
    }

    public function eliminarDept($dept_no){
        $departamento = $this->loadDep($dept_no);

        if($departamento){
            $departamento->delete();
            error_log("Departamento actualizado: {$departamento->dnombre}");
        } else {
            error_log("Departamento no encontrado");
        }
    }

    public function eliminarEmple($emple_no){
        $empleado = $this->loadEmple($emple_no);
        $empleado->delete();
    }
}