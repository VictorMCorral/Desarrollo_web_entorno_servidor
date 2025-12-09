<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('departs.store') }}" method="post" >
        @csrf
        <label for="depart_no">Introduce el departamento</label>
        <br>
        <input type="text" name="depart_no" placeholder="Numero">
        <br><br>
        <label for="dnombre">Introduce el nombre</label>
        <br>
        <input type="text" name="dnombre" placeholder="Nombre">
        <br><br>
        <label for="loc">Localizacion</label>
        <br>
        <input type="text" name="loc" placeholder="Localizacion">
        <br><br>
        <input type="submit" value="Crear usuario">
    </form>
</body>
</html>