<?php

/*
Crea un archivo colores.txt vacio: 
    - Crea un archivo colores .txt vacio:
    - Con fwrite añade tres colores diferentes, una linea por color, usando bloque con flock para evitar conflictos si hay varios procesos escribiendo
    - Muestra el contenido del fichero por pantalla
    - Con file_put_contents sobreescribe el archivo con un nuevo color
    - Muestra su contenido por pantalla
*/

$ruta = "." . DIRECTORY_SEPARATOR . "mi_color";
$archivo1 = "colores.txt";

if (mkdir($ruta)) {
    $rutaArchivo1 = $ruta . DIRECTORY_SEPARATOR . $archivo1;
    $resArchivo1 = fopen($rutaArchivo1, "w+");
    if (flock($resArchivo1, LOCK_EX)) {
        fwrite($resArchivo1, "Rojo\nNaranja\nVerde\n");
        /*
        flock($resArchivo1, LOCK_UN);
        fclose($resArchivo1);

        $resArchivo1 = fopen($rutaArchivo1, "r");
        */
        fseek($resArchivo1, 0, SEEK_SET);
        $contenido = fread($resArchivo1, filesize($rutaArchivo1));
        echo $contenido . "\n";

        fclose($resArchivo1);

        file_put_contents($rutaArchivo1, "Negro azabache");

        $resArchivo1 = fopen($rutaArchivo1, "r");      

        fseek($resArchivo1, SEEK_SET);
        $contenido = fread($resArchivo1, filesize($rutaArchivo1));
        echo $contenido . "\n";

        flock($resArchivo1, LOCK_UN);
        fclose($resArchivo1);

        $archivos = scandir($ruta);

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
        echo "No se pudo bloquear el archivo \n";
    }
}


function eliminarArchivos($archivo){
    if (unlink($archivo)){
        echo "\tElimado el {$archivo} \n";
    }
}
