<!DOCTYPE html>
<html lang="es">

@include('head')

<body class="bg-light">

    @include('partials.header')

    <div class="container my-4">

        <h1 class="text-center mb-4">Crear empleado</h1>

        @if(session("error"))
            <div id="alert" class="alert alert-danger text-center">
                {{ session("error") }}
            </div>
        @endif

        <form action="{{ route('emple.store') }}"
              method="post"
              enctype="multipart/form-data"
              class="card shadow-sm p-4">

            @csrf

            <div class="mb-3">
                <label class="form-label">Número de empleado</label>
                <input type="number"
                       name="emple_no"
                       class="form-control"
                       placeholder="Introduce el número"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellido</label>
                <input type="text"
                       name="apellido"
                       class="form-control"
                       placeholder="Introduce el apellido"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Oficio</label>
                <input type="text"
                       name="oficio"
                       class="form-control"
                       placeholder="Introduce el oficio"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Director</label>
                <select name="dir" class="form-select">
                    <option value="">-- Sin director --</option>
                    @foreach($emples as $e)
                        <option value="{{ $e->emple_no }}">
                            {{ $e->emple_no }} - {{ $e->apellido }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de alta</label>
                <input type="date"
                       name="fecha_alt"
                       class="form-control"
                       required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Salario</label>
                    <input type="number"
                           name="salario"
                           class="form-control"
                           placeholder="0"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Comisión</label>
                    <input type="number"
                           name="comision"
                           class="form-control"
                           placeholder="0">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Departamento</label>
                <select name="depart_no" class="form-select" required>
                    <option value="">-- Seleccione departamento --</option>
                    @foreach($departs as $d)
                        <option value="{{ $d->depart_no }}">
                            {{ $d->depart_no }} - {{ $d->dnombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Foto del empleado</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('emple.index') }}" class="btn btn-secondary">
                    Volver
                </a>

                <button class="btn btn-success">
                    Crear empleado
                </button>
            </div>

        </form>

    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(() => {
            const alert = document.querySelector("#alert");
            if (alert) alert.style.display = "none";
        }, 3000);
    </script>

</body>
</html>
