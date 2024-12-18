@extends('adminlte::page')

@section('title', 'Crear producto')


@section('content_header')
    <h1>Alta de cliente</h1>
@stop

@section('content')

@foreach ($errors->all() as $error)
<div class="alert alert-danger">
    {{ $error}}
</div>
@endforeach

<div class="card card-primary">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <i class="fas fa-cart-plus fa-2x me-2"></i>
            <button class="btn btn-primary">Datos del producto</button>
          </div>
    </div>
    <div class="card-body">
        <form action="{{ route('producto.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Producto</label>
                <input style="text-transform:uppercase" type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Precio</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}" required>
            </div>
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">Cantidad en Stock</label>
                <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" value="{{ old('stock_quantity') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
            <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

@endsection

