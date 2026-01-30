@extends("layouts_prieto.home")

@section("content")
<!-- Fuentes e Iconos -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
    }

    /* Contenedor Maestro: Centra el formulario sin afectar Header/Footer */
    .register-page-wrapper {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 20px;
        background-color: #f8fafc;
        background-image:
            radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(67, 56, 202, 0.05) 0px, transparent 50%);
    }

    .register-box {
        max-width: 480px;
        width: 100%;
    }

    .register-card {
        background: white;
        border: none;
        border-radius: 35px;
        padding: 40px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }

    /* Línea decorativa superior */
    .register-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 8px;
        background: var(--primary-gradient);
    }

    .register-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        letter-spacing: -1.5px;
        color: #1e293b;
    }

    /* Inputs Estilizados */
    .register-page-wrapper .form-floating > .form-control {
        border-radius: 16px;
        border: 2px solid #f1f5f9;
        background-color: #f8fafc;
        transition: all 0.2s;
    }

    .register-page-wrapper .form-floating > .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        background-color: white;
    }

    .register-page-wrapper .form-floating > label {
        color: #94a3b8;
        padding-left: 1.2rem;
    }

    /* Botón Premium */
    .btn-register-submit {
        background: var(--primary-gradient);
        border: none;
        border-radius: 16px;
        padding: 15px;
        font-weight: 700;
        color: white;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.2);
    }

    .btn-register-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 25px -5px rgba(99, 102, 241, 0.4);
        color: white;
    }

    /* Errores */
    .custom-error-alert {
        background-color: #fff1f2;
        color: #e11d48;
        border: none;
        border-radius: 16px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .icon-box {
        width: 60px;
        height: 60px;
        background: #eef2ff;
        color: #6366f1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        margin: 0 auto 20px;
        font-size: 1.5rem;
    }
</style>

<div class="register-page-wrapper">
    <div class="register-box">
        <div class="register-card">

            <div class="text-center">
                <div class="icon-box">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h2 class="register-title mb-1">Crea tu cuenta</h2>
                <p class="text-muted small mb-4">Únete a la comunidad de Prieto Eats</p>
            </div>

            @if($errors->any())
            <div class="alert custom-error-alert mb-4">
                <ul class="mb-0 list-unstyled">
                    @foreach($errors->all() as $error)
                        <li><i class="bi bi-exclamation-circle me-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register_prieto') }}">
                @csrf

                <!-- Nombre -->
                <div class="form-floating mb-3">
                    <input type="text" name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        id="regName" placeholder="Tu nombre" value="{{ old('name') }}" required>
                    <label for="regName">Nombre completo</label>
                </div>

                <!-- Email -->
                <div class="form-floating mb-3">
                    <input type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="regEmail" placeholder="name@example.com" value="{{ old('email') }}" required>
                    <label for="regEmail">Correo electrónico</label>
                </div>

                <!-- Password -->
                <div class="form-floating mb-3">
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="regPassword" placeholder="Contraseña" required>
                    <label for="regPassword">Contraseña</label>
                </div>

                <!-- Confirm Password -->
                <div class="form-floating mb-4">
                    <input type="password" name="password_confirmation"
                        class="form-control"
                        id="regPasswordConfirm" placeholder="Confirmar contraseña" required>
                    <label for="regPasswordConfirm">Repetir contraseña</label>
                </div>

                <button class="btn btn-register-submit w-100 mb-3" type="submit">
                    Registrarse ahora <i class="bi bi-arrow-right-short ms-1"></i>
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-muted mb-0">¿Ya tienes una cuenta?</p>
                <a href="{{ route('login_prieto') }}" class="fw-bold text-decoration-none" style="color: #6366f1;">Inicia sesión aquí</a>
            </div>
        </div>

        <p class="text-center mt-4 text-muted small">
            © {{ date('Y') }} Prieto Eats — Sabores que conectan.
        </p>
    </div>
</div>
@endsection
