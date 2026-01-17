@extends("layouts_prieto.home")

@section("content")
<div class="container py-5">
    <h5 class="mb-4">Carrito de la compra</h5>

    @if($productos != [])
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio (€)</th>
                    <th>Acciones</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $id => $producto)
                <tr>
                    <td style="width:120px;">
                        <img src="{{ asset('storage/img/pollo.png') }}" class="img-fluid" style="max-height:80px; object-fit:contain;">
                    </td>

                    <td class="fw-bold">
                        {{ $producto["nombre"] }}
                    </td>

                    <td>
                        {{ $producto["precio"] }} €
                    </td>

                    <td>
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <form method="POST"
                                action="{{ route('cartRemoveOne', $id) }}" class="m-0">
                                @csrf
                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    @if($producto["cantidad"] <=1) disabled @endif>
                                    -
                                </button>
                            </form>

                            <input type="number" class="form-control text-center" style="width:70px;" value="{{ $producto['cantidad'] }}" readonly>

                            <form method="POST" action="{{ route('cartAddOne', $id) }}" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    +
                                </button>
                            </form>

                        </div>
                    </td>

                    <td>
                        <form method="POST" action="{{ route('cartRemove', $id) }}" class="m-0">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <form method="POST" action="{{ route('cartOrder') }}" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-success w-100">
            Reservar
        </button>
    </form>

    <form method="POST" action="{{ route('cartClear') }}" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger w-100">
            Vaciar el Carrito
        </button>
    </form>

    @else
    <div class="alert alert-info">
        El carrito está vacío.
    </div>
    @endif
</div>
@endsection