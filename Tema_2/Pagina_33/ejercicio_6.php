<?php

/*
Haz que las propiedades del libro (titulo, autor, anio) sean privadas.
Implementa metodos getter y setter para acceder/modificar esos valores.
Controla que el año de publicacion no sea mayor al actual.
*/

class Libro
{
    private $titulo;
    private $autor;
    private $anio;

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


    public function setTitulo ($titulo){
        $this ->titulo = $titulo;
    }

    public function getTitulo (){
        return $this ->titulo;
    }

    public function setAutor ($autor){
        $this ->autor = $autor;
    }

    public function getAutor (){
        return $this ->autor;
    }

    public function setAnio ($anio){
        $anioActual = date('Y');
        if ($anio > $anioActual){
            echo "El año es invalido\n";
        } else {
            $this ->anio = $anio;
        }
        
    }

    public function getAnio (){
        return $this ->anio;
    }
}

$esdla = new Libro("El señor de los anillos", "JRR Tolkien", 1989);
$esdla ->mostrarInfo();

$esdla ->setTitulo("ESDLA");
$esdla ->setAutor("Tolkien");
$esdla ->setAnio(2050);
$esdla ->mostrarInfo();