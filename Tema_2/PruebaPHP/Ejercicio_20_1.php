<?php 
$hora = date("H");
echo "La hora es: $hora\n";

if ($hora < 12){
    echo "Buenos dias";
} else if ($hora >= 12 && $hora < 21){
    echo "Buenas tardes";
} else {
    echo "Buenas noches";
}
?>