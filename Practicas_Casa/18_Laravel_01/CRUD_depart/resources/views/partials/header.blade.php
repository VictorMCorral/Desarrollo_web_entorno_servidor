<header class="w-100 mb-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">

            <a class="navbar-brand fw-bold text-primary" href="/">
                Emple Depart con Breeze
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarButtons"
                aria-controls="navbarButtons"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            @if (Route::has('login'))
            <div class="collapse navbar-collapse justify-content-end" id="navbarButtons">

                <ul class="navbar-nav align-items-center gap-2">

                    {{-- DEPARTAMENTOS --}}
                    <li class="nav-item">
                        <a href="{{ route('departs.index') }}"
                            class="btn btn-outline-primary btn-sm">
                            Departamentos
                        </a>
                    </li>

                    @if(request()->routeIs('departs.*'))
                    <li class="nav-item">
                        <a href="{{ route('departs.create') }}"
                            class="btn btn-primary btn-sm">
                            + Nuevo departamento
                        </a>
                    </li>
                    @endif

                    @auth
                    {{-- EMPLEADOS --}}
                    <li class="nav-item">
                        <a href="{{ route('emple.index') }}"
                            class="btn btn-outline-success btn-sm">
                            Empleados
                        </a>
                    </li>

                    @if(request()->routeIs('emple.*'))
                    <li class="nav-item">
                        <a href="{{ route('emple.create') }}"
                            class="btn btn-success btn-sm">
                            + Nuevo empleado
                        </a>
                    </li>
                    @endif

                    {{-- USUARIO --}}
                    <li class="nav-item dropdown">
                        <a class="btn btn-outline-dark btn-sm dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    @else
                    {{-- LOGIN / REGISTER --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}"
                            class="btn btn-outline-secondary btn-sm">
                            Login
                        </a>
                    </li>

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}"
                            class="btn btn-secondary btn-sm">
                            Register
                        </a>
                    </li>
                    @endif
                    @endauth

                </ul>
            </div>
            @endif

        </div>
    </nav>
</header>