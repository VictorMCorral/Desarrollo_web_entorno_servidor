<!DOCTYPE html>
<html lang="es">

@include('head')

<body class="bg-light">

    @include('partials.header')

    <div class="container my-5">

        <div class="card shadow-sm p-5 text-center">

            <h1 class="mb-3 text-primary">
                Bienvenido a la página de departamentos
            </h1>

            <p class="text-muted mb-4">
                Desde aquí podrás gestionar los departamentos de la empresa:
                crear, actualizar y eliminar registros de forma sencilla.
            </p>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('departs.index') }}" class="btn btn-primary">
                    Ver departamentos
                </a>

                <a href="{{ route('departs.create') }}" class="btn btn-success">
                    Crear departamento
                </a>
            </div>
            <br>
            @auth
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('emple.index') }}" class="btn btn-primary">
                    Ver empleados
                </a>

                <a href="{{ route('emple.create') }}" class="btn btn-success">
                    Crear empleado
                </a>
            </div>
            @endauth
        </div>

    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>