<header class="d-flex flex-wrap align-items-center justify-content-between py-3 px-4 mb-4 border-bottom shadow-sm bg-light">
    <div class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
        <a href="{{ route('home_prieto') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('storage/img/logoN.png') }}" alt="Prieto Eats" class="img-fluid w-25 me-3 rounded-circle border">
            <h2 class="m-0 fw-bold text-primary">Prieto Eats</h2>
        </a>
    </div>

    <nav class="col-12 col-md-auto mb-2 mb-md-0">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a href="#menu" class="nav-link px-3 link-dark fw-semibold">Menú</a>
            </li>
            <li class="nav-item">
                <a href="#about" class="nav-link px-3 link-dark fw-semibold">Acerca de</a>
            </li>
        </ul>
    </nav>

    <div class="col-md-4 text-end d-flex align-items-center justify-content-end gap-2">

        @guest
        <a href="{{ route('login_prieto') }}" class="btn btn-outline-primary btn-sm shadow-sm">Login</a>
        <a href="{{ route('register_prieto') }}" class="btn btn-outline-success btn-sm shadow-sm">Registrarse</a>
        @endguest

        @auth
        <a href="{{ route('cartShow') }}" class="btn btn-primary btn-sm shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
            </svg> Carrito</a>


        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm shadow-sm" data-bs-toggle="dropdown">
                {{ auth()->user()->name }}
            </button>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Mostrar pedidos</a></li>
                <li><a class="dropdown-item" href="#">Guardar como borrador</a></li>
                <li>
                    <form method="POST" action="{{ route('logout_prieto') }}" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            Log Out ({{ auth()->user()->name }})
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        @endauth
    </div>
</header>