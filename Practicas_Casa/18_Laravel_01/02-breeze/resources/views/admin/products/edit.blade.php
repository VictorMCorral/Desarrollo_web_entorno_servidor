@extends("layouts_prieto.home")

@section("content")
<div class="container pb-5 mb-2">
    <h3 class="mb-4 text-center">Editar producto</h3>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('admin.products.update', $producto->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del producto</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $producto->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Precio (€)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $producto->price) }}" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Imagen</label>
                    <input type="file" class="form-control" id="image" name="image" multipart>
                    @if($producto->image)
                        <small class="text-muted">Imagen actual:</small><br>
                        <img src="{{ asset('storage/' . $producto->image) }}" alt="Imagen del producto" class="img-fluid mt-2" style="max-height:100px; object-fit:contain;">
                    @endif
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Actualizar producto</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
