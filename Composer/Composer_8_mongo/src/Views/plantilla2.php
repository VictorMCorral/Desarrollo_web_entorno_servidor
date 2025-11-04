<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$tittle?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="/css/headers.css" rel="stylesheet" />
</head>

<body>
    <header>
        <h1>Bienvenido a mi Sitio Web</h1>
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="/about">Acerca de</a></li>
                <li><a href="/listDept_2">Listado departamentos</a></li>
                <li><a href="/crear_2">Agregar departamento</a></li>
            </ul>
        </nav>
    </header>
    <hr>
    <?= $contenido ?>
    <hr>
    <footer>
        <h4>Soy el footer</h4>
    </footer>
</body>

</html>