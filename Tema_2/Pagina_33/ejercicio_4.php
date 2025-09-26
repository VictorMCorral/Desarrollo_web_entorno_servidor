<?php 

/* Crea un array con varios objetos Libro y Revista
Define una funcion mostrarColeccion($item) que recorra el array y llame al metodo mostrarInfo() de cada objeto.
Observa como, aunque se llamen igual, cada clase ejecuta su propia version del metodo.
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
        echo "Objeto destruido\n";
    }


    public function mostrarInfo()
    {
        echo "Titulo: " . $this->titulo . "; Autor: " . $this->autor . "; Año: " . $this->anio . "\n";
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
        echo "Titulo:  {$this->titulo}; Autor: { $this->autor}; Año:  {$this->anio}; Edicion:  {$this->numeroEdicion} \n";
    }
}


$arrayLibros = [new Libro("Esdla", "Tolkien", 1989), new Revista("Kimetsu", "nose", 1989, 2222), new Revista("One piece", "nose", 1989, 2222)];
mostrarColeccion($arrayLibros);

function mostrarColeccion ($item){
    foreach ($item as $libro){
        $info = $libro -> mostrarInfo();
        echo $info;
    }
}