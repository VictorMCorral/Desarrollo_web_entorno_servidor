<?php


/*
Crea una interfaz Prestable con los metodos: prestar(), devolver(), estaPrestado().
Haz que la clase Libro la implemente, y gestiona con una propiedad booleana si esta prestado o no
*/

interface Prestable {
    public function prestar();
    public function devolver();
    public function estaPrestado();
}


class Libro implements Prestable{
    public $titulo;
    public $autor;
    public $anio;
    public $prestado;

    public function __construct($titulo, $autor, $anio)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anio = $anio;
        $this->prestado = false;
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

    public function __destruct()
    {
        echo "Objeto destruido\n";
    }


    public function mostrarInfo()
    {
        return "Titulo: " . $this->titulo . "; Autor: " . $this->autor . "; Año: " . $this->anio . "\n";
    }
}


$esdla = new Libro("El señor de los anillos", "JRR Tolkien", 1989);
$esdla ->prestar();
$esdla ->estaPrestado();
$esdla ->devolver();
$esdla ->estaPrestado();