@extends("layouts_prieto.home")

@section("content")
<div class="container pb-5 mb-2">

    <h3 class="mb-4 text-center">Productos registrados</h3>

    <!-- PLATOS -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 g-4">
        @foreach ($productos as $producto)
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('storage/' . $producto->image) }}" class="card-img-top img-fluid" style="object-fit:cover;" alt="{{ $producto->name }}">
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
    @endforeach
</div>

@endsection
