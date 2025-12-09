<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>{{ $titulo }}</h1>


    <form action="/usuarios" method="post">
        @csrf
        <label for="nombre">Escribe el nombre: 
            <input type="text" placeholder="Nombre" name="nombre">
        </label>
        <br>
        <label for="email">Escribe el email: 
            <input type="text" placeholder="email" name="email">
        </label>
        <br>
        <input type="submit" value="Crear nombre">
    </form>


</body>

</html>