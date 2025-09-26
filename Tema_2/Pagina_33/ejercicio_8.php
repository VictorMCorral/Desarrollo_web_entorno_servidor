<?php

/*
Crea un trait identificable que aporte una propiedad id y los metodos setId() y getId().
Haz que tanto Libro como Revista usen este trait y asigna un ID unico al crearlos
*/
trait Identificable {
    private $id;
    
    public function setId ($id){
        $this ->id = $id;
    }

    public function getId (){
        return $this ->id;
    }
}


class Libro 
{
    use Identificable;
    public $titulo;
    public $autor;
    public $anio;

    public function __construct($titulo, $autor, $anio, $id)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anio = $anio;
        $this ->setId($id);
    }


    public function __destruct()
    {
        echo "Objeto destruido\n";
    }


    public function mostrarInfo()
    {
        echo "ID: {$this ->id}; Titulo:  {$this->titulo}; Autor: { $this->autor}; Año:  {$this->anio} \n";
    }
}

class Revista extends Libro
{
    public $numeroEdicion;

    public function __construct($titulo, $autor, $anio, $id, $numeroEdicion)
    {
        parent::__construct($titulo, $autor, $anio, $id);
        $this->numeroEdicion = $numeroEdicion;
    }

    public function mostrarInfo()
    {
        echo "ID: {$this ->getId()}; Titulo:  {$this->titulo}; Autor: { $this->autor}; Año:  {$this->anio}; Edicion:  {$this->numeroEdicion} \n";
    }
}

$esdla = new Libro("El señor de los anillos", "JRR Tolkien", 1989, 1);
$esdla ->mostrarInfo();

$esdlaRevista = new Revista("El señor de los anillos", "JRR Tolkien", 1989, 2, 22222);
$esdlaRevista ->mostrarInfo();
