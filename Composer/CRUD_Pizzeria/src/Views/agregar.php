<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Victor's Pizzas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="/css/headers.css" rel="stylesheet" />
</head>

<body>
    <?php require __DIR__ . "/../Views/modulo_card/header.php"; ?>
    <div class="container">    
        <h1>Agregar pizza: </h1>
        <div class="row">
            <div class="col">
            <?php
                    require __DIR__ . "/../Views/modulo_card/agregar_card.php";
                    ?>
            </div>
        </div>
    </div>
    <?php require __DIR__ . "/../Views/modulo_card/footer.php"; ?>
</body>

</html>