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
        <h1>Listado de pizzas: </h1>
        <div class="row">
            <?php
                foreach ($pizzas as $pizza) {
                    echo "<div class=\"col-12 col-sm-6 col-md-6 col-lg-3 mb-4\">";
                    require __DIR__ . "/../Views/modulo_card/pizza_card.php";
                    echo "</div>";
                };
                    ?>
        </div>
    </div>

    <?php require __DIR__ . "/../Views/modulo_card/footer.php";?>
</body>

</html>