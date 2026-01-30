<!-- Importar iconos de Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
    }

    /* Navbar con efecto cristalizado mejorado */
    .navbar-custom {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        padding: 0.6rem 1.5rem;
    }

    /* Logo y Texto */
    .brand-text {
        font-weight: 800;
        letter-spacing: -1px;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 1.5rem;
    }

    .logo-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border: 2px solid #eef2ff;
        transition: transform 0.3s ease;
    }

    /* Estilos del Botón Burger */
    .navbar-toggler {
        border: none;
        padding: 0;
        color: #4338ca;
        font-size: 1.8rem;
    }

    .navbar-toggler:focus {
        box-shadow: none;
        outline: none;
    }

    /* Enlaces de navegación */
    .nav-link-custom {
        font-weight: 600;
        color: #64748b !important;
        position: relative;
        transition: color 0.3s;
        font-size: 0.95rem;
    }

    .nav-link-custom:hover {
        color: #4338ca !important;
    }

    /* Botones de acción */
    .btn-auth {
        border-radius: 10px;
        font-weight: 600;
        padding: 0.5rem 1.2rem;
        transition: all 0.3s;
        font-size: 0.9rem;
    }

    .btn-login {
        color: #4338ca;
        background: #eef2ff;
        border: none;
    }

    .btn-register {
        background: var(--primary-gradient);
        color: white !important;
        border: none;
    }

    /* Ajustes para móviles */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: white;
            margin-top: 1rem;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .auth-buttons-mobile {
            flex-direction: column;
            width: 100%;
            gap: 10px;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }

        .auth-buttons-mobile .btn,
        .auth-buttons-mobile .dropdown,
        .auth-buttons-mobile .btn-cart {
            width: 100%;
            text-align: center;
            justify-content: center;
        }
    }

    /* Dropdown Premium */
    .dropdown-menu {
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 15px;
        padding: 0.75rem;
    }
</style>

<header class="navbar navbar-expand-lg navbar-custom sticky-top shadow-sm">
    <div class="container-fluid">
        <!-- Logo -->
        <a href="{{ route('home_prieto') }}" class="navbar-brand d-flex align-items-center brand-link me-0">
            <img src="{{ asset('storage/img/logoN.png') }}" alt="Logo" class="logo-img rounded-circle me-2">
            <span class="brand-text">Prieto Eats</span>
        </a>

        <!-- Botón Burger (Solo visible en móviles) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>

        <!-- Contenido colapsable -->
        <div class="collapse navbar-collapse" id="navMain">
            <!-- Navegación central -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="#menu" class="nav-link nav-link-custom px-3">Menú</a>
                </li>
                <li class="nav-item">
                    <a href="#about" class="nav-link nav-link-custom px-3">Acerca de</a>
                </li>
            </ul>

            <!-- Botones de usuario / Auth -->
            <div class="d-flex align-items-center gap-2 auth-buttons-mobile">
                @guest
                    <a href="{{ route('login_prieto') }}" class="btn btn-auth btn-login">Entrar</a>
                    <a href="{{ route('register_prieto') }}" class="btn btn-auth btn-register">Unirse</a>
                @endguest

                @auth
                    <!-- Carrito -->
                    <a href="{{ route('cartShow') }}" class="btn btn-cart btn-sm d-flex align-items-center gap-2 shadow-sm py-2 px-3" style="border-radius: 10px; border: 1.5px solid #e2e8f0; color: #1e293b;">
                        <i class="bi bi-bag-heart-fill text-primary"></i>
                        <span class="fw-bold">Carrito</span>
                    </a>

                    <!-- Dropdown Usuario -->
                    <div class="dropdown">
                        <button class="btn btn-auth btn-register dropdown-toggle shadow-sm d-flex align-items-center gap-2 w-100 justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('ordersShow') }}">
                                    <i class="bi bi-clock-history"></i> Mis Pedidos
                                </a>
                            </li>

                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider opacity-50"></li>
                                <div class="admin-section-header px-3 pb-1" style="font-size: 0.7rem; text-transform: uppercase; color: #94a3b8; font-weight: 800;">Admin</div>
                                <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('admin.offers.index') }}"><i class="bi bi-tag"></i> Ofertas</a></li>
                                <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('admin.products.index') }}"><i class="bi bi-box-seam"></i> Productos</a></li>
                            @endif

                            <li><hr class="dropdown-divider opacity-50"></li>
                            <li>
                                <form method="POST" action="{{ route('logout_prieto') }}" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
                                        <i class="bi bi-box-arrow-right"></i> Salir
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
