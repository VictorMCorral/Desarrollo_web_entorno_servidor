<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Listado de departamentos</h1>
    <ul>
        @foreach ($departs as $depart)
            <li>
                {{ $depart->depart_no }} con nombre {{ $depart->dnombre }} situado en {{ $depart->loc }} 
                <form action="{{  route('departs.destroy', $depart['depart_no']) }}" method="post">
                    @csrf 
                    @METHOD("DELETE")
                    <input type="submit" value="Eliminar">
                </form>
                <form action="{{  route('departs.edit', $depart['depart_no']) }}" method="get">
                    @csrf
                    <input type="submit" value="Actualizar">
                </form>
            </li>
        @endforeach
    </ul>


    <a href="{{ route('departs.create') }}">Crear un nuevo departamento</a>
</body>
</html>