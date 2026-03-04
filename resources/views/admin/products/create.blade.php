@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    {{-- Título sencillo y elegante --}}
    <div class="mb-4">
        <h1 class="h2 fw-light text-secondary">Registrar <span class="fw-bold text-dark">Producto</span></h1>
        <hr class="w-25">
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="row g-4">

    @csrf
        {{-- Lado izquierdo: Información --}}
        <div class="col-lg-8">
            <div class="p-4 bg-white rounded-4 shadow-sm border">
                <div class="mb-4">
                    <label class="form-label small text-uppercase fw-bold text-muted">Nombre del plato</label>
                    <input type="text" name="name" class="form-control form-control-lg border-0 bg-light @error('name') is-invalid @enderror"
                           placeholder="Ej. Solomillo al Whisky" style="border-radius: 8px;">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-0">
                    <label class="form-label small text-uppercase fw-bold text-muted">Descripción del contenido</label>
                    <textarea name="description" rows="8" class="form-control border-0 bg-light @error('description') is-invalid @enderror"
                              placeholder="Detalla los ingredientes..." style="border-radius: 8px;"></textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        {{-- Lado derecho: Datos y Acción --}}
        <div class="col-lg-4">
            <div class="p-4 bg-white rounded-4 shadow-sm border mb-4">
                <div class="mb-4">
                    <label class="form-label small text-uppercase fw-bold text-muted">Precio</label>
                    <div class="input-group">
                        <input type="number" step="0.01" name="price" class="form-control form-control-lg border-0 bg-light @error('price') is-invalid @enderror"
                               placeholder="0.00"  style="border-radius: 8px 0 0 8px;">
                        <span class="input-group-text border-0 bg-light text-muted" style="border-radius: 0 8px 8px 0;">€</span>
                    </div>
                    @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="mb-0">
                    <label class="form-label small text-uppercase fw-bold text-muted">Imagen</label>
                    <input type="file" name="image" class="form-control border-0 bg-light @error('image') is-invalid @enderror" style="border-radius: 8px;">
                    @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-dark btn-lg shadow-sm py-3" style="border-radius: 8px;">
                    Guardar Producto
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-link text-muted text-decoration-none small">
                    Cancelar y volver
                </a>
            </div>
        </div>
    </form>

</div>
@endsection
