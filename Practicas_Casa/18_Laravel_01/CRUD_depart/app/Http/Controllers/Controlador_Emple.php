<?php

namespace App\Http\Controllers;

use App\Models\Depart;
use App\Models\Emple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class Controlador_Emple extends Controller
{
    public function index(){
        $emples = Emple::with(['depart', 'director'])->get();
        $departs = Depart::all();

        return view('emple.index', compact('emples', 'departs'));
    }
    public function create(){
        $emples = Emple::with(['depart', 'director'])->get();
        $departs = Depart::all();
        return view("Emple.form", compact('emples', 'departs'));
    }
    public function store(Request $request){
        $emple_no = $request->input("emple_no");
        $apellido = $request->input("apellido");
        $oficio = $request->input("oficio");
        $dir = $request->input("dir");
        $fecha_alt = $request->input("fecha_alt");
        $salario = $request->input("salario");
        $comision = $request->input("comision");
        $depart_no = $request->input("depart_no");
        $file = $request->file("foto");
        $rutaFoto = $file->store("fotos", "public");

        Emple::create([
            "emple_no" => $emple_no,
            "apellido" => $apellido,
            "oficio" => $oficio,
            "dir" => $dir,
            "fecha_alt" => $fecha_alt,
            "salario" => $salario,
            "comision" => $comision,
            "depart_no" => $depart_no,
            "foto" => $rutaFoto,
        ]);

        return redirect()->route("emple.index");
        
    }
    public function show($id){
        return Emple::find($id);
    }
    
    public function edit($id){
        $emple= Emple::find($id);

        $emples = Emple::with(['depart', 'director'])->get();
        $departs = Depart::all();

        return view("Emple.formUpdate", compact("emple", "emples", "departs"));
    }

    public function update(Request $request, $id){
        $apellido = $request->input("apellido");
        $oficio = $request->input("oficio");
        $dir = $request->input("dir");
        $fecha_alt = $request->input("fecha_alt");
        $salario = $request->input("salario");
        $comision = $request->input("comision");
        $depart_no = $request->input("depart_no");

        
        $file = $request->file("foto");
        
        if($file){
            $rutaFoto = $file->store("fotos", "public");
        } else {
            $rutaFoto = null;
        }
        
        
        $emple = Emple::find($id);
        if($emple->foto){
            Storage::disk("public")->delete($emple->foto);
        }
        
        $emple->update([
            "apellido" => $apellido,
            "oficio" => $oficio,
            "dir" => $dir,
            "fecha_alt" => $fecha_alt,
            "salario" => $salario,
            "comision" => $comision,
            "depart_no" => $depart_no,
            "foto" => $rutaFoto,
        ]);

        return redirect()->route("emple.index");
    }
    public function destroy($id){
        $empleado = $this->show($id);
        $rutaFoto = $empleado->foto;
        try {
            
            Emple::destroy($id);
        } catch (\Exception $e) {
            return redirect()->route("emple.index")->with('error', 'No se puede eliminar el empleado.') ;
        }

        if($rutaFoto){
            Storage::disk("public")->delete($rutaFoto);
        }

        return redirect()->route("emple.index")->with('success', 'Empleado eliminado correctamente.') ;
    }

}
