<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>{{ $titulo }}</h1>
    <h4>{{ $error }}</h4>
    <ul>
        @foreach ($contenido as $usuario)
        <li>ID: {{ $usuario['id'] }} nombre: {{ $usuario['name'] }} email: {{ $usuario['email'] }}
            <form action="{{ route('usuarios.destroy', $usuario['id']) }}" method="post">
                @csrf @method('DELETE')
                <input type="submit" value="Eliminar usuario">
            </form>

        </li>
        @endforeach
    </ul>

    <a href="/">Volver atras</a>
</body>

</html>