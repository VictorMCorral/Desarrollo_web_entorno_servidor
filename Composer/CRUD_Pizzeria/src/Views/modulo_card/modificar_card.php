<form action="/updatePizza2" method="post">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="card-title"><strong>Nombre: <br></strong><input type="text" value="<?= $pizza->nombre ?>" size="25" name="nombre"> </h5>
            <p class="card-text"> <strong>Ingredientes:</strong> <br><input type="text" value="<?= $pizza->ingredientes ?>" size="50" name="ingredientes"></input></p>
            <p class="card-text"> <strong>Alergenos:</strong> <br><input type="text" value="<?= $pizza->alergenos ?>" size="50" name="alergenos"></input></p>
            <p class="text-primary fw-bold">Precio: <input type="number" step="0.01" value=<?= $pizza->precio ?> name="precio"> €</p>
            <input type="hidden" name="id" value="<?=$pizza->id?>">
            <input type="submit" value="Actualizar">
        </div>
    </div>
</form>