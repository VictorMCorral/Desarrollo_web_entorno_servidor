@extends("layouts_prieto.home")

@section("content")
<!-- Fuentes e Iconos -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --bg-dark: #0f172a;
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
        --passion-gradient: linear-gradient(135deg, #f43f5e 0%, #be123c 100%);
        --accent-fresh: #06b6d4;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    /* Luces de fondo (Ambient Glow) */
    .ambient-glow {
        position: fixed;
        width: 40vw;
        height: 40vw;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.05) 0%, rgba(248, 250, 252, 0) 70%);
        top: -10vw;
        right: -10vw;
        z-index: -1;
    }

    /* Panel de Configuración (Izquierda) */
    .config-suite {
        background: var(--bg-dark);
        color: white;
        border-radius: 30px;
        padding: 35px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .form-dark-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94a3b8;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .form-dark-input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 14px;
        color: white;
        padding: 12px 15px;
        transition: 0.3s;
    }

    .form-dark-input:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
        color: white;
    }

    /* Card de Productos (Derecha) */
    .selection-card {
        background: white;
        border: none;
        border-radius: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        overflow: hidden;
    }

    .table thead th {
        background: #f8fafc;
        border: none;
        color: #64748b;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 1.5rem;
    }

    .table tbody td {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    /* Checkbox Estilizado */
    .form-check-input {
        width: 1.5em;
        height: 1.5em;
        border-radius: 6px;
        cursor: pointer;
        border: 2px solid #e2e8f0;
    }

    .form-check-input:checked {
        background-color: #6366f1;
        border-color: #6366f1;
    }

    /* Badge de Precio Fresco */
    .price-badge-fresh {
        background: #ecfeff;
        color: #0891b2;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 0.9rem;
    }

    .product-thumb {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 12px;
        background: #f1f5f9;
    }

    /* Botón de Publicación (Pasión) */
    .btn-publish {
        background: var(--passion-gradient);
        color: white;
        border: none;
        border-radius: 16px;
        padding: 16px;
        font-weight: 700;
        letter-spacing: 1px;
        transition: all 0.4s;
        box-shadow: 0 10px 20px rgba(244, 63, 94, 0.3);
    }

    .btn-publish:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(244, 63, 94, 0.4);
        color: white;
    }

    .sticky-panel {
        position: sticky;
        top: 100px;
    }
</style>

<div class="ambient-glow"></div>

<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12">
            <span class="badge rounded-pill px-3 py-2 mb-2" style="background: #eef2ff; color: #4338ca; font-weight: 700;">ADMIN PANEL</span>
            <h1 class="fw-800 text-dark" style="letter-spacing: -1.5px;">Configurador de Ofertas</h1>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.offers.store') }}">
        @csrf
        <div class="row g-5">
            <!-- COLUMNA IZQUIERDA: CONFIGURACIÓN -->
            <div class="col-lg-4">
                <div class="sticky-panel">
                    <div class="config-suite">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-primary bg-opacity-20 p-3 rounded-4">
                                <i class="bi bi-megaphone-fill text-primary fs-4"></i>
                            </div>
                            <h4 class="fw-bold m-0">Parámetros</h4>
                        </div>

                        <div class="mb-4">
                            <label class="form-dark-label">Fecha de Entrega</label>
                            <div class="input-group">
                                <input type="date" class="form-control form-dark-input" name="date_delivery" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-dark-label">Ventana Horaria</label>
                            <div class="input-group">
                                <input type="time" class="form-control form-dark-input" name="time_delivery" required>
                            </div>
                        </div>

                        <div class="p-4 rounded-4 mb-4" style="background: rgba(6, 182, 212, 0.1); border: 1px solid rgba(6, 182, 212, 0.2);">
                            <div class="d-flex gap-2">
                                <i class="bi bi-info-circle-fill text-info"></i>
                                <p class="small text-info mb-0 fw-semibold">Selecciona al menos un producto del inventario para habilitar la oferta.</p>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-publish w-100">
                            <i class="bi bi-rocket-takeoff me-2"></i> PUBLICAR OFERTA
                        </button>
                    </div>
                </div>
            </div>

            <!-- COLUMNA DERECHA: SELECCIÓN -->
            <div class="col-lg-8">
                <div class="selection-card">
                    <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
                        <h5 class="fw-bold m-0 text-dark">Inventario Disponible</h5>
                        <span class="badge bg-light text-muted border px-3 py-2">{{ $productos->count() }} Items</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Incluir</th>
                                    <th>Producto</th>
                                    <th class="text-end pe-4">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                <tr>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" name="dish_selected[]" value="{{ $producto->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($producto->image)
                                                <img src="{{ asset('storage/' . $producto->image) }}" class="product-thumb me-3 shadow-sm border">
                                            @else
                                                <div class="product-thumb me-3 d-flex align-items-center justify-content-center text-muted border">
                                                    <i class="bi bi-box-seam"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <span class="fw-bold text-dark d-block">{{ $producto->name }}</span>
                                                <span class="text-muted small">ID: #{{ $producto->id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <span class="price-badge-fresh">
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
                        <i class="bi bi-archive text-muted display-4 opacity-20"></i>
                        <h5 class="mt-3 text-muted">No hay productos disponibles</h5>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-link text-primary text-decoration-none fw-bold">Ir a Inventario</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
