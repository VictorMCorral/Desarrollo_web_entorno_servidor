<?php


/* Define una clase  de excepcion personalizada llamada EdadInvalidaException. 
Crea una funcion verificarEdad($edad) que:
    Lance una EdadInvalidaExcepcion si la edad es negativa o menor de 18 años
    Devuelva un mensaje de acceso permitido si la edad es valida.
En el programa principal, prueba con varias edades dentro de un bloque try.. catch..finally
*/


class EdadInvalidaException extends Exception {}

echo "Introduce tu edad: ";
$edad = trim(fgets(STDIN));


try {
    verificarEdad($edad);
} catch (EdadInvalidaException $e) {
    echo "Error: " . $e->getMessage();
}




function verificarEdad($edad){
    if ($edad < 18) {
        throw new EdadInvalidaException("Eres menor de edad");
    } else {
        echo "Eres mayor de edad";
    }
}
