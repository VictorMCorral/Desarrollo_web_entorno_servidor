<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Listado de empleados:</h1>
    <ul>
        <?php
        foreach ($empleados as $emple){
            $depart_emple = "";
            foreach ($departamentos as $depart){
                if($depart['dept_no'] == $emple['dept_no']){
                    $depart_emple = $depart['dnombre'];
                } 
            }

            echo "<li>Numero: {$emple['emple_no']},<br> Apellido: {$emple['apellido']},<br> Oficio: {$emple['oficio']} <br> Departamento: {$depart_emple}.</li>";
            echo "<br>";
        };
        ?>
    </ul>
    <a href="/">Volver al inicio</a>
</body>
</html>