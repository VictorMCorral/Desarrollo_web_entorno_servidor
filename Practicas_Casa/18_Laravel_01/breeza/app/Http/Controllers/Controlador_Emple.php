<?php

namespace App\Http\Controllers;

use App\Models\Emple;
use Illuminate\Http\Request;

class Controlador_Emple extends Controller
{
    public function index(){
        $emples = Emple::all();

        return view("Emple.index",["emples" => $emples]);
    }
    public function create(){
        
    }
    public function store(){
        
    }
    public function show(){
        
    }
    public function edit(){
        
    }
    public function update(){
        
    }
    public function destroy(){
        
    }
}
