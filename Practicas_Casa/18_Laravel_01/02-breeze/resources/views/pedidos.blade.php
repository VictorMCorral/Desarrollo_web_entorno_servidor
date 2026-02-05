@extends("layouts_prieto.home")

@section("content")
<div class="container section-spacing">
    <!-- Encabezado de la página -->
    <div class="page-hero text-center mb-5">
        <span class="badge badge-soft-primary mb-2">
            <i class="bi bi-person-check-fill me-1"></i>
            Área de cliente
        </span>
        <h1 class="page-title mt-4">Historial de pedidos</h1>
        <p class="text-muted">Revisa tus compras anteriores y el detalle de tus platos.</p>
    </div>

    @foreach($orders as $order)
    <div class="row justify-content-center mb-4">
        <div class="col-lg-10">
            <div class="order-card">
                <!-- Cabecera: ID y Fecha -->
                <div class="order-header">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span class="order-id-badge">PEDIDO #{{ $order->id }}</span>
                        <span class="status-badge"><i class="bi bi-check-circle-fill me-1"></i> Procesado</span>
                    </div>
                    <div class="order-date text-end">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                        <span class="mx-2 text-muted">|</span>
                        <i class="bi bi-clock me-1"></i>
                        {{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }}
                    </div>
                </div>

                <!-- Cuerpo: Tabla de productos -->
                <div style="padding: 0;">
                    <div class="table-responsive">
                        <table class="table table-orders mb-0">
                            <thead style="background: linear-gradient(135deg, rgba(78, 205, 196, 0.08) 0%, transparent 100%);">
                                <tr>
                                    <th class="ps-5 py-3">Producto</th>
                                    <th class="text-center py-3">Cantidad</th>
                                    <th class="text-center py-3">Precio Unit.</th>
                                    <th class="text-end pe-5 py-3">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($order->products as $item)
                                <tr style="border-bottom: 1px solid rgba(78, 205, 196, 0.1);">
                                    <td class="ps-5 py-4 product-name-cell">
                                        {{ $item->product->name }}
                                    </td>
                                    <td class="text-center py-4">
                                        <span class="qty-badge">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="text-center text-muted py-4">
                                        {{ number_format($item->product->price, 2) }} €
                                    </td>
                                    <td class="text-end pe-5 fw-bold py-4">
                                        {{ number_format($item->quantity * $item->product->price, 2) }} €
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer: Total -->
                <div class="order-footer">
                    <div class="d-flex align-items-center justify-content-end gap-3">
                        <span class="total-label">Total pagado:</span>
                        <span class="total-amount">{{ number_format($order->total, 2) }} €</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @if($orders->isEmpty())
    <div class="text-center py-5">
        <div class="empty-state-icon shadow-sm mb-4" style="background: linear-gradient(135deg, rgba(78, 205, 196, 0.15) 0%, rgba(255, 107, 107, 0.1) 100%); width: 100px; height: 100px; margin: 0 auto;">
            <i class="bi bi-receipt"></i>
        </div>
        <h3 class="fw-bold">No hay pedidos aún</h3>
        <p class="text-muted">Cuando realices tu primera compra, aparecerá aquí.</p>
        <a href="/" class="btn btn-primary-app px-4 py-2 mt-2">Ir a la carta</a>
    </div>
    @endif
</div>
@endsection
