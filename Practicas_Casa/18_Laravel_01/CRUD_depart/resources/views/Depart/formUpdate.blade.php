<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('departs.update', $depart['depart_no']) }}" method="post" >
        @csrf
        @METHOD("PUT")
        <label for="depart_no">Introduce el departamento</label>
        <br>
        <input type="text" name="depart_no" placeholder="{{ $depart->depart_no }}">
        <br><br>
        <label for="dnombre">Introduce el nombre</label>
        <br>
        <input type="text" name="dnombre" placeholder="{{ $depart->dnombre }}">
        <br><br>
        <label for="loc">Localizacion</label>
        <br>
        <input type="text" name="loc" placeholder="{{ $depart->loc }}">
        <br><br>
        <input type="submit" value="Crear usuario">
    </form>
</body>
</html>