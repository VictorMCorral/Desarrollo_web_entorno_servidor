<?php 

/* Crea una clase abstracta MaterialBiblioteca con:
    - Propiedades comunes( titulo, autor, anio)
    - Un metodo abstracto mostrarInfo()
    - Un metodo concreto esAntiguo() que devuelva true si el año es menor a 2000

    Haz que Libro y Revista hereden de esta clase.
*/

abstract class MaterialBiblioteca {
    public $titulo;
    public $autor;
    public $anio;

    public function __construct($titulo, $autor, $anio)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anio = $anio;
    }

    abstract public function mostrarInfo();

    public function esAntiguo(){
        if ($this ->anio < 2000){
            return true;
        } else {
            return false;
        }
    }
}


class Libro extends MaterialBiblioteca
{
    public function __construct($titulo, $autor, $anio)
    {
        parent::__construct($titulo, $autor, $anio);
    }


    public function __destruct()
    {
        echo "Objeto destruido\n";
    }


    public function mostrarInfo()
    {
        echo "Titulo: " . $this->titulo . "; Autor: " . $this->autor . "; Año: " . $this->anio . "\n";
    }
}

class Revista extends MaterialBiblioteca
{
    public $numeroEdicion;

    public function __construct($titulo, $autor, $anio, $numeroEdicion)
    {
        parent::__construct($titulo, $autor, $anio);
        $this->numeroEdicion = $numeroEdicion;
    }

    public function mostrarInfo()
    {
        echo "Titulo:  {$this->titulo}; Autor: { $this->autor}; Año:  {$this->anio}; Edicion:  {$this->numeroEdicion} \n";
    }
}


$esdla = new Libro("El señor de los anillos", "JRR Tolkien", 1989);
$esdla ->mostrarInfo();

$esdlaRevista = new Revista("El señor de los anillos", "JRR Tolkien", 1989, 11111);
$esdlaRevista ->mostrarInfo();