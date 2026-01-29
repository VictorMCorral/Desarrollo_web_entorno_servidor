@extends("layouts_prieto.home")

@section("content")
<div class="container-fluid py-5 px-4">
    <div class="row">
        <div class="col-md-8">
            <h3 class="mb-4 text-center">Productos registrados</h3>
            <div class="table-responsive shadow-sm bg-white p-3 rounded">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Precio (€)</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr>
                            <td style="width:100px;">
                                @if($producto->image)
                                <img src="{{ asset('storage/' . $producto->image) }}" class="img-fluid" style="max-height:60px; object-fit:contain;">
                                @else
                                <small class="text-muted">Sin imagen</small>
                                @endif
                            </td>

                            <td class="fw-bold text-start">
                                {{ $producto->name }}
                            </td>

                            <td>
                                {{ number_format($producto->price, 2) }} €
                            </td>
                            <td style="width: 80px;">
                                <a class="btn btn-outline-warning btn-sm w-100" href="{{ route('admin.products.edit', $producto->id) }}">Editar</a>
                            </td>
                            <td style="width: 80px;">
                                <form method="POST" action="{{ route('admin.products.destroy', $producto->id) }}" class="m-0" onsubmit="return confirm('¿Estás seguro?')">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
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
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4 text-center">Crear producto</h3>
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del producto</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Precio (€)</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="precio" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Breve descripción" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Crear producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection