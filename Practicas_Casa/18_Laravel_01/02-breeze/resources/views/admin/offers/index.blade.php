@extends("layouts_prieto.home")

@section("content")


<div class="container pb-5 mb-2">
    <h3 class="mb-5 text-center">Nuestras Ofertas</h3>
    <br>
    <a href="{{ route('admin.offers.create') }}" class="btn btn-outline-success btn-sm w-100">Crear Oferta</a>
    <br><br><br>
    @foreach ($offers as $offer)
    <div class="offer-section mb-5 p-4 border rounded shadow-sm bg-white">
        <h4 class="mb-4 text-primary border-bottom pb-2">
            Oferta del {{ $offer->date_delivery->format('d/m/Y')}} <small class="text-muted fs-6"></small>
        </h4>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 100px;">Imagen</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offer->productsOffer as $productOffer)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $productOffer->product->image) }}"
                                alt="{{ $productOffer->product->name }}"
                                class="img-thumbnail"
                                style="width: 80px; height: 60px; object-fit: contain;">
                        </td>
                        <td>
                            <div class="fw-bold">{{ $productOffer->product->name }}</div>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ $productOffer->product->description ?? 'Sin descripción disponible.' }}
                            </small>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <form method="POST" action="{{ route('admin.offers.destroy', $offer->id) }}" class="m-0">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                Eliminar
            </button>
        </form>

    </div>
    @endforeach

</div>

@endsection