<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>{{ $titulo }}</h1>

    <form action="{{ route('usuarios.update', $usuario['id']) }}" method="post">
        @csrf @method('PUT')
        <input type="hidden" value="{{ $usuario['id'] }}" name="id">
        <label for="nombre">Escribe el nombre: 
            <input type="text" value="{{ $usuario['name'] }}" name="nombre">
        </label>
        <br>
        <label for="email">Escribe el email: 
            <input type="text" value="{{ $usuario['email'] }}" name="email">
        </label>
        <br>
        <input type="submit" value="Actualizar usuario">
    </form>


</body>

</html>