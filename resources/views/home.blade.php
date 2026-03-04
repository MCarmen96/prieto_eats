@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-success mb-4" style="font-weight: 300;">Nuestras ofertas</h2>

    {{-- Pestañas de Fechas (Botones de arriba) --}}
    <ul class="nav nav-pills justify-content-center mb-5" id="pills-tab" role="tablist">
        @foreach($offersByDate as $date => $offers)
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $loop->first ? 'active' : '' }} mx-2 shadow-sm btn-fecha"
                id="tab-{{ $loop->index }}"
                data-bs-toggle="pill"
                data-bs-target="#content-{{ $loop->index }}"
                type="button" role="tab">
            {{ \Carbon\Carbon::parse($date)->translatedFormat('d F') }}
        </button>
    </li>
@endforeach
    </ul>

    {{-- Contenido de las Pestañas (Las Cards) --}}
    <div class="tab-content">

        @foreach($offersByDate as $date => $offers)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                 id="content-{{ $loop->index }}" role="tabpanel">

                <div class="row g-4">
                    @foreach($offers as $offer)
                        {{-- Entramos en la tabla intermedia 'product_offers' --}}
                        @foreach($offer->productsOffer as $item){{-- item ya puede acceder a productos --}}
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                                    <div class="position-relative">
                                        {{-- Accedemos al producto final a través de la intermedia --}}
                                        <img src="{{ asset($item->product->image) }}" class="card-img-top" style="height: 220px; object-fit: cover;">

                                        <div class="position-absolute top-0 start-0 m-3 shadow-sm"
                                             style="background-color: #f7af3b; color: white; padding: 4px 12px; border-radius: 20px; font-weight: bold;">
                                            {{ number_format($item->product->price, 2) }}€
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="text-success fw-bold small mb-1">{{ $item->product->name }}</h5>
                                        <p class="text-muted mb-3" style="font-size: 0.85rem;">{{ $item->product->description }}</p>

                                        @auth
                                            <form action="{{ route('cart.add', $item->product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm px-3" style="background-color: #5ba564; border: none;">
                                                    Añadir al carrito
                                                </button>
                                            </form>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
