<?php 


ini_set("session.cookie_secure", false);
ini_set("session.cookie_httponly", true);
ini_set("session.gc_maxlifetime", 10);
ini_set("session.cookie_lifetime", 10);
ini_set("session.cookie_strictmode", true);


session_start();

$_SESSION['usuario'] = "Victor M. Corral";
$_SESSION["hora"] = date("H:i:s");

echo "<h2>Sesion iniciada</h2>";
echo "<p>Usuario: {$_SESSION['usuario']}</p>";
echo "<p>Hora: {$_SESSION['hora']}</p>";

echo "<p><a href='ver.php'>Ver sesion</a></p>";
echo "<p><a href='logout.php'>Cerrar sesion</a></p>";