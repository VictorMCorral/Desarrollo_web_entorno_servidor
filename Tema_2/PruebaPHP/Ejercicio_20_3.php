<?php

session_start();

// Generar o recuperar número aleatorio
if (!isset($_SESSION['numRan'])) {
    $_SESSION['numRan'] = mt_rand(1, 100);
    $_SESSION['intentos'] = 0;
}

$numRan = $_SESSION['numRan'];
$intentos = $_SESSION['intentos'];

echo "En numero aleatorio es: $numRan\n";


$numAdivinar = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //echo "Introduce un numero: ";
    $numAdivinar = trim($_POST["numAdivinar"]);
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
        <label for="adivinar">Introduce un numero: </label>
        <input type="text" name="numAdivinar" id="">
        <input type="submit" value="adivinar">
    </form>
    <div id="respuesta">
        <?php if ($numAdivinar != null) { ?>
        <?php switch ($numAdivinar <=> $numRan) {
                case 1:
                    $_SESSION['intentos'] += 1;
                    echo "<p>El numero que quieres adivinar es menor</p>";
                    break;
                case 0:
                    $_SESSION['intentos'] += 1;
                    echo "<p>Has acertado el numero!</p>";
                    session_destroy();
                    break;
                case -1:
                    $_SESSION['intentos'] += 1;
                    echo "<p>El numero que quieres adivinar es mayor</p>";
                    break;
            }
        } ?>
        <p>
            <?php
            if ($_SESSION['intentos'] > 0) {
                echo $_SESSION['intentos'] . " intentos";
            }
            ?>
        </p>


    </div>
</body>

</html>