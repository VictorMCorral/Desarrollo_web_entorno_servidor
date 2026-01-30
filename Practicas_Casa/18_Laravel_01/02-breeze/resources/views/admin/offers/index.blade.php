@extends("layouts_prieto.home")

@section("content")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
    }

    body {
        background-color: #f8fafc;
    }

    /* Botón de Creación Principal */
    .btn-create-master {
        background: var(--primary-gradient);
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.8rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(99, 102, 241, 0.2);
    }

    .btn-create-master:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
        color: white;
    }

    /* Tarjeta de Oferta */
    .offer-card {
        background: var(--glass-bg);
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
    }

    .offer-card:hover {
        box-shadow: 0 20px 30px -5px rgba(0, 0, 0, 0.08);
        transform: translateY(-3px);
    }

    .offer-header {
        background: #fff;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .date-badge {
        background: #eef2ff;
        color: #4338ca;
        font-weight: 800;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Estilos de Tabla de Productos en Oferta */
    .table thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        color: #64748b;
        border: none;
        padding: 1rem 1.5rem;
    }

    .table tbody td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
    }

    .product-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    /* Botón de Eliminar Oferta */
    .btn-delete-offer {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s ease;
        border: 1.5px solid #fee2e2;
        background: #fee2e2;
        color: #ef4444;
    }

    .btn-delete-offer:hover {
        background: #ef4444;
        color: white;
        border-color: #ef4444;
    }
</style>

<div class="container py-5">

    <!-- Encabezado de la Página -->
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -1px;">Gestión de Ofertas</h2>
            <p class="text-muted m-0">Planifica los menús diarios y ofertas para tus clientes.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.offers.create') }}" class="btn-create-master d-inline-flex align-items-center">
                <i class="bi bi-calendar-plus me-2 fs-5"></i> Crear Nueva Oferta
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            @forelse ($offers as $offer)
            <!-- Tarjeta de Oferta Individual -->
            <div class="offer-card">
                <!-- Cabecera de la Oferta -->
                <div class="offer-header">
                    <div class="date-badge">
                        <i class="bi bi-calendar3"></i>
                        {{ $offer->date_delivery->format('d / m / Y') }}
                    </div>

                    <!-- Acción de Eliminar -->
                    <form method="POST" action="{{ route('admin.offers.destroy', $offer->id) }}" class="m-0" onsubmit="return confirm('¿Seguro que deseas eliminar la oferta del {{ $offer->date_delivery->format('d/m/Y') }}?')">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn-delete-offer" title="Eliminar oferta">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                </div>

                <!-- Lista de Productos de la Oferta -->
                <div class="table-responsive bg-white">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th style="width: 80px;"></th>
                                <th>Producto Incluido</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($offer->productsOffer as $productOffer)
                            <tr>
                                <td>
                                    @if($productOffer->product->image)
                                        <img src="{{ asset('storage/' . $productOffer->product->image) }}" class="product-img">
                                    @else
                                        <div class="product-img bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cup-hot text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $productOffer->product->name }}</span>
                                </td>
                                <td>
                                    <small class="text-muted d-block" style="max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $productOffer->product->description ?? 'Sin descripción disponible.' }}
                                    </small>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Esta oferta no tiene productos asignados.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @empty
            <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                <h4 class="fw-bold mt-3">No hay ofertas programadas</h4>
                <p class="text-muted">Crea tu primera oferta para empezar a vender.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
