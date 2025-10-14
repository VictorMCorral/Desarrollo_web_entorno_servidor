<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/saveUser" method="post">
        <label for="modificar"> Estas modificando el siguiente usuario: 
            <input type="text" name="user" value="<?= $usuario ?>">
            <input type="hidden" name="pos" value="<?= $usuarioEditar ?>">
        </label>
        <input type="submit" value="Modificar">
        
    </form>
</body>
</html>