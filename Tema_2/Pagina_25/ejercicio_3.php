<?php 
/* 
Define una funcion anonima en una variable $multiplicar que multipliqie dos numeros.
Llama a la funcion usando $multiplicar(3,4)
*/

$multiplicar = function($num1, $num2) {
    return $num1 * $num2;
};

echo "La multiplicacion de 3 * 4 da: " . $multiplicar(3,4) . "\n";

?>