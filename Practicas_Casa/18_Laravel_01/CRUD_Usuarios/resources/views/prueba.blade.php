<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>{{ $titulo }}</h1>
    <hr>
    <h3>Get all</h3>
    <a href="/usuarios">Mostrar todos</a>
    <hr>
    <h3>Put one</h3>
    <a href="/usuarios/create">Crear nuevo usuario</a>
    <hr>
    <h3>Get one</h3>
    <form action="/usuarios/{id}" method="get">
        <input type="text" name="id">
        <input type="submit" value="Buscar usuario">
    </form>

</body>
</html>