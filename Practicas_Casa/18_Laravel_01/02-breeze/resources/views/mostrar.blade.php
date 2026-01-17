@extends("layouts_prieto.home")

@section("content")
<div class="album py-5 bg-light" id="platos">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-4">
            <div class="row row-cols-1 row-cols-xl-2 g-4">
                @foreach ($productos as $producto)
                @if($producto->product_type == "plato")
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/img/pollo.png') }}" class="card-img-top img-fluid" style="object-fit:contain;" alt="Producto 2">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $producto->name }}</h5>
                            <p class="card-text text-muted flex-grow-1">Descripción corta y atractiva del producto.</p>
                            <div class="mt-3">
                                @auth
                                <form method="POST" action="{{ route('cartAdd', $producto->id ) }}" class=" m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100">
                                        Agregar al carrito
                                    </button>
                                </form>
                                @endauth
                                @guest
                                <small class="text-danger d-block text-center">Es necesario estar registrado para comprarlo</small>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="album py-5 bg-light" id="menus">
        <div class="container">
            <div class="row row-cols-1 row-cols-xl-2 g-4">
                @foreach ($productos as $producto)
                @if($producto->product_type == "menu")
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/img/menu25Nov2025.png') }}" class="card-img-top img-fluid" style="object-fit:contain;" alt="Producto 2">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $producto->name }}</h5>
                            <p class="card-text text-muted flex-grow-1">Descripción corta y atractiva del producto.</p>
                            <div class="mt-3">
                                @auth
                                <form method="POST" action="{{ route('cartAdd', $producto->id ) }}" class=" m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100">
                                        Agregar al carrito
                                    </button>
                                </form>
                                @endauth
                                @guest
                                <small class="text-danger d-block text-center">Es necesario estar registrado para comprarlo</small>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    @endsection