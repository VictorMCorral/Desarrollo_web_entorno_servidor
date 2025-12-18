<!DOCTYPE html>
<html lang="es">

@include('head')

<body class="bg-light">

    @include('partials.header')

    <div class="container my-4">

        <h1 class="text-center mb-4">Actualizar departamento</h1>

        @if(session("error"))
            <div id="alert" class="alert alert-danger text-center">
                {{ session("error") }}
            </div>
        @endif

        <form action="{{ route('departs.update', $depart->depart_no) }}"
              method="post"
              class="card shadow-sm p-4 col-lg-6 mx-auto">

            @csrf
            @METHOD("PUT")

            <div class="mb-3">
                <label class="form-label">Número de departamento</label>
                <input type="number"
                       class="form-control"
                       value="{{ $depart->depart_no }}"
                       disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre del departamento</label>
                <input type="text"
                       name="dnombre"
                       class="form-control"
                       value="{{ $depart->dnombre }}"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Localización</label>
                <input type="text"
                       name="loc"
                       class="form-control"
                       value="{{ $depart->loc }}"
                       required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('departs.index') }}" class="btn btn-secondary">
                    Volver
                </a>

                <button class="btn btn-primary">
                    Actualizar departamento
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
