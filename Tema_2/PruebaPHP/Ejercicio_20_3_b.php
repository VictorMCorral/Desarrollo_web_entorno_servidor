<?php

$numRan = mt_rand(1, 100);
$contarIntentnos = 0;

echo "En numero aleatorio es: $numRan\n";



do {

    $numAdivinar = trim(fgets(STDIN));

    switch ($numAdivinar <=> $numRan) {
        case 1:
            echo "El numero que quieres adivinar es menor\n";
            break;
        case 0:
            echo "Has acertado el numero!\n";
            break;
        case -1:
            echo "El numero que quieres adivinar es mayor\n";
            break;
    }
    $contarIntentnos += 1;

} while ($numAdivinar != $numRan);


echo "has tardado $contarIntentnos intentos";