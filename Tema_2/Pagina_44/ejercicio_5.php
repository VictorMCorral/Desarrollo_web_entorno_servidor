<?php
/*
Leer y escribir archivos grandes.
    - Crea un archivo grande archivo grande.txt (puedes hacer un bloque que repita una linea)
    - Abre el archivo en modo lectura
    - Lee bloques de 1024 bytes usando fread;
    - Luego lee linea a linea con fgets y cuente el total de lineas
*/

$ruta = "." . DIRECTORY_SEPARATOR . "archivo_grande";
$archivo1 = "ArchGrande.txt";
if (!is_dir($ruta)) {
    mkdir($ruta);
} else {
    echo "El directorio ya esta creado\n";
}

$rutaArchivo1 = $ruta . DIRECTORY_SEPARATOR . $archivo1;

if (file_exists($rutaArchivo1)) {
    if (is_writable($rutaArchivo1)) {
        $resArchivo1 = fopen($rutaArchivo1, "r+");
        escribirGrande($resArchivo1);
        fclose($resArchivo1);
    } else {
        echo "No es escribible";
    }
} else {
    $resArchivo1 = fopen($rutaArchivo1, "x");
    echo "Abierto en modo x";
    escribirGrande($resArchivo1);
    fclose($resArchivo1);
}

$resArchivo1 = fopen($rutaArchivo1, "r");


//Ajustar para leer TODO el documento
echo "MODO POR COMPLETO";
while (!feof($resArchivo1)){
    $contenido = fread($resArchivo1, 1024);
    echo "$contenido \n";
}


echo "MODO POR LINEAS";
fseek($resArchivo1, 0, SEEK_SET);

/*while (($linea = fgets($resArchivo1)) !== false){
    echo "$linea \n";
};*/




function escribirGrande($resArchivo){
    for ($i = 0; $i <1000; $i++){
        fwrite($resArchivo, "$i Victor Manuel Corral Ruiz\n");
    }
}