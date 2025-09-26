<?php

/*
Crea una clase revista que herede de libro y tenga ademas la propiedad numeroEdicion 
Sobrescribe el metodo mostrarInfo() para incluir la edicion
*/

class Libro
{
    public $titulo;
    public $autor;
    public $anio;

    public function __construct($titulo, $autor, $anio)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anio = $anio;
    }


    public function __destruct()
    {
        echo "Objeto destruido";
    }


    public function mostrarInfo()
    {
        return "Titulo: " . $this->titulo . "; Autor: " . $this->autor . "; Año: " . $this->anio;
    }
}

class Revista extends Libro
{
    public $numeroEdicion;

    public function __construct($titulo, $autor, $anio, $numeroEdicion)
    {
        parent::__construct($titulo, $autor, $anio);
        $this->numeroEdicion = $numeroEdicion;
    }

    public function mostrarInfo()
    {
        return "Titulo: " . $this->titulo . "; Autor: " . $this->autor . "; Año: " . $this->anio . "; Edicion: " . $this->numeroEdicion . "\n";
    }
}

$esdla = new Revista("El señor de los anillos", "JRR Tolkien", 1989, 111111);

$info = $esdla->mostrarInfo();
echo $info;


unset($esdla);
