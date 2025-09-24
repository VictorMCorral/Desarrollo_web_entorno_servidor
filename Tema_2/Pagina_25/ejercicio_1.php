<?php


$contador = 0;

/* 
- Hazlo primero con global $contador
- luego con $GLOBALS['contador'].
- Hazlo de forma que incrementar [$contador] reciba el contador como parametro y devuelva un valor.
*/

function incrementarGlobal(){
    global $contador;
    $contador ++;
    echo "Contador global $contador\n";
}


function incrementarGlobals(){
    $GLOBALS['contador']++;
    echo "Contador globals " . $GLOBALS['contador'] . "\n";
}


function incrementar($num) : int{
    $num = $num +1;


    echo "Contador global $num \n";
    return $num;
}


incrementarGlobal();

incrementarGlobals();

$contador = incrementar($contador);


?>