<?php 

ini_set("session.gc_maxlifetime", 10);
ini_set("session.cookie_lifetime", 10);


session_start();


if (isset($_SESSION['usuario'])){
    echo "<h2>Sesion iniciada</h2>";
    echo "<p>Usuario: {$_SESSION['usuario']}</p>";
    echo "<p>Hora: {$_SESSION['hora']}</p>";
} else {
    echo "<p>Sesion no activa</p>";
}


echo "<p><a href='inicio.php'>Iniciar nueva sesion</a></p>";