@extends('layouts.layout')

@section('content')
<div class="container mt-5">

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    @if(session('exito'))
    <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert" >
        {{ session('exito') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h3 class="text-success mb-0">Productos</h3>
            <form action="{{route('admin.products.create')}}" method="GET">
                @csrf
                <button class="btn btn-primary btn-sm">+ Crear Producto</button>
            </form>
        </div>

        <div class="card-body">
            @if(count($dishes) > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th class="text-center">Eliminar</th>
                            <th class="text-center">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dishes as $dish)
                        <tr>
                            <td>
                                <img src="{{asset($dish->image)}}" width="80" class="rounded shadow-sm">
                            </td>
                            <td class="fw-bold">{{ $dish->name}}</td>
                            <td>{{$dish->price}} €</td>


                            <td class="text-center">
                                <form action="{{route('admin.products.destroy',$dish->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.products.edit', $dish->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
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
