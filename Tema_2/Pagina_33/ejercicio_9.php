<?php

/* 
Implementa una clase Biblioteca que gestione un array de materiales (Libro, Revista).
    Metodos: agregarMaterial(), mostrarMateriales(), buscarPorTitulo($titulo).
    Usa polimorfismo para que mostrarMateriales() muestre libros y revistas correctamente.
    Perimte prestar y devolver libros si implementan Prestable.
*/
interface Prestable{
    public function prestar();
    public function devolver();
    public function estaPrestado();
}

class Biblioteca{
    public $materiales = [];


    public function agregarMateriales($item){
        $indice = count($this->materiales);
        $this->materiales[$indice] = $item;
    }

    public function mostrarMateriales(){
        foreach ($this->materiales as $item) {
            echo $item->mostrarInfo();
        }
    }

    public function mostrarPorTitulo($titulo){
        foreach ($this->materiales as $item) {
            if ($item->titulo == $titulo) {
                echo "Libro encontrado: {$item->titulo}\n";
                break;
            }
        }
    }
}

class Libro implements Prestable{
    public $titulo;
    public $autor;
    public $anio;

    public function __construct($titulo, $autor, $anio){
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anio = $anio;
    }


    public function __destruct(){
        echo "Objeto destruido\n";
    }


    public function mostrarInfo(){
        echo "Titulo: " . $this->titulo . "; Autor: " . $this->autor . "; Año: " . $this->anio . "\n";
    }

    public function prestar(){
        if ($this ->prestado){
            echo "No se puede prestar, ya esta prestado";
        } else {
            $this ->prestado = true;
        }
        
    }
    public function devolver(){
        $this ->prestado = false;
    }
    public function estaPrestado(){
        if ($this ->prestado){
            echo "El libro {$this ->titulo} esta prestado\n";
        } else {
            echo "El libro {$this ->titulo} esta disponible\n";
        }
    }
}

class Revista extends Libro{
    public $numeroEdicion;

    public function __construct($titulo, $autor, $anio, $numeroEdicion){
        parent::__construct($titulo, $autor, $anio);
        $this->numeroEdicion = $numeroEdicion;
    }

    public function mostrarInfo(){
        echo "Titulo:  {$this->titulo}; Autor: { $this->autor}; Año:  {$this->anio}; Edicion:  {$this->numeroEdicion} \n";
    }

        public function prestar(){
        if ($this ->prestado){
            echo "No se puede prestar, ya esta prestado";
        } else {
            $this ->prestado = true;
        }
        
    }
    public function devolver(){
        $this ->prestado = false;
    }
    public function estaPrestado(){
        if ($this ->prestado){
            echo "El libro {$this ->titulo} esta prestado\n";
        } else {
            echo "El libro {$this ->titulo} esta disponible\n";
        }
    }
}

$biblioteca = new Biblioteca();


$esdla = new Libro("Esdla", "Tolkien", 1989);
$biblioteca ->agregarMateriales($esdla);


$esdlaRevista = new Revista("El señor de los anillos", "JRR Tolkien", 1989, 22222);
$biblioteca ->agregarMateriales($esdlaRevista);

$biblioteca ->mostrarMateriales();
$biblioteca ->mostrarPorTitulo("Esdla");

