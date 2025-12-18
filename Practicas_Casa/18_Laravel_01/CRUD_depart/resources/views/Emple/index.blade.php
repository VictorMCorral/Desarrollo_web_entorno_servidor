<!DOCTYPE html>
<html lang="es">

@include('head')

<body class="bg-light">

    @include('partials.header')

    <div class="container my-4">

        <h1 class="text-center mb-4">Listado de empleados</h1>

        @if(session("success"))
        <div id="alert" class="alert alert-success text-center">
            {{ session("success") }}
        </div>
        @elseif(session("error"))
        <div id="alert" class="alert alert-danger text-center">
            {{ session("error") }}
        </div>
        @endif

        <div class="row g-4">
            @foreach ($emples as $emple)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">

                    @if (!empty($emple->foto))
                    <img src="{{ asset('storage/'.$emple->foto) }}"
                        class="card-img-top"
                        style="height: 250px; object-fit: cover;">
                    @else
                    <div class="d-flex align-items-center justify-content-center bg-secondary text-white"
                        style="height: 250px;">
                        Sin foto
                    </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            {{ $emple->apellido }}
                        </h5>

                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">
                                <strong>Nº Empleado:</strong> {{ $emple->emple_no }}
                            </li>
                            <li class="list-group-item">
                                <strong>Oficio:</strong> {{ $emple->oficio }}
                            </li>
                            <li class="list-group-item">
                                <strong>Director:</strong>
                                {{ $emple->director ? $emple->director->apellido : 'Sin director' }}
                            </li>
                            <li class="list-group-item">
                                <strong>Fecha alta:</strong> {{ $emple->fecha_alt }}
                            </li>
                            <li class="list-group-item">
                                <strong>Salario:</strong> {{ $emple->salario }} €
                            </li>
                            <li class="list-group-item">
                                <strong>Comisión:</strong> {{ $emple->comision ?? '—' }}
                            </li>
                            <li class="list-group-item">
                                <strong>Departamento:</strong>
                                {{ $emple->depart ? $emple->depart->dnombre : 'Sin departamento' }}
                            </li>
                        </ul>

                        <div class="d-flex justify-content-between">
                            <form action="{{ route('emple.edit', $emple->emple_no) }}" method="get">
                                <button class="btn btn-warning btn-sm">
                                    Actualizar
                                </button>
                            </form>

                            <form action="{{ route('emple.destroy', $emple->emple_no) }}"
                                method="post"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este empleado?')">
                                @csrf
                                @METHOD("DELETE")
                                <button class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
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