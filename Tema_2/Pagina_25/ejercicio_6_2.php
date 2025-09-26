<?php
$operacion = null;
$operacionPalabra = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $operacion = $_POST["operacion"];
    $a = trim($_POST["a"]);
    $b = trim($_POST["b"]);
    $crearOperacion = elegirOperacion($operacion);

    $resultado = $crearOperacion($a, $b);
}

function elegirOperacion($operacion)
{
    if ($operacion == 1) {
        return fn($a, $b) => $a + $b;
    } elseif ($operacion == 2) {
        return fn($a, $b) => $a - $b;
    } elseif ($operacion == 3) {
        return fn($a, $b) => $a * $b;
    } elseif ($operacion == 4) {
        return function ($a, $b) {
            if ($b != 0) {
                return $a / $b;
            } else {
                echo "No se puede dividir entre 0 \n";
            };
        };
    };
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
    <form method="post">
        <label for="operacion">Selecciona una operacion</label>
        <select name="operacion" id="operacion">
            <option value="0" disabled selected>Elige una operacion</option>
            <option value="1">sumar</option>
            <option value="2">restar</option>
            <option value="3">multiplicar</option>
            <option value="4">dividir</option>
        </select>
        <br>
        <label for="a">Introduce el primer numero: </label>
        <input type="number" name="a" id="" require>
        <br>
        <label for="a">Introduce el segundo numero: </label>
        <input type="number" name="b" id="" require><br>
        <input type="submit" value="Calcular">
        <p>
            <?php
            if ($operacion != null) {
                switch ($operacion) {
                    case 1:
                        $operacionPalabra = "suma";
                        break;
                    case 2:
                        $operacionPalabra = "resta";
                        break;
                    case 3:
                        $operacionPalabra = "multiplicar";
                        break;
                    case 4:
                        $operacionPalabra = "dividir";
                        break;
                }
                print_r("El resultado de " . $operacionPalabra . " " . $a . " y " . $b . " es " . $resultado );
            }
            ?></p>

    </form>
</body>

</html>