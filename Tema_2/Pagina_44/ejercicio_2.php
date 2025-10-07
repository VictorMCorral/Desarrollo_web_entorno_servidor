<?php 
$ruta = "." . DIRECTORY_SEPARATOR . "mi_fruteria";
$archivo1 = "frutas.txt";

if(mkdir($ruta)){
    $rutaArchivo1 = $ruta . DIRECTORY_SEPARATOR . $archivo1;
    $resArchivo1 = fopen($rutaArchivo1, "x+");
    fwrite($resArchivo1, "Peras\nMelones\nSandias\nNaranjas\nplatanos");
    fclose($resArchivo1);

        if(is_readable($rutaArchivo1)){
        $resArchivoFrutas = fopen($rutaArchivo1, "r");
        $contenido = fread($resArchivoFrutas, filesize($rutaArchivo1));
        echo $contenido . "\n";
        fclose($resArchivoFrutas);
        $resArchivoFrutas = fopen($rutaArchivo1, "r");
        $linea = fgets($resArchivoFrutas);
        echo "Fgets: " . $linea . "\n";
        /*
        while(($linea = fgets($resArchivo1)) != false){
            echo $linea . "\n";
        }
        */
        fclose($resArchivoFrutas);
    }
}