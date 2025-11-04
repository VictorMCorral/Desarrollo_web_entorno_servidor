<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Modificar departamento</h1>
    <form action="/modificarDept2" method="post">
        <label for="dept_no">Numero:
            <input type="number" value="<?=$dept_no?>" name="dept_no" readonly>
        </label><br>
        <label for="dnombre">Nombre:
            <input type="text" value="<?=$dnombre?>" name="dnombre">
        </label><br>
        <label for="loc">Localidad:
            <input type="text" value="<?=$loc?>" name="loc">
        </label><br><br>
        <input type="submit" value="Modificar">
    </form>
</body>
</html>