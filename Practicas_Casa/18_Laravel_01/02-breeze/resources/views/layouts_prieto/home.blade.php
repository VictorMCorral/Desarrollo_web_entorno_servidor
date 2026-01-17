<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token para seguridad en formularios -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Prieto Eats')</title> <!-- Permite cambiar título por página -->

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="font-sans antialiased">

    <div class="min-vh-100 d-flex flex-column bg-light">
        {{-- Cabecera --}}
        @include('layouts_prieto.cabecera')

        {{-- Contenido principal --}}
        <main class="flex-grow-1 py-4">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('layouts_prieto.footer')
    </div>

    <!-- Scripts de Bootstrap (opcional si necesitas JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Y4kV+f7MLrZbKzp5q+KXxM4FJz0g/m5YF7E57tC95UlH6yUPF4uIYOGz0pTz6CnK"
        crossorigin="anonymous"></script>

    <!-- Scripts personalizados -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
