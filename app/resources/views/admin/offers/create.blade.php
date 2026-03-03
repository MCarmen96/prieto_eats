@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-4">
        <h1 class="h2 fw-light text-secondary">Registrar <span class="fw-bold text-dark">Oferta</span></h1>
        <hr class="w-25">
    </div>

    <form action="{{ route('admin.offers.store') }}" method="POST" class="row g-4">
        @csrf

        {{-- Lado IZQUIERDO: Configuración de entrega (Columna estrecha) --}}
        <div class="col-lg-4">
            <div class="p-4 bg-white rounded-4 shadow-sm border mb-4">
                <h5 class="mb-4 text-dark fw-bold">Detalles de Entrega</h5>

                {{-- Fecha de entrega --}}
                <div class="mb-4">
                    <label class="form-label small text-uppercase fw-bold text-muted">Fecha recogida</label>
                    <input type="date" name="date_delivery"
                           class="form-control form-control-lg border-0 bg-light @error('date_delivery') is-invalid @enderror"
                           value="{{ old('date_delivery') }}" style="border-radius: 8px;">
                    @error('date_delivery') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Horas de recogida --}}
                <div class="mb-4">
                    <label class="form-label small text-uppercase fw-bold text-muted">Horas recogida</label>
                    <input type="text" name="time_delivery"
                           class="form-control form-control-lg border-0 bg-light @error('time_delivery') is-invalid @enderror"
                           placeholder="Ej. 13:30 - 14:30" value="{{ old('time_delivery') }}" style="border-radius: 8px;">
                    @error('time_delivery') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

            </div>

            {{-- Botonera debajo de los inputs --}}
            <div class="p-4 bg-light rounded-4 border text-center">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark btn-lg shadow-sm py-3 fw-bold" style="border-radius: 8px;">
                        GUARDAR OFERTA
                    </button>
                    <a href="{{ route('admin.offers.index') }}" class="btn btn-link text-muted text-decoration-none small">
                        Cancelar y volver
                    </a>
                </div>
            </div>
        </div>


        <div class="col-lg-8">
            <div class="bg-white rounded-4 shadow-sm border overflow-hidden">
                <div class="p-4 border-bottom bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-dark fw-bold">Seleccionar Platos</h5>
                    <span class="badge bg-dark rounded-pill">{{ count($dishes) }} disponibles</span>
                </div>

                <div class="card-body p-0">
                    @if(count($dishes) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4" style="width: 50px;"></th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th class="text-end pe-4">Vista Previa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dishes as $dish)
                                <tr>
                                    <td class="ps-4">
                                        <input type="checkbox" name="dish_selected[]" value="{{ $dish->id }}"
                                            class="form-check-input border-secondary" style="width: 1.2em; height: 1.2em;">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($dish->image) }}" width="50" height="50" class="rounded-3 shadow-sm me-3" style="object-fit: cover;">
                                            <span class="fw-bold">{{ $dish->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-secondary">{{ number_format($dish->price, 2) }} €</td>
                                    <td class="text-end pe-4">
                                        <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25">Activo</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="p-5 text-center text-muted">
                        <p class="mb-0">No hay productos disponibles para añadir.</p>
                    </div>
                    @endif
                </div>
            </div>
            @error('dish_selected')
                <div class="text-danger small mt-2 fw-bold">{{ $message }}</div>
            @enderror
        </div>

    </form>
</div>
@endsection
