<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lista de nombres</h1>
    <div>
        <ul>
            <?php 
            for ($i = 0; $i < $cantidad; $i++) {
            echo "<li>$lineas[$i]
                    <br> <a href=\"/delUser?id=$i\">Eliminar</a>    <a href=\"/editUser?id=$i\">Editar</a>
                </li>";
            echo "<br>";
            } 
            ?>
        </ul>

    </div>
    <hr>
    <form action="/crearUsuario" method="post">
        <label for="Usuario">Introduce el nombre del usuario:
            <input type="text" placeholder="Usuario a crear" name="Usuario" required>
        </label>
        <input type="submit" placeholder="Crear Usuario">
    </form>
</body>

</html>