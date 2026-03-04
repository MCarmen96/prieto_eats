@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert" >
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h3 class="text-success mb-0">Ofertas</h3>
            <form action="{{route('admin.offers.create')}}" method="GET">
                @csrf
                <button class="btn btn-primary btn-sm">+ Crear Ofertas</button>
            </form>
        </div>

        <div class="card-body">
            @if(count($offers) > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha de entrega</th>
                            <th>Hora de entrega</th>
                            <th>Producto</th>
                            <th>Foto</th>
                            <th>Info</th>
                            <th>Precio</th>

                            <th class="text-center">Eliminar</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach($offers as $offer)
                        <tr>

                            <td class="fw-bold">{{ $offer->date_delivery->format('d/m/Y')}}</td>
                            <td class="fw-bold">{{ $offer->time_delivery}}</td>

                            @foreach($offer->productsOffer as $prod )
                                <td>{{$prod->product->name}}</td>
                                <td>
                                    <img src="{{asset($prod->product->image)}}" width="80" class="rounded shadow-sm">
                                </td>
                                <td>{{$prod->product->description}}</td>
                                <td>{{$prod->product->price}} €</td>

                            @endforeach
                            <td class="text-center">
                                <form action="{{route('admin.offers.destroy',$offer->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            @else
            <div class="alert alert-success text-center py-4" role="alert">
                <h4 class="alert-heading">No hay productos disponibles </h4>
                <p class="mb-0">¡Echa un vistazo a nuestros menús para añadir algo rico!</p>
                <hr>
                <a href="{{ url('/') }}" class="btn btn-success">Ver productos</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
