<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Listado de departamentos:</h1>
    <ul>
        <?php
        foreach ($departamentos as $depart){
            echo "<li>Numero: {$depart['dept_no']},
            <br> Nombre: {$depart['dnombre']},
            <br> Localidad {$depart['loc']},
            <br> <a href=\"/eliminarDept?dept_no={$depart['dept_no']}\">Eliminar</a>  <a href=\"/modificarDept?dept_no={$depart['dept_no']}\">Modificar</a></li>";
            echo "<br>";
        };
        ?>
    </ul>
    <a href="/">Volver al inicio</a>
</body>
</html>