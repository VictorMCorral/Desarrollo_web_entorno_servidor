@extends("layouts_prieto.home")

@section("content")
<!-- Asegúrate de tener este link en tu layout principal o añádelo aquí para los iconos -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
    }

    body {
        background-color: #f8fafc;
    }

    .card {
        border: none;
        border-radius: 16px;
    }

    .table-container {
        background: var(--glass-bg);
        border-radius: 16px;
        overflow: hidden;
    }

    .table thead th {
        background-color: #f1f5f9;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        color: #64748b;
        border: none;
        padding: 1.25rem;
    }

    .table tbody td {
        padding: 1.25rem;
        vertical-align: middle;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
    }

    .product-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }

    .price-badge {
        background: #e0e7ff;
        color: #4338ca;
        font-weight: 700;
        padding: 0.5rem 0.8rem;
        border-radius: 10px;
        display: inline-block;
    }

    .btn-create {
        background: var(--primary-gradient);
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.8rem;
        border-radius: 12px;
        transition: 0.3s;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
        color: white;
    }

    .form-control, .form-control:focus {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border-color: #e2e8f0;
        background-color: #f8fafc;
    }

    /* ESTILO DE LOS BOTONES DE ACCIÓN */
    .action-btn {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s ease;
        border: 1.5px solid;
    }

    .btn-edit {
        color: #f59e0b; /* Amarillo/Naranja para seriedad/atención */
        border-color: #fef3c7;
        background: #fef3c7;
    }

    .btn-edit:hover {
        background: #f59e0b;
        color: white;
        border-color: #f59e0b;
    }

    .btn-delete {
        color: #ef4444; /* Rojo para pasión/peligro */
        border-color: #fee2e2;
        background: #fee2e2;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        border-color: #ef4444;
    }
</style>

<div class="container py-5">
    <!-- Encabezado -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="fw-bold text-dark" style="letter-spacing: -1px;">Panel de Gestión</h2>
            <p class="text-muted">Control total sobre tu inventario de productos.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Tabla de Productos -->
        <div class="col-lg-8">
            <div class="table-container shadow-sm border">
                <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0 fw-bold text-secondary">Productos Registrados</h5>
                    <span class="badge rounded-pill px-3 py-2" style="background: #eef2ff; color: #4338ca;">
                        {{ $productos->count() }} Unidades
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Vista</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                            <tr>
                                <td>
                                    @if($producto->image)
                                        <img src="{{ asset('storage/' . $producto->image) }}" class="product-img">
                                    @else
                                        <div class="product-img bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-card-image text-muted fs-4"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $producto->name }}</div>
                                    <small class="text-muted">{{ Str::limit($producto->description, 35) }}</small>
                                </td>
                                <td>
                                    <span class="price-badge">{{ number_format($producto->price, 2) }}€</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <!-- Botón Editar con Lápiz -->
                                        <a href="{{ route('admin.products.edit', $producto->id) }}"
                                           class="action-btn btn-edit"
                                           title="Editar producto">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <!-- Botón Eliminar con Papelera -->
                                        <form method="POST" action="{{ route('admin.products.destroy', $producto->id) }}"
                                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="action-btn btn-delete" title="Eliminar producto">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Formulario de Creación -->
        <div class="col-lg-4">
            <div class="card shadow-sm border">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                            <i class="bi bi-box-seam-fill text-primary fs-3"></i>
                        </div>
                        <h5 class="fw-bold">Nuevo Producto</h5>
                    </div>

                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nombre del Producto</label>
                            <input type="text" class="form-control" name="name" placeholder="Ej: Monitor UltraWide" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Precio de Venta</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted">€</span>
                                <input type="number" step="0.01" class="form-control border-start-0" name="price" placeholder="0.00" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Descripción Corta</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Detalles clave..." required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Imagen Representativa</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-create w-100 shadow-sm">
                            <i class="bi bi-plus-circle me-2"></i> Crear Producto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
