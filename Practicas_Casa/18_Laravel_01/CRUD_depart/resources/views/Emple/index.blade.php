<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Listado de empleados</h1>
    <ul>
        @foreach ($emples as $emple)
            <li>
                {{ $emple->emple_no }}, {{ $emple->apellido }}, {{ $emple->oficio }}, {{ $emple->dir }}, {{ $emple->fecha_alt }}, {{ $emple->salario }}, {{ $emple->comision }}, {{ $emple->depart_no }}
            </li>
        @endforeach
    </ul>

</body>
</html>