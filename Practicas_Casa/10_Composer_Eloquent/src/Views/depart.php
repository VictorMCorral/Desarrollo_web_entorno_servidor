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
            echo "<li>Numero: {$depart->dept_no}, Nombre: {$depart->dnombre}, Localidad {$depart->loc}, 
            <a href=\"/eliminarDept?dept_no={$depart->dept_no}\">Eliminar</a>  <a href=\"/modificarDept?dept_no={$depart->dept_no}\">Modificar</a></li>";
            echo "<li>Empleados: </li>";
            echo "<ul>";
            foreach ($empleados as $emple){
                if($depart->dept_no == $emple->dept_no ){
                    echo "<li>Numero: {$emple->emple_no}, Apellido: {$emple->apellido}, Oficio: {$emple->oficio}, Departamento: {$depart->dnombre}
                        <a href=\"/eliminarEmple?emple_no={$emple->emple_no}\">Eliminar</a>  <a href=\"/modificarEmple?emple_no={$emple->emple_no}\">Modificar</a></li>";
                }
            }
            echo "</ul>";
            echo "<br>";
        };
        ?>
    </ul>
    <a href="/">Volver al inicio</a>
</body>
</html>