<div class="card h-100">
    <div class="card-body">
        <h5 class="card-title"> <?= $dep["dnombre"] ?></h5>
        <p class="card-text"> <strong>Id:</strong> <br><?= $dep['dept_no'] ?></p>
        <p class="card-text"><strong>Localizacion:</strong> <br><?= $dep['loc'] ?></p>
        <a href="/eliminarDept?dept_no=<?=$dep['dept_no']?>" class="btn btn-sm btn-outline-primary">Eliminar</a>
        <a href="/modificarDept?dept_no=<?=$dep['dept_no']?>" class="btn btn-sm btn-outline-primary">Modificar</a>
    </div>
    </div>
</div>