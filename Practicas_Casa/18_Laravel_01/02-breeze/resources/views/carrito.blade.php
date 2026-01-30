@extends("layouts_prieto.home")

@section("content")
<!-- Fuentes e Iconos -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
        --bg-soft: #f8fafc;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--bg-soft);
    }

    /* Títulos */
    .cart-title {
        font-weight: 800;
        letter-spacing: -1.5px;
        color: #1e293b;
    }

    /* Cards de Entrega */
    .delivery-group-card {
        background: white;
        border: none;
        border-radius: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .delivery-header {
        background: #f1f5f9;
        padding: 1.2rem 2rem;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid #e2e8f0;
    }

    .delivery-header i {
        color: #6366f1;
        font-size: 1.2rem;
    }

    /* Items del Carrito */
    .product-img-cart {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 16px;
        background: #f8fafc;
    }

    .table thead th {
        background: transparent;
        border: none;
        color: #94a3b8;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 1.5rem 1rem 0.5rem;
    }

    .table tbody td {
        padding: 1.5rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    /* Selector de Cantidad Estilo Pill */
    .qty-pill {
        background: #f1f5f9;
        border-radius: 50px;
        padding: 5px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: white;
        color: #1e293b;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .qty-btn:hover:not(:disabled) {
        background: var(--primary-gradient);
        color: white;
    }

    .qty-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Resumen del Pedido */
    .summary-card {
        background: white;
        border: none;
        border-radius: 28px;
        padding: 2rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
        position: sticky;
        top: 100px;
    }

    .btn-confirm {
        background: var(--primary-gradient);
        border: none;
        border-radius: 16px;
        padding: 16px;
        font-weight: 700;
        color: white;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
    }

    .btn-confirm:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
        color: white;
    }

    /* Estado Vacío */
    .empty-cart-icon {
        width: 120px;
        height: 120px;
        background: #eef2ff;
        color: #6366f1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 40px;
        margin: 0 auto 2rem;
        font-size: 3.5rem;
    }
</style>

<div class="container py-5">
    <div class="row align-items-end mb-5">
        <div class="col-md-8">
            <span class="badge rounded-pill px-3 py-2 mb-2" style="background: #eef2ff; color: #4338ca; font-weight: 700;">REVISIÓN FINAL</span>
            <h1 class="cart-title m-0">Tu Carrito de Reserva</h1>
        </div>
    </div>

    @if(count($carrito) > 0)
    @php $totalGeneral = 0; @endphp

    <div class="row g-5">
        <!-- Listado de Productos -->
        <div class="col-lg-8">
            @foreach ($carrito as $offerId => $items)
            @php $offer = $offersById[$offerId] ?? null; @endphp

            <div class="delivery-group-card">
                <div class="delivery-header">
                    <i class="bi bi-truck-flatbed"></i>
                    <div>
                        <span class="small text-muted d-block text-uppercase fw-bold" style="letter-spacing: 1px;">Programado para:</span>
                        <span class="fw-bold text-dark">{{ $offer->date_delivery->format('d/m/Y') }} <span class="mx-2 text-muted">|</span> {{ $offer->tiem_delivery }}</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end pe-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $productOfferId => $quantity)
                            @php
                                $productOffer = $productsOffersById[$productOfferId] ?? null;
                                $producto = $productOffer->product;
                                $lineTotal = $producto->price * (int) $quantity;
                                $totalGeneral += $lineTotal;
                            @endphp
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $producto->image) }}" class="product-img-cart me-3 shadow-sm border">
                                        <div>
                                            <h6 class="mb-1 fw-bold text-dark">{{ $producto->name }}</h6>
                                            <span class="text-muted small fw-semibold">{{ number_format($producto->price, 2) }} € / ud.</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="qty-pill shadow-sm">
                                            <form method="POST" action="{{ route('cartRemoveOne', $producto->id) }}" class="m-0">
                                                @csrf
                                                <button type="submit" class="qty-btn" @if($quantity <= 1) disabled @endif>
                                                    <i class="bi bi-dash-lg"></i>
                                                </button>
                                            </form>

                                            <span class="fw-bold px-2 text-dark" style="min-width: 25px; text-align: center;">{{ $quantity }}</span>

                                            <form method="POST" action="{{ route('cartAddOne', $producto->id) }}" class="m-0">
                                                @csrf
                                                <button type="submit" class="qty-btn">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <form method="POST" action="{{ route('cartRemove', $producto->id) }}" class="ms-3">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-outline-danger border-0 rounded-circle p-2" title="Eliminar del carrito">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <span class="fw-bold text-dark fs-5">{{ number_format($lineTotal, 2) }} €</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Sidebar de Resumen -->
        <div class="col-lg-4">
            <div class="summary-card">
                <h4 class="fw-bold mb-4">Resumen</h4>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted fw-semibold">Subtotal</span>
                    <span class="fw-bold text-dark">{{ number_format($totalGeneral, 2) }} €</span>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted fw-semibold">Servicio de entrega</span>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Gratis</span>
                </div>

                <hr class="my-4 opacity-50">

                <div class="d-flex justify-content-between align-items-end mb-4">
                    <span class="h5 fw-bold m-0">Total a pagar</span>
                    <div class="text-end">
                        <span class="h3 fw-bold m-0 text-primary" style="display: block;">{{ number_format($totalGeneral, 2) }} €</span>
                        <small class="text-muted">IVA incluido</small>
                    </div>
                </div>

                <form method="POST" action="{{ route('cartOrder') }}">
                    @csrf
                    <button type="submit" class="btn btn-confirm w-100 mb-3">
                        CONFIRMAR RESERVA <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>

                <form method="POST" action="{{ route('cartClear') }}" onsubmit="return confirm('¿Vaciar todo el carrito?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link w-100 text-decoration-none text-muted small fw-bold">
                        <i class="bi bi-x-circle me-1"></i> VACIAR CARRITO
                    </button>
                </form>

                <div class="mt-4 p-3 bg-light rounded-4">
                    <div class="d-flex gap-3 align-items-start">
                        <i class="bi bi-shield-check text-primary fs-4"></i>
                        <p class="small text-muted mb-0">Reserva segura y garantizada. Podrás ver el estado de tu pedido en tu panel personal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
    <!-- Estado Vacío Innovador -->
    <div class="row justify-content-center py-5">
        <div class="col-lg-6 text-center">
            <div class="empty-cart-icon shadow-sm">
                <i class="bi bi-bag-x"></i>
            </div>
            <h2 class="fw-bold text-dark">Tu carrito está esperando</h2>
            <p class="text-muted mb-4 px-lg-5">Parece que aún no has seleccionado ninguna de nuestras ofertas especiales para tus próximas entregas.</p>
            <a href="/" class="btn btn-confirm px-5">
                Explorar Menú de Hoy
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
