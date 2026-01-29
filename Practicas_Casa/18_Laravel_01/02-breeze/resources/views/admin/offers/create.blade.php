@extends("layouts_prieto.home")

@section("content")
<div class="container-fluid py-5 bg-light" style="min-height: 100vh;">
    <div class="container">
        <!-- El formulario envuelve toda la fila para capturar los inputs y los checkboxes -->
        <form method="POST" action="{{ route('admin.offers.store') }}">
            @csrf

            <div class="row g-4">
                <!-- COLUMNA IZQUIERDA: CONFIGURACIÓN DE OFERTA (Sticky) -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 20px; z-index: 1000;">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="card-title mb-0 text-center text-uppercase fw-bold">
                                <i class="bi bi- megaphone me-2"></i>Nueva Oferta
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label for="date_delivery" class="form-label fw-bold">Fecha de entrega</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-calendar-check"></i></span>
                                    <input type="date" class="form-control border-start-0" id="date_delivery" name="date_delivery" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="time_delivery" class="form-label fw-bold">Hora de entrega</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-clock"></i></span>
                                    <input type="time" class="form-control border-start-0" id="time_delivery" name="time_delivery" required>
                                </div>
                            </div>

                            <div class="alert alert-info border-0 shadow-sm small">
                                <i class="bi bi-info-circle me-1"></i> Selecciona los productos de la derecha que deseas incluir en esta oferta.
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="bi bi-check2-circle me-2"></i>Publicar Oferta
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COLUMNA DERECHA: SELECCIÓN DE PRODUCTOS -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-bold text-dark">
                                <i class="bi bi-list-check me-2 text-primary"></i>Seleccionar Productos
                            </h5>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 80px;">Incluir</th>
                                        <th style="width: 100px;">Imagen</th>
                                        <th>Producto</th>
                                        <th class="text-end pe-4">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input product-checkbox" type="checkbox" name="dish_selected[]" value="{{ $producto->id }}" style="width: 1.3em; height: 1.3em; cursor: pointer;">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rounded-3 border bg-white" style="width: 60px; height: 60px; overflow: hidden;">
                                                @if($producto->image)
                                                <img src="{{ asset('storage/' . $producto->image) }}" class="img-fluid h-100 w-100" style="object-fit: contain;">
                                                @else
                                                <div class="d-flex align-items-center justify-content-center h-100 bg-light text-muted">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-bold d-block text-dark">{{ $producto->name }}</span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <span class="badge rounded-pill bg-success-soft text-success border border-success px-3 py-2 fw-bold">
                                                {{ number_format($producto->price, 2) }} €
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($productos->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-box-seam text-muted display-4"></i>
                            <p class="mt-2 text-muted">No hay productos registrados para añadir.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div> <!-- End Row -->
        </form>
    </div>
</div>


<!-- Estilos adicionales para mejorar el look -->
<style>
    .bg-success-soft {
        background-color: rgba(25, 135, 84, 0.1);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
        transition: 0.3s;
    }

    .card {
        border-radius: 12px;
    }

    .btn-group .btn {
        padding: 0.4rem 0.8rem;
    }
</style>

<!-- Asegúrate de tener Bootstrap Icons en tu layout o añádelos: -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css"> -->
@endsection