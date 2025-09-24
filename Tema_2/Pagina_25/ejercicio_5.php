<?php
/*
Usa un array_filter con una funcion flecha para obtener de un array de numeros solo los pares
*/

$array = [1,2,3,4,5,6,7];

$array_pares = array_filter($array, fn($n) => $n % 2 == 0);

print_r($array_pares);


?>
