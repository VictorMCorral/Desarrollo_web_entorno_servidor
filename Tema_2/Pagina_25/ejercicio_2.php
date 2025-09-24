<?php 
/* 
Crea una funcion calcularPromedio($numeros) que reciba un array y devuelva el promedio
usa la funcion y guarda el resultado en una variable. usa tipos de datos.

- funcion basica
- funcion anonima
- funcion flecha
*/

declare(strict_types=1);

$numeros = [1,2,3,4,5,6];



function calcularPromedio($numeros) : float {
    $promedio = array_sum($numeros)/count($numeros);
    return $promedio;
}

$promedio = calcularPromedio($numeros);

$promedioAnonima = function($numeros) { return array_sum($numeros)/count($numeros);};

$promedioFlecha = fn($numeros) => array_sum($numeros)/count($numeros);

echo "Promedio normal: $promedio \n";
echo "Promedio anonima: " . $promedioAnonima($numeros) . "\n";
echo "Promedio flecha: " . $promedioFlecha($numeros) . "\n"




?>