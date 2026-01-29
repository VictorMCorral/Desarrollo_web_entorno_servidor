@extends("layouts_prieto.home")

@section("content")
<div class="container pb-5 mb-2">
    <h3 class="mb-4 text-center">Nuestros Productos</h3>

    <ul class="nav nav-tabs justify-content-center" id="tabs" role="tablist">
        @foreach ($offers as $offer)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                id="tab-{{ $offer->id }}"
                data-bs-toggle="tab"
                data-bs-target="#pane-{{ $offer->id }}"
                type="button" role="tab">
                {{ $offer->date_delivery->format('d/m/Y') }}
            </button>
        </li>
        @endforeach
    </ul>

    <div class="tab-content mt-4" id="myTabContent">
        @foreach ($offers as $offer)

        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
            id="pane-{{ $offer->id }}"
            role="tabpanel">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 g-4">
                @foreach ($offer->productsOffer as $productOffer)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/' . $productOffer->product->image) }}"
                            class="card-img-top img-fluid p-3"
                            style="height: 200px; object-fit: contain;"
                            alt="{{ $productOffer->product->name }}">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $productOffer->product->name }}</h5>
                            <p class="card-text text-muted flex-grow-1">
                                {{ $productOffer->product->description ?? 'Descripción corta y atractiva.' }}
                            </p>
                            <h3 class="card-tittle fw-bold align-self-end">{{ $productOffer->product->price }} €</h3>
                            <div class="mt-3">
                                @auth
                                <form method="POST" action="{{ route('cartAdd', $productOffer->product->id) }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100">
                                        Agregar al carrito
                                    </button>
                                </form>
                                @endauth

                                @guest
                                <small class="text-danger d-block text-center">
                                    Es necesario estar registrado para comprarlo
                                </small>
                                @endguest
                            </div>
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
