<?php

/*
Manejo de directorios:
    - Crea un directorio mis_archivos con mkdir
    - Dentro, crea algunos archivos de prueba (archivo1.txt, archivo2.txt)
    - Lista todos los archivos con scandir y muestra los nombres por pantalla.
    - Borra uno de los archivos con unlink y finalmente elimina la carpeta con rmdir
*/

$ruta = "." . DIRECTORY_SEPARATOR . "mis_archivos";
$archivo1 = "archivo1.txt";
$archivo2 = "archivo2.txt";

if (mkdir($ruta)) {
    $rutaArchivo1 = $ruta . DIRECTORY_SEPARATOR . $archivo1;
    $resArchivo1 = fopen($rutaArchivo1, "x+");
    if ($resArchivo1) {
        echo "Archivo abierto con exito {$rutaArchivo1}\n";
        fwrite($resArchivo1, "Escribiendo en el archivo \"Archivo1.txt\" \n");
        fwrite($resArchivo1, "Victor Manuel Corral Ruiz \n");
        fclose($resArchivo1);
    } else {
        echo "Archivo1.txt ya esta creado";
    }


    $rutaArchivo2 = $ruta . DIRECTORY_SEPARATOR . $archivo2;
    $resArchivo2 = fopen($rutaArchivo2, "x+");
    if ($resArchivo2) {
        echo "Archivo abierto con exito {$rutaArchivo2}\n";
        fwrite($resArchivo2, "Escribiendo en el archivo \"Archivo1.txt\" \n");
        fwrite($resArchivo2, "Victor Manuel Corral Ruiz \n");
        fclose($resArchivo2);
    } else {
        echo "Archivo2.txt ya esta creado";
    }


    $archivos = scandir($ruta);

    foreach ($archivos as $arch) {
        if ($arch != "." && $arch != "..")
            echo $arch . "\n";
    }
    /*

    -- Eliminar de forma manual 

    echo "Se eliminaran los archivos: \n";
    if (unlink($rutaArchivo1)){
        echo "\tElimado el archivo1.txt \n";
    }

    if (unlink($rutaArchivo2)){
        echo "\tElimado el archivo2.txt \n";
    }

    if(rmdir($ruta)){
        echo "\tCarpeta eliminada";
    }
    */

    // Eliminar todo lo que tenga dentro, sean la cantidad que sean
    foreach ($archivos as $arch) {
        if ($arch != "." && $arch != "..") {
            $rutaCompleta = $ruta . DIRECTORY_SEPARATOR . $arch;
            eliminarArchivos($rutaCompleta);
        }
    }
    
    if(rmdir($ruta)){
        echo "\tCarpeta eliminada";
    }
    

} else {
    echo "La carpeta ya esta creada";


}

function eliminarArchivos($archivo){
    if (unlink($archivo)){
        echo "\tElimado el {$archivo} \n";
    }
}
