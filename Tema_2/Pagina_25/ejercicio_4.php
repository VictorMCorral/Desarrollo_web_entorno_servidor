<?php
/*
Escribe una funcion crearMultiplicador($factor) que devuelva una funcion anonima que multiplique cualquier numero por $factor

Ejemplo: $por2 = crearMultiplicador(2); echo $por2(5); //10
*/

function crearMultiplicador($factor){

    return function ($num) use ($factor) {
        return $factor * $num;
    };
};

$por2 = crearMultiplicador(2);

echo "El mutlplicar 2 * 5 da : " . $por2(5);

?>