<!DOCTYPE html>
<html lang="es">

@include('head')

<body class="bg-light">

    @include('partials.header')

    <div class="container my-4">

        <h2 class="text-center mb-4">Actualizar empleado</h2>

        <form action="{{ route('emple.update', $emple->emple_no) }}"
            method="post"
            enctype="multipart/form-data"
            class="card shadow p-4">

            @csrf
            @METHOD("PUT")

            <div class="mb-3">
                <label class="form-label">Número de empleado</label>
                <input type="number" class="form-control" value="{{ $emple->emple_no }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="{{ $emple->apellido }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Oficio</label>
                <input type="text" name="oficio" class="form-control" value="{{ $emple->oficio }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Director</label>
                <select name="dir" class="form-select">
                    <option value="">-- Sin director --</option>
                    @foreach($emples as $e)
                    <option value="{{ $e->emple_no }}"
                        @if($e->emple_no == $emple->dir) selected @endif>
                        {{ $e->emple_no }} - {{ $e->apellido }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de alta</label>
                <input type="date" name="fecha_alt" class="form-control" value="{{ $emple->fecha_alt }}">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Salario</label>
                    <input type="number" name="salario" class="form-control" value="{{ $emple->salario }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Comisión</label>
                    <input type="number" name="comision" class="form-control" value="{{ $emple->comision }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Departamento</label>
                <select name="depart_no" class="form-select">
                    <option value="">-- Seleccione departamento --</option>
                    @foreach($departs as $d)
                    <option value="{{ $d->depart_no }}"
                        @if($d->depart_no == $emple->depart_no) selected @endif>
                        {{ $d->depart_no }} - {{ $d->dnombre }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- FOTO --}}
            <div class="mb-4">
                <label class="form-label">Foto del empleado</label>
                <input type="file" name="foto" class="form-control">

                @if($emple->foto)
                <div class="mt-3">
                    <p class="mb-1 text-muted">Foto actual:</p>
                    <img src="{{ asset('storage/'.$emple->foto) }}"
                        class="img-thumbnail"
                        width="200">
                </div>
                @endif
            </div>

            <div class="text-center">
                <button class="btn btn-primary btn-lg">
                    Actualizar empleado
                </button>
            </div>

        </form>

    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>