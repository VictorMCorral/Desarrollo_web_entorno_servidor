<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo1"])) {
    $carpeta = "." . DIRECTORY_SEPARATOR . "uploads";
    if (!file_exists($carpeta)) {
        mkdir($carpeta);
    }

    $extensiones = ["jpg", "jpeg", "png", "gif"];

    foreach ($_FILES["archivo1"]["tmp_name"] as $i => $nombreTemp) {
        $nombre = $_FILES["archivo1"]["name"][$i];
        $extension = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
        $tamanio = $_FILES["archivo1"]["size"][$i];

        $destino = $carpeta . DIRECTORY_SEPARATOR . $nombre;




        if ($tamanio <= (1024 * 1024 * 20) && in_array($extension, $extensiones)) {

            if (move_uploaded_file($nombreTemp, $destino)) {
                echo "<h3>{$nombre} Archivo movido con exito </h3>";
            } else {
                echo "<h3>Error al mover el archivo</h3>";
            }
        } else {
            echo "<h3>El archivo no cumple los requisitos</h3>";
        };
    }
}
