<?php

class Libro {
    public $titulo;
    public $autor;
    public $anio;

    public function __construct($titulo, $autor, $anio){
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anio = $anio;
    }


    public function __destruct(){
        echo "Objeto destruido";
    }


    public function mostrarInfo(){
        return "Titulo: " . $this ->titulo . "; Autor: " . $this ->autor . "; Año: " . $this ->anio;
    }
}
