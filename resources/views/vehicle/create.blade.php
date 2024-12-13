@extends('adminlte::page')

@section('title', 'Crear cliente')

@section('content_header')
    <h1>Alta de vehículo</h1>
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
            <i class="fas fa-car fa-2x"></i>
            <button class="btn btn-primary">Datos del vehículo</button>
          </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('vehiculo.store')}}" method="POST">
        @csrf
      <div class="card-body">
        <div class="form-group">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select id="cliente_id" name="cliente_id" class="form-control" required>
                <option value="" selected disabled>Seleccione un cliente</option>
                <!-- Suponiendo que tienes una lista de clientes -->
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->name }} - {{$cliente->cuit_cuil}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Ingrese el modelo del vehículo" required>
        </div>
        <div class="form-group">
            <label for="dominio">Dominio</label>
            <input type="text" class="form-control" id="dominio" name="dominio" placeholder="Ingrese el dominio del vehículo" required>
        </div>
        <div class="form-group">
            <label for="aceite">Aceite</label>
            <input type="text" class="form-control" id="aceite" name="aceite" placeholder="Ingrese el aceite del vehículo" required>
        </div>
        <div class="form-group">
            <label for="aceitedif">Aceite Diferencial</label>
            <input type="text" class="form-control" id="aceitedif" name="aceitedif" placeholder="Ingrese el aceite diferencial del vehículo" required>
        </div>
        <div class="form-group">
            <label for="ncubiertas">Numero de cubiertas</label>
            <input type="text" class="form-control" id="ncubiertas" name="ncubiertas" placeholder="Ingrese el número de cubiertas del vehículo" required>
        </div>

      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-secondary" >Enviar</button>
      </div>
    </form>
  </div>
@endsection
