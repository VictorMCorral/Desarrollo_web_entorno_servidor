@extends("layouts_prieto.home")

@section("content")
<div class="container section-spacing">
    <div class="page-hero mb-5">
        <span class="badge badge-soft-primary mb-2">
            <i class="bi bi-bag-check-fill me-1"></i>
            Revisión final
        </span>
        <h1 class="cart-title m-0">Tu carrito de reserva</h1>
        <p class="text-muted mb-0">Revisa tu pedido antes de confirmar la reserva.</p>
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
                    <i class="bi bi-truck-flatbed text-primary fs-5"></i>
                    <div class="flex-grow-1">
                        <span class="small text-muted d-block text-uppercase fw-bold">Programado para:</span>
                        <span class="fw-bold text-dark">{{ $offer->date_delivery->format('d/m/Y') }} <span class="mx-2 text-muted">|</span> {{ $offer->tiem_delivery }}</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr style="background: linear-gradient(135deg, rgba(78, 205, 196, 0.08) 0%, transparent 100%);">
                                <th class="ps-4 py-3">Producto</th>
                                <th class="text-center py-3">Cantidad</th>
                                <th class="text-end pe-4 py-3">Subtotal</th>
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
                            <tr style="border-bottom: 1px solid rgba(78, 205, 196, 0.1);">
                                <td class="ps-4 py-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ asset('storage/' . $producto->image) }}" class="product-img-cart" style="border-radius: 8px;">
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

                                            <span class="fw-bold px-2 text-dark qty-count">{{ $quantity }}</span>

                                            <form method="POST" action="{{ route('cartAddOne', $producto->id) }}" class="m-0">
                                                @csrf
                                                <button type="submit" class="qty-btn">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <form method="POST" action="{{ route('cartRemove', $productOffer->id) }}" class="ms-3">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-link text-danger p-1" title="Eliminar del carrito">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="text-end pe-4 py-4">
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
            <div class="summary-card ">
                <h4 class="fw-bold mb-4">
                    <i class="bi bi-file-earmark-check text-primary me-2"></i>
                    Resumen
                </h4>

                <div style="background: rgba(78, 205, 196, 0.05); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted fw-semibold">Subtotal</span>
                        <span class="fw-bold text-dark">{{ number_format($totalGeneral, 2) }} €</span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="text-muted fw-semibold">Servicio de entrega</span>
                        <span class="badge badge-soft-success">
                            <i class="bi bi-check-circle me-1"></i>
                            Gratis
                        </span>
                    </div>
                </div>

                <div style="padding: 1.5rem; background: linear-gradient(135deg, rgba(255, 107, 107, 0.08) 0%, rgba(78, 205, 196, 0.05) 100%); border-radius: 8px; border: 1px solid rgba(255, 107, 107, 0.15); margin-bottom: 2rem;">
                    <span class="small text-muted d-block mb-2">Total a pagar</span>
                    <span class="h3 fw-bold m-0 text-primary-app">{{ number_format($totalGeneral, 2) }} €</span>
                    <small class="text-muted">IVA incluido</small>
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

                <div style="margin-top: 2rem; padding: 1.25rem; background: linear-gradient(135deg, rgba(78, 205, 196, 0.1) 0%, transparent 100%); border-left: 3px solid var(--primary); border-radius: 6px;">
                    <div class="d-flex gap-2 align-items-start">
                        <i class="bi bi-shield-check text-primary fs-5 flex-shrink-0 mt-1"></i>
                        <p class="small text-muted mb-0">Reserva segura y garantizada. Podrás ver el estado de tu pedido en tu panel personal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
    <!-- Estado Vacío Innovador -->
    <div class="row justify-content-center py-5 delivery-group-card">
        <div class="col-lg-6 text-center ">
            <div class="empty-cart-icon shadow-sm" style="background: linear-gradient(135deg, rgba(78, 205, 196, 0.15) 0%, rgba(255, 107, 107, 0.1) 100%); width: 120px; height: 120px; margin: 0 auto 2rem;">
                <i class="bi bi-bag-x"></i>
            </div>
            <h2 class="fw-bold text-dark">Tu carrito está esperando</h2>
            <p class="text-muted mb-4 px-lg-5 ">Parece que aún no has seleccionado ninguna de nuestras ofertas especiales para tus próximas entregas.</p>
            <a href="/" class="btn btn-confirm px-5 fw-bold text-dark" >
                Explorar Menú de Hoy
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
