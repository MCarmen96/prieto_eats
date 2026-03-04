@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h3 class="text-success mb-0">Mi Carrito</h3>
        </div>

        <div class="card-body">
            @if(empty($cart))
                {{-- si el carrito esta vacio --}}
                <div class="alert alert-success text-center py-4" role="alert">
                    <h4 class="alert-heading">Tu carrito está vacío</h4>
                    <p class="mb-0">¡Echa un vistazo a nuestros menús para añadir algo rico!</p>
                    <hr>
                    <a href="{{ url('/') }}" class="btn btn-success">Ver nuestras Ofertas</a>
                </div>

            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Oferta</th>
                                <th>Imagen</th>
                                <th>Descripcion</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>

                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- VARIABLES PHP PARA CARRITO --}}
                            @php $totalAcumulado = 0; @endphp


                            @foreach($cart as $offerId=> $items)

                                @php
                                    $offer=$offersById[$offerId] ?? null;
                                    $subtotal=0;
                                @endphp

                                <tr>
                                    <td class="fw-bold">>{{$offer->date_delivery->format('d/m/Y')}}</td>

                                    @foreach($items as $productOfferId=> $qty)
                                        @php
                                            $po=$productOfferById[$productOfferId] ?? null;
                                            $prod=$po->product;
                                            $lineaTotal=$prod->price*(int)$qty;
                                            $subtotal+=$lineaTotal;
                                            $totalAcumulado+=$lineaTotal;
                                        @endphp
                                        @if($prod)
                                            <td>
                                                <img src="{{ asset($prod->image) }}" width="80" class="rounded shadow-sm">
                                            </td>
                                            <td class="fw-bold">{{ $prod->description }}</td>
                                            <td class="fw-bold">{{ $prod->name }}</td>
                                            <td>{{ number_format($prod->price, 2) }} €</td>

                                            <td class="text-center" style="width: 150px;">
                                                <div class="input-group input-group-sm justify-content-center">

                                                    <form action="{{ route('cart.decrease', $id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-outline-success px-2 py-0" type="submit"
                                                            {{ $items['quantity'] <= 1 ? 'disabled' : '' }}>
                                                            -
                                                        </button>
                                                    </form>

                                                    <span class="px-3 fw-bold align-self-center">{{ $items['quantity'] }}</span>

                                                    <form action="{{ route('cart.increase', $id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-outline-success px-2 py-0" type="submit">
                                                            +
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                            <td class="fw-bold text-success">{{ number_format($subtotal, 2) }} €</td>
                                            <td class="text-center">
                                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm">Eliminar</button>
                                                </form>
                                            </td>
                                        @endif
                                    @endforeach
                                    </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="fs-5">
                                <td colspan="4" class="text-end fw-bold text-uppercase pt-4">Total Pedido =</td>
                                <td colspan="2" class="fw-bold text-success pt-4">{{ number_format($totalAcumulado, 2) }} €</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-4">

                    {{-- VACIAR CARRITO --}}
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE') {{-- Esto le dice a Laravel: "Aunque el form diga POST, trata esto como un DELETE" --}}
                        <button type="submit" class="btn btn-warning text-white fw-bold">
                            Vaciar Carrito
                        </button>
                    </form>

                    <div>
                        <a href="{{ url('/') }}" class="btn btn-primary fw-bold me-2">Seguir comprando</a>
                        <form action="{{ route('cart.order') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success fw-bold">Confirmar pedido</button>
                        </form>

                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
