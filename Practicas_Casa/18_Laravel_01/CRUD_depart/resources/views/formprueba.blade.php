<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@include('head')

<body>
    @include('partials.header')


    @if( session("success"))
        <h3 id="alert" class="alert alert-success">
            {{ session("success") }}
        </h3>
    @elseif ($errors->any())
        <h3 id="alert" class="alert alert-danger">
            <ul style="list-style: none;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </h3>
    @endif

    <hr>
    <form action="{{ route('form.prueba') }}" method="post">
        @csrf
        <label for="nombre">Introduce el departamento</label>
        <br>
        <input type="text" name="nombre" placeholder="Nombre">
        <input type="submit" value="Enviar">
    </form>
    <hr>

    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        setTimeout(() => {
            document.querySelector("#alert").style.display = "none";
        }, 3000);
    </script>
</body>
</html>