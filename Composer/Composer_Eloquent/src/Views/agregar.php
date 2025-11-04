<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Modificar departamento</h1>
    <form action="/addDepart2" method="post">
        <label for="dept_no">Numero:
            <input type="number" placeholder="Numero" name="dept_no">
        </label><br>
        <label for="dnombre">Nombre:
            <input type="text" placeholder="Nombre" name="dnombre">
        </label><br>
        <label for="loc">Localidad:
            <input type="text" placeholder="Localidad" name="loc">
        </label><br><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>