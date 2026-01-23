@extends("layouts_prieto.home")

@section("content")
<div class="container pb-5 mb-2">

    <h3 class="mb-4 text-center">Productos registrados</h3>


    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio (€)</th>
                    <th>Disponible</th>
                    <th>Tipo de producto</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $id => $producto)
                <tr>
                    <td style="width:120px;">
                        <img src="{{ asset($producto->image) }}" class="img-fluid" style="max-height:80px; object-fit:contain;">
                    </td>

                    <td class="fw-bold">
                        {{ $producto->name }}
                    </td>

                    <td>
                        {{ $producto->price }} €
                    </td>

                    <td>
                        @if($producto->available)
                            Si
                        @else
                            No
                        @endif
                    </td>

                    <td>
                        {{ $producto->product_type }}
                    </td>

                    <td>
                        <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.products.edit', $producto->id) }}">Editar</a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.products.destroy', $producto->id) }}" class="m-0">
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
</div>

@endsection