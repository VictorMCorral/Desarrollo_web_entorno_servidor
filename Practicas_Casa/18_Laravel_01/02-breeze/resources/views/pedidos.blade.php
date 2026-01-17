@extends("layouts_prieto.home")

@section("content")
<div class="container py-5">
    <h3 class="mb-4 text-center">Listado de Pedidos</h3>

    @foreach($orders as $order)
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span>Orden #{{ $order->id }}</span>
                </div>
                <div class="d-flex flex-column align-items-end">
                    <small>Fecha: {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</small>
                    <span class="badge
                @if($order->status === 'pending') bg-warning
                @elseif($order->status === 'completed') bg-success
                @elseif($order->status === 'cancelled') bg-danger
                @else bg-secondary
                @endif
            mt-1">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td>${{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-end fw-bold">
                                Total del pedido: ${{ number_format($order->total, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
