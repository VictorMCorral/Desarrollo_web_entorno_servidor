@extends("layouts_prieto.home")

@section("content")
<div class="container py-5">
    <div class="row">
        <div class="col-12 border-bottom mb-4 pb-2">
            <h2 class="fw-bold"><i class="bi bi-cart3"></i> Tu Carrito</h2>
        </div>

        @if(count($carrito) > 0)
        @php $totalGeneral = 0; @endphp

        <div class="col-lg-8">
            @foreach ($carrito as $offerId => $items)
            @php $offer = $offersById[$offerId] ?? null; @endphp

            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                    <span class="fw-bold text-uppercase small text-muted">
                        <i class="bi bi-truck me-2"></i> Entrega:
                        <span class="text-dark">{{ $offer->date_delivery->format('d/m/Y') }} — {{ $offer->tiem_delivery }}</span>
                    </span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light small">
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
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $producto->image) }}"
                                                class="rounded border me-3"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $producto->name }}</h6>
                                                <small class="text-muted">{{ number_format($producto->price, 2) }} € / ud.</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="min-width: 150px;">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="input-group input-group-sm w-auto border rounded">
                                                <form method="POST" action="{{ route('cartRemoveOne', $producto->id) }}" class="m-0">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-decoration-none text-dark" @if($quantity <=1) disabled @endif>
                                                        -
                                                    </button>
                                                </form>

                                                <span class="input-group-text bg-white border-0 fw-bold px-3">{{ $quantity }}</span>

                                                <form method="POST" action="{{ route('cartAddOne', $producto->id) }}" class="m-0">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-decoration-none text-dark">
                                                        +
                                                    </button>
                                                </form>
                                            </div>

                                            <form method="POST" action="{{ route('cartRemove', $producto->id) }}" class="ms-3">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-outline-danger btn-sm border-0">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4 fw-bold">
                                        {{ number_format($lineTotal, 2) }} €
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                <div class="card-body">
                    <h5 class="mb-4 fw-bold">Resumen del pedido</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>{{ number_format($totalGeneral, 2) }} €</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 font-weight-bold">
                        <span>Gastos de envío</span>
                        <span class="text-success">Gratis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="h5 fw-bold">Total</span>
                        <span class="h5 fw-bold text-primary">{{ number_format($totalGeneral, 2) }} €</span>
                    </div>

                    <form method="POST" action="{{ route('cartOrder') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 py-2 mb-3 fw-bold">
                            CONFIRMAR RESERVA
                        </button>
                    </form>

                    <form method="POST" action="{{ route('cartClear') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-secondary btn-sm w-100 border-0">
                            Vaciar carrito
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @else
        <div class="col-12 text-center py-5">
            <div class="mb-4">
                <i class="bi bi-cart-x text-muted" style="font-size: 5rem;"></i>
            </div>
            <h4>Tu carrito está vacío</h4>
            <p class="text-muted">Parece que aún no has añadido productos a tu reserva.</p>
            <a href="/" class="btn btn-primary px-4 mt-3">Ir a la tienda</a>
        </div>
        @endif
    </div>
</div>

<style>
    /* Un toque de estilo extra */
    .btn-link:hover {
        color: #0d6efd !important;
    }

    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.75rem;
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .input-group-text {
        min-width: 40px;
        justify-content: center;
    }
</style>
@endsection