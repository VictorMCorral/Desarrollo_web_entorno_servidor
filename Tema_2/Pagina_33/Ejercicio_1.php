<?php 



/* 
Crea una clase Libro con las propiedades: titulo, autor y anio. Define un metodo mostrarInfo() que imprima del libro.
instancia 2 objetos de la calse Libro y muestra su informacion.
*/


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


$esdla = new Libro("El señor de los anillos", "JRR Tolkien", 1989);

echo $esdla ->mostrarInfo() . "\n";
unset($esdla);