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

    .page-title {
        font-weight: 800;
        letter-spacing: -1.5px;
        color: #1e293b;
    }

    /* Card del Pedido */
    .order-card {
        background: white;
        border: none;
        border-radius: 28px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        margin-bottom: 2.5rem;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.02);
    }

    /* Cabecera del Pedido */
    .order-header {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .order-id-badge {
        background: var(--primary-gradient);
        color: white;
        padding: 6px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.9rem;
        box-shadow: 0 4px 10px rgba(99, 102, 241, 0.2);
    }

    .order-date {
        color: #64748b;
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Tabla de Productos */
    .table-orders thead th {
        background: transparent;
        border: none;
        color: #94a3b8;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 1.5rem 1rem 0.5rem;
    }

    .table-orders tbody td {
        padding: 1.2rem 1rem;
        border-bottom: 1px solid #f8fafc;
        vertical-align: middle;
        color: #1e293b;
        font-weight: 500;
    }

    .product-name-cell {
        font-weight: 700 !important;
        color: #1e293b;
    }

    .qty-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 4px 10px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    /* Footer del Pedido / Total */
    .order-footer {
        padding: 1.5rem 2rem;
        background: white;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .total-label {
        color: #94a3b8;
        font-weight: 600;
        margin-right: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.8rem;
    }

    .total-amount {
        font-size: 1.5rem;
        font-weight: 800;
        color: #4338ca;
    }

    /* Badge de Estado */
    .status-badge {
        background: #ecfeff;
        color: #0891b2;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }
</style>

<div class="container py-5">
    <!-- Encabezado de la página -->
    <div class="row mb-5 text-center">
        <div class="col-12">
            <span class="badge rounded-pill px-3 py-2 mb-2" style="background: #eef2ff; color: #4338ca; font-weight: 700;">ÁREA DE CLIENTE</span>
            <h1 class="page-title">Historial de Pedidos</h1>
            <p class="text-muted">Revisa tus compras anteriores y el detalle de tus platos.</p>
        </div>
    </div>

    @foreach($orders as $order)
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="order-card shadow-sm">
                <!-- Cabecera: ID y Fecha -->
                <div class="order-header">
                    <div class="d-flex align-items-center gap-3">
                        <span class="order-id-badge">PEDIDO #{{ $order->id }}</span>
                        <span class="status-badge"><i class="bi bi-check-circle-fill me-1"></i> Procesado</span>
                    </div>
                    <div class="order-date">
                        <i class="bi bi-calendar3"></i>
                        {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                        <span class="mx-1 text-light">|</span>
                        <i class="bi bi-clock"></i>
                        {{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }}
                    </div>
                </div>

                <!-- Cuerpo: Tabla de productos -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-orders mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-5">Producto</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Precio Unit.</th>
                                    <th class="text-end pe-5">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @foreach($order->products as $item)
                                <tr>
                                    <td class="ps-5 product-name-cell">
                                        {{ $item->product->name }}
                                    </td>
                                    <td class="text-center">
                                        <span class="qty-badge">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="text-center text-muted">
                                        {{ number_format($item->product->price, 2) }} €
                                    </td>
                                    <td class="text-end pe-5 fw-bold">
                                        {{ number_format($item->quantity * $item->product->price, 2) }} €
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer: Total -->
                <div class="order-footer border-top">
                    <div class="d-flex align-items-center">
                        <span class="total-label">Total pagado</span>
                        <span class="total-amount">{{ number_format($order->total, 2) }} €</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @if($orders->isEmpty())
    <div class="text-center py-5">
        <div class="bg-white d-inline-block p-4 rounded-circle shadow-sm mb-4">
            <i class="bi bi-receipt text-muted opacity-20" style="font-size: 3rem;"></i>
        </div>
        <h3 class="fw-bold">No hay pedidos aún</h3>
        <p class="text-muted">Cuando realices tu primera compra, aparecerá aquí.</p>
        <a href="/" class="btn btn-primary px-4 py-2 mt-2 rounded-pill fw-bold">Ir a la carta</a>
    </div>
    @endif
</div>
@endsection
