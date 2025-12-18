<!DOCTYPE html>
<html lang="es">

@include('head')

<body class="bg-light">

    @include('partials.header')

    <div class="container my-4">

        <h1 class="text-center mb-4">Listado de departamentos</h1>

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
            @foreach ($departs as $depart)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">

                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                {{ $depart->dnombre }}
                            </h5>

                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item">
                                    <strong>Nº Departamento:</strong> {{ $depart->depart_no }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Nombre:</strong> {{ $depart->dnombre }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Localización:</strong> {{ $depart->loc }}
                                </li>
                            </ul>

                            <div class="d-flex justify-content-between">
                                <form action="{{ route('departs.edit', $depart->depart_no) }}" method="get">
                                    <button class="btn btn-warning btn-sm">
                                        Actualizar
                                    </button>
                                </form>

                                <form action="{{ route('departs.destroy', $depart->depart_no) }}"
                                      method="post"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este departamento?')">
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
