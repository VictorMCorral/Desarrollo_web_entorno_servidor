<?php
echo $_FILES["archivo"]["tmp_name"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"])) {
    $extensiones = ["jpg", "jpeg", "png", "gif"];
    $nombreTemp = $_FILES["archivo"]["tmp_name"];
    $nombre = $_FILES["archivo"]["name"];
    $nombreTemp = $_FILES["archivo"]["tmp_name"];
    $extension = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
    $tamanio = $_FILES["archivo"]["size"];


    $carpeta = "." . DIRECTORY_SEPARATOR . "uploads";
    $destino = $carpeta . DIRECTORY_SEPARATOR . $nombre;

    if (!file_exists($carpeta)) {
        mkdir($carpeta);
    }



    if ($tamanio <= (1024 * 1024 * 2) && in_array($extension, $extensiones)) {
        if (move_uploaded_file($nombreTemp, $destino)) {
            echo "Archivo movido con exito";
        } else {
            echo "Error al mover el archivo";
        }
    } else {
        echo "El archivo no cumple los requisitos";
    };
}

