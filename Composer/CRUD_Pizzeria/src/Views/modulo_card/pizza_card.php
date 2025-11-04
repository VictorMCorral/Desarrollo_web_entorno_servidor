<div class="card h-100">
    <div class="card-body">
        <h5 class="card-title"> Pizza <?= $pizza->nombre ?></h5>
        <p class="card-text"> <strong>Ingredientes:</strong> <br><?= $pizza->ingredientes ?></p>
        <p class="card-text"><strong>Alergenos:</strong> <br><?= $pizza->alergenos ?></p>
        <p class="text-primary fw-bold">Precio: <?= number_format($pizza->precio, 2) ?> €</p>
        <a href="/updatePizza?id=<?=$pizza->id?>" class="btn btn-sm btn-outline-primary">Editar</a>
        <a href="/delPizza?id=<?= $pizza->id ?>" class="btn btn-sm btn-outline-primary">Eliminar</a>
    </div>
</div>