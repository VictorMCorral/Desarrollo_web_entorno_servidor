<?php

function dividir($a, $b){
    return $a/is0($b);
}

function is0 ($b){
    if ($b == 0) {
        throw new Exception("No se puede dividir entre 0");
    } else {
        return $b;
    }
}

echo "Introduce un numero ";
$a = trim(fgets(STDIN));

echo "Introduce el divisor: ";
$b = trim(fgets(STDIN));

$resultado = 0;
try {
    $resultado = dividir($a, $b);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

echo "El resultado de dividir " . $a . " y " . $b . " es " . $resultado;
