<form action="/addPizza2" method="post">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="card-title"><strong>Nombre: <br></strong><input type="text" size="25" name="nombre" placeholder="Nombre de la pizza"> </h5>
            <p class="card-text"> <strong>Ingredientes:</strong> <br><input type="text" size="50" name="ingredientes" placeholder="Todos los ingredientes"></input></p>
            <p class="card-text"> <strong>Alergenos:</strong> <br><input type="text" size="50" name="alergenos" placeholder="Todos los alergenos"></input></p>
            <p class="text-primary fw-bold">Precio: <input type="number" step="0.01" name="precio" placeholder="0.00"> €</p>
            <input type="submit" value="Agregar">
        </div>
    </div>
</form>