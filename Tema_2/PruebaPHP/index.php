<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1><?= "Esto es una prueba" ?></h1>
    <?php 
    echo "Por favor, ingresa tu nombre: ";
    $rojo = "\033[31m";
    $reset = "\033[0m";

    $nombre = trim(fgets(STDIN));
    echo "{$rojo}Hola, $nombre!{$reset} \n";

    if ($argc > 1 && $argc == 3) {
        echo "Argumentos recibidos: \n";
        for ($i = 1; $i < $argc; $i++ ){
            echo "$argv[$i] \n";
        } 

        $ar1 = $argv[1];
        $ar2 = $argv[2];
    }else {
            echo "Se han pasado una cantidad de argumentos distintos a 3 ";
    }

    switch ($ar1<=>$ar2){
        case 1: 
            echo "$ar1 es el mayor";
            break;
        case 0: 
            echo "$ar1 y $ar2 son iguales";
            break;
        case -1:
            echo "$ar2 es el mayor";
            break;
    }

    $salida= `dir`;
    echo $salida;
    ?>


</body>

</html>