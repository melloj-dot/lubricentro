
@extends('adminlte::page')

@section('title', 'Crear producto')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap4.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap4.css">

@endsection

@section('content_header')
    <h1>Registro de venta</h1>
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
            <i class="fas fa-money-bill-wave fa-2x"></i>
            <button class="btn btn-primary">Datos de la venta</button>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('venta.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="product_id" class="form-label">Producto</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    <option value="">Seleccione un producto</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} (Stock: {{ $product->stock_quantity }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Cantidad</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Venta</button>
            <a href="{{ route('venta.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
