@extends("layouts_prieto.home")

@section("content")
<div class="container section-spacing">
    <!-- Header Section con Gradiente -->
    <div class="page-hero text-center mb-5 fade-in">
        <span class="badge badge-soft-primary">
            <i class="bi bi-brightness-high-fill me-1"></i>
            Nuestra Selección
        </span>
        <h1 class="main-title mt-4">Ofertas disponibles</h1>
        <p class="text-muted fs-6">Selecciona una fecha y descubre platos únicos</p>
    </div>

    <!-- Tabs de Fechas - Diseño Moderno -->
    <div class="d-flex justify-content-center mb-5">
        <ul class="nav nav-tabs-premium" id="tabs" role="tablist">
            @foreach ($offers as $offer)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                    id="tab-{{ $offer->id }}"
                    data-bs-toggle="tab"
                    data-bs-target="#pane-{{ $offer->id }}"
                    type="button" role="tab">
                    <i class="bi bi-calendar-check me-2"></i>
                    <span class="fw-semibold">{{ $offer->date_delivery->format('d M') }}</span>
                </button>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Grid de Productos -->
    <div class="tab-content" id="myTabContent">
        @foreach ($offers as $offer)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
            id="pane-{{ $offer->id }}"
            role="tabpanel">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @foreach ($offer->productsOffer as $productOffer)
                <div class="col">
                    <div class="card h-100 product-card">
                        <!-- Imagen -->
                        <div class="img-wrapper">
                            <img src="{{ asset('storage/' . $productOffer->product->image) }}"
                                class="img-fluid"
                                alt="{{ $productOffer->product->name }}">
                        </div>

                        <!-- Contenido -->
                        <div class="card-body d-flex flex-column px-4 pt-3 pb-4">
                            <h5 class="product-title mb-2">
                                {{ $productOffer->product->name }}
                            </h5>

                            <p class="product-desc text-muted mb-3 flex-grow-1">
                                {{ Str::limit($productOffer->product->description ?? 'Preparado con ingredientes frescos y seleccionados', 80) }}
                            </p>

                            <!-- Footer del Card -->
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top" style="border-color: rgba(78, 205, 196, 0.1) !important;">
                                <span class="price-tag">
                                    {{ number_format($productOffer->product->price, 2) }}
                                    <small class="fs-6">€</small>
                                </span>

                                @auth
                                <form method="POST" action="{{ route('cartAdd', $productOffer->product->id) }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn-add-cart">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </form>
                                @endauth
                            </div>

                            @guest
                            <div class="mt-3">
                                <div class="guest-alert text-center">
                                    <i class="bi bi-lock-fill me-1"></i>
                                    <span class="small">Inicia sesión para ordenar</span>
                                </div>
                            </div>
                            @endguest
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
