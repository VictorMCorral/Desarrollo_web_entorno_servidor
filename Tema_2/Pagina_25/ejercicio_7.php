<?php 
/*
    Transformar un array con funciones anonimas:
        dado un array de nombres, utiliza una funcion anonima con array_map para:
        - Convertir todos los nombres a mayusculas
        - Agregar "Sr./Sra." antes de cada nombre
*/


$arrayNombres= ["Pepito", "Menganita", "Victor", "Mary"];

$convertirMayus = array_map("strtoupper", $arrayNombres);

$agregarSroSra = array_map( function($n) {
    return "Sr./Sra. " . $n;
}, $convertirMayus);


print_R($agregarSroSra);

?>