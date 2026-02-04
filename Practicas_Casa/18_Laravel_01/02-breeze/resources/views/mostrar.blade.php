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

    .main-title {
        font-weight: 800;
        letter-spacing: -1.5px;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    /* Tabs Estilo Moderno */
    .nav-tabs-premium {
        border: none;
        gap: 10px;
    }

    .nav-tabs-premium .nav-link {
        border: none !important;
        border-radius: 12px !important;
        padding: 12px 24px;
        font-weight: 600;
        color: #64748b;
        background: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
    }

    .nav-tabs-premium .nav-link.active {
        background: var(--primary-gradient) !important;
        color: white !important;
        box-shadow: 0 8px 15px rgba(99, 102, 241, 0.3);
        transform: translateY(-2px);
    }

    /* Tarjeta de Producto Premium */
    .product-card {
        border: none;
        border-radius: 24px;
        background: white;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .img-wrapper {
        background: #f1f5f9;
        margin: 15px;
        border-radius: 20px;
        height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .img-wrapper img {
        transition: transform 0.5s ease;
    }

    .product-card:hover .img-wrapper img {
        transform: scale(1.1);
    }

    .price-tag {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1e293b;
    }

    .btn-add-cart {
        background: var(--primary-gradient);
        border: none;
        border-radius: 14px;
        padding: 12px;
        font-weight: 700;
        color: white;
        transition: all 0.3s;
    }

    .btn-add-cart:hover {
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.4);
        transform: scale(1.02);
        color: white;
    }

    /* Estilo para Invitados */
    .guest-alert {
        background: #fff1f2;
        color: #e11d48;
        padding: 10px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid #ffe4e6;
    }

    .section-spacing {
        padding: 60px 0;
    }
</style>

<div class="container section-spacing">
    <div class="text-center mb-5">
        <span class="badge rounded-pill px-3 py-2 mb-2" style="background: #eef2ff; color: #4338ca; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Especialidades</span>
        <h1 class="main-title">Descubre nuestro Menú</h1>
        <p class="text-muted">Selecciona una fecha de entrega y explora platos exclusivos.</p>
    </div>

    <!-- Selector de Fechas (Tabs) -->
    <ul class="nav nav-tabs nav-tabs-premium justify-content-center mb-5" id="tabs" role="tablist">
        @foreach ($offers as $offer)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                id="tab-{{ $offer->id }}"
                data-bs-toggle="tab"
                data-bs-target="#pane-{{ $offer->id }}"
                type="button" role="tab">
                <i class="bi bi-calendar-event me-2"></i>
                {{ $offer->date_delivery->format('d M') }}
            </button>
        </li>
        @endforeach
    </ul>

    <!-- Contenido del Menú -->
    <div class="tab-content" id="myTabContent">
        @foreach ($offers as $offer)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
            id="pane-{{ $offer->id }}"
            role="tabpanel">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4 justify-content-center">
                @foreach ($offer->productsOffer as $productOffer)
                <div class="col">
                    <div class="card h-100 product-card shadow-sm">
                        <!-- Imagen con contenedor estilizado -->
                        <div class="img-wrapper">
                            <img src="{{ asset('storage/' . $productOffer->product->image) }}"
                                class="img-fluid p-2"
                                alt="{{ $productOffer->product->name }}">
                        </div>

                        <div class="card-body d-flex flex-column px-4 pb-4 pt-0">
                            <h5 class="card-title fw-bold mb-2" style="color: #1e293b;">{{ $productOffer->product->name }}</h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ $productOffer->product->description ?? 'Una delicia preparada con ingredientes frescos seleccionados para ti.' }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <span class="price-tag">{{ number_format($productOffer->product->price, 2) }}<small class="fs-6">€</small></span>

                                @auth
                                <form method="POST" action="{{ route('cartAdd', $productOffer->product->id) }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-add-cart">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </form>
                                @endauth
                            </div>

                            @guest
                            <div class="mt-3 text-center">
                                <div class="guest-alert">
                                    <i class="bi bi-lock-fill me-1"></i> Regístrate para comprar
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
