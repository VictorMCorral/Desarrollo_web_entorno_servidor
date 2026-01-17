@extends("layouts_prieto.home")

@section("content")
<div class="container">

    <h3 class="mb-4 text-center">Nuestros Productos</h3>

    <!-- Botones de navegación (Tabs) centrados -->
    <ul class="nav nav-tabs mb-4 justify-content-center" id="productosTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="platos-tab" data-bs-toggle="tab" data-bs-target="#platos" type="button" role="tab" aria-controls="platos" aria-selected="true">
                Platos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="menus-tab" data-bs-toggle="tab" data-bs-target="#menus" type="button" role="tab" aria-controls="menus" aria-selected="false">
                Menús
            </button>
        </li>
    </ul>


    <!-- Contenido de las tabs -->
    <div class="tab-content" id="productosTabContent">

        <!-- PLATOS -->
        <div class="tab-pane fade show active" id="platos" role="tabpanel" aria-labelledby="platos-tab">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 g-4">
                @foreach ($productos as $producto)
                @if($producto->product_type == "plato")
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset($producto->image) }}" class="card-img-top img-fluid" style="object-fit:contain;" alt="{{ $producto->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $producto->name }}</h5>
                            <p class="card-text text-muted flex-grow-1">Descripción corta y atractiva del producto.</p>
                            <div class="mt-3">
                                @auth
                                <form method="POST" action="{{ route('cartAdd', $producto->id ) }}" class="m-0">
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

        <!-- MENUS -->
        <div class="tab-pane fade" id="menus" role="tabpanel" aria-labelledby="menus-tab">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-3 g-4">
                @foreach ($productos as $producto)
                @if($producto->product_type == "menu")
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset($producto->image) }}" class="card-img-top img-fluid" style="object-fit:contain;" alt="{{ $producto->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $producto->name }}</h5>
                            <p class="card-text text-muted flex-grow-1">Descripción corta y atractiva del producto.</p>
                            <div class="mt-3">
                                @auth
                                <form method="POST" action="{{ route('cartAdd', $producto->id ) }}" class="m-0">
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
</div>
@endsection
