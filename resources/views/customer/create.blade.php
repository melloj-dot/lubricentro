@extends('adminlte::page')

@section('title', 'Crear cliente')

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
            <i class="fas fa-id-card fa-2x me-2"></i>
            <button class="btn btn-primary">Datos del cliente</button>
          </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('cliente.store')}}" method="POST">
        @csrf
      <div class="card-body">
        <div class="form-group">
            <label for="nombre_cliente">Nombre Cliente</label>
            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Ingrese el nombre del cliente" required>
        </div>
        <div class="form-group">
            <label for="cuit_cuil">CUIT/CUIL</label>
            <input type="number" class="form-control" id="cuit_cuil" name="cuit_cuil" placeholder="Ingrese el CUIT/CUIL del cliente (11 dígitos)" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese la dirección del cliente" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el número de teléfono" required>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-secondary" >Enviar</button>
      </div>
    </form>
  </div>
@endsection
