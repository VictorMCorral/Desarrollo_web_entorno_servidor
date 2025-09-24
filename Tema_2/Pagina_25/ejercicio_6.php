<?php
/*
Calculadora basica:
    Crea una funcion para cada operacion matematica basica (suma, resta, multiplicacion, division). Cada funcion debe aceptar dos numeros como parametros y devolver el resultado.
    Crea funciones "normales", anonimas y flecha para las operaciones.
*/

$operacion = 3;
$operacionPalabra = "";
$a = 0;
$b = 0;

while ($operacion < 5 && $operacion > 0) {
    echo "¿Que operacion quiere realizar? \n";
    echo "1-suma \n";
    echo "2-resta \n";
    echo "3-multiplicacion \n";
    echo "4-division \n";
    echo "5-salir \n";
    $operacion = intval(trim(fgets(STDIN)));

    if ($operacion < 5 && $operacion > 0) {
        echo "Pon el primer numero: \n";
        $a = trim(fgets(STDIN));

        echo "Pon el segundo numero: \n";
        $b = trim(fgets(STDIN));

        $crearOperacion = elegirOperacion($operacion);

        if (is_numeric($a) && is_numeric($b)) {
            $resultado = $crearOperacion($a, $b);
            if ($operacion != 5 && $b != 0) {
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
                print_r("El resultado de " . $operacionPalabra . " " . $a . " y " . $b . " es " . $resultado . "\n\n");
            }
        } else if ($operacion == 0) {
            echo "Has introducido un valor erroneo\n";
        } else if (!is_numeric($a) || !is_numeric($b)) {
            echo "Has introducido un valor erroneo en los digitos\n ";
        } else {
            echo "Has salido de la VicCalculadora!! ";
        }
    }
};




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
