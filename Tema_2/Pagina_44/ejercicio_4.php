<?php
/*
Crea un archivo seguro:
    - Intenta crear un archivo nuevo usuarios.txt con fopen en modo x.
    - Si el archivo ya existe, abrelo en modo lectura y escritura (r+) pero antes de abrirlo, verifica permisos con is_writeable
    - Añade una nueva linea con un nombre de usuario
    - Finalmente, renombra o mueve el archivo a otra carpeta usando rename
*/

$ruta = "." . DIRECTORY_SEPARATOR . "mi_usuario";
$archivo1 = "usuarios.txt";
if (!is_dir($ruta)) {
    mkdir($ruta);
} else {
    echo "El directorio ya esta creado.\n";
}

$rutaArchivo1 = $ruta . DIRECTORY_SEPARATOR . $archivo1;

if (file_exists($rutaArchivo1)) {
    if (is_writable($rutaArchivo1)) {
        $resArchivo1 = fopen($rutaArchivo1, "r+");
        echo "Abierto en modo r+";
        //Esto se puede poner fuera de if
        fwrite($resArchivo1, "Victor Manuel Corral Ruiz en modo \"r+\"");
    } else {
        echo "No es escribible";
    }
} else {
    $resArchivo1 = fopen($rutaArchivo1, "x");
    echo "Abierto en modo x";
    //Esto se puede poner fuera de if
    fwrite($resArchivo1, "Victor Manuel Corral Ruiz en modo \"x\"");
}

fclose($resArchivo1);

$archivo2 = "usuariosMovido.txt";
$nuevaRuta = $ruta . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . $archivo2;

rename($rutaArchivo1, $nuevaRuta);
