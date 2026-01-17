@extends("layouts_prieto.home")

@section("content")
<div class="container py-5">
    <h5 class="mb-4">Listado de pedidos</h5>
    @foreach($pedidosImprimir as $bloque)
    <h3>Pedido #{{ $bloque['pedido']->id }}</h3>
    <p>Fecha: {{ $bloque['pedido']->created_at }}</p>

    <ul>
        @foreach($bloque['lineas'] as $linea)
        <li>{{ $linea->producto }} - Cantidad: {{ $linea->cantidad }}</li>
        @endforeach
    </ul>
    @endforeach



</div>
@endsection