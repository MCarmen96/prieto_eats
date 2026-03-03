@extends('layouts.layout')
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success fw-bold">Mis Pedidos</h2>
        <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm">Volver a la tienda</a>
    </div>

    @if($orders->count() > 0)
        <div class="accordion shadow-sm" id="accordionOrders">
            @foreach($orders as $order)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $order->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}" aria-expanded="false" aria-controls="collapse{{ $order->id }}">
                            <div class="d-flex w-100 justify-content-between align-items-center me-3">
                                <span>
                                    <strong>Pedido #{{ $order->id }}</strong>
                                    <span class="text-muted ms-3 small">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                </span>
                
                                <span class="fw-bold text-success">{{ number_format($order->total, 2) }} €</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse{{ $order->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $order->id }}" data-bs-parent="#accordionOrders">
                        <div class="accordion-body">
                            <table class="table table-sm align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-end">Precio Unit.</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->order_items as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">{{ number_format($item->unit_price, 2) }} €</td>
                                            <td class="text-end fw-bold">{{ number_format($item->quantity * $item->unit_price, 2) }} €</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            Todavía no has realizado ningún pedido.
        </div>
    @endif
</div>
@endsection
