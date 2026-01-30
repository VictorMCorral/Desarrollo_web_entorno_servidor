@extends("layouts_prieto.home")

@section("content")
<!-- Fuentes e Iconos -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
    }

    /* Contenedor Maestro: Ocupa el espacio entre header y footer sin romperlos */
    .login-page-full-wrapper {
        min-height: 80vh; /* Altura para centrar verticalmente */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background-color: #f8fafc;
        background-image:
            radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(67, 56, 202, 0.05) 0px, transparent 50%);
    }

    /* Caja de Login: Ancho controlado */
    .login-box {
        max-width: 420px;
        width: 100%;
    }

    .login-card {
        background: white;
        border: none;
        border-radius: 30px;
        padding: 40px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }

    /* Línea decorativa superior */
    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: var(--primary-gradient);
    }

    .brand-logo-login {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 20px;
        margin-bottom: 20px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .login-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        letter-spacing: -1px;
        color: #1e293b;
    }

    /* Inputs Estilizados */
    .login-page-full-wrapper .form-floating > .form-control {
        border-radius: 15px;
        border: 2px solid #f1f5f9;
        background-color: #f8fafc;
    }

    .login-page-full-wrapper .form-floating > .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        background-color: white;
    }

    /* Botón Premium */
    .btn-login-submit {
        background: var(--primary-gradient);
        border: none;
        border-radius: 15px;
        padding: 14px;
        font-weight: 700;
        color: white;
        transition: all 0.3s;
    }

    .btn-login-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        color: white;
    }

    .custom-alert {
        border-radius: 15px;
        background-color: #fff1f2;
        color: #e11d48;
        border: none;
        font-size: 0.85rem;
    }
</style>

<div class="login-page-full-wrapper">
    <div class="login-box">
        <div class="login-card text-center">

            <a href="{{ route('home_prieto') }}">
                <img src="{{ asset('storage/img/logoN.png') }}" alt="Logo" class="brand-logo-login">
            </a>

            <h2 class="login-title">Bienvenido</h2>
            <p class="text-muted mb-4 small">Inicia sesión para continuar en Prieto Eats</p>

            @if($errors->any())
            <div class="alert custom-alert text-start mb-4">
                <ul class="mb-0 list-unstyled">
                    @foreach($errors->all() as $error)
                        <li><i class="bi bi-exclamation-circle me-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('login_prieto') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email" id="floatingInput" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="name@example.com" value="{{ old('email') }}" required>
                    <label for="floatingInput">Correo electrónico</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" id="floatingPassword" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" required>
                    <label for="floatingPassword">Contraseña</label>
                </div>

                <button class="btn btn-login-submit w-100 shadow-sm" type="submit">
                    Entrar ahora <i class="bi bi-arrow-right-short ms-1"></i>
                </button>
            </form>

            <div class="mt-4 pt-2">
                <p class="small text-muted mb-0">¿No tienes cuenta?</p>
                <a href="{{ route('register_prieto') }}" class="fw-bold text-decoration-none" style="color: #6366f1;">Regístrate aquí</a>
            </div>
        </div>

        <p class="text-center mt-4 text-muted small">
            © {{ date('Y') }} Prieto Eats — Todos los derechos reservados.
        </p>
    </div>
</div>
@endsection
