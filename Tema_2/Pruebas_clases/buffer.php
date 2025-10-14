<?php 

$titulo = "Mi pagina de buffers";
$encabezado = "BUFFERS CONTROLLERS";
$contenido = "Esta sera mi primera pagina de errores alternativos";
$redirigir = false;

ob_start();
require "buffer_template.php";
$pagina = ob_get_contents();

$pagina = str_replace("errores", "buffers", $pagina);

if($redirigir){
    header('Location: index_3.php');
} else {
    ob_end_clean();
    echo $pagina;
}