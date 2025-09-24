<?php 
$media = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //echo "Por favor, ingresa numeros separados por un espacio: ";
    $numeros = trim($_POST["numeros"]);
    
    $arrayNumeros = explode(" ", $numeros);
    
    $arrayNumFloat = array_map("floatval", $arrayNumeros);
    
    $contador = count($arrayNumFloat);
    $sumaTotal = array_sum($arrayNumFloat);
    
    // Modifica para contar todos los elementos del array
    
    /*foreach($arrayNumFloat as $numero ){
        $contador++;
        $sumaTotal += $numero;
    }*/
    
    
    
    $media = $sumaTotal/$contador;
    
    //echo "Has introducido $contador numeros y todos suman $sumaTotal";
    //echo "La media es: $media";






}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Calculadora de promedio</h1>
    <form method="post">
        <label for="numeros">Introduce numeros separados por espacios: </label>
        <input type="text" name="numeros" id="">
        <input type="submit" value="Calcular">


        <?php if ($media != null) { ?>
            <p>El promedio es: <?php echo $media; ?></p>
            <?php } ?>
    </form>
</body>
</html>