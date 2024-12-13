@extends('adminlte::page')

@section('title', 'Crear cliente')

@section('content_header')
    <h1>Editar datos de cliente</h1>
@stop


@section('content')

@if ($errors->has('cuit_cuil'))
    <div class="alert alert-danger">
        {{ $errors->first('cuit_cuil') }}
    </div>
@endif

@if ($errors->has('email'))
    <div class="alert alert-danger">
        {{ $errors->first('email') }}
    </div>
@endif

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Datos del cliente</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="{{route('cliente.update', $customer->id)}}">
        @csrf
        @method('patch')
      <div class="card-body">
        <div class="form-group">
            <label for="nombre_cliente">Nombre Cliente</label>
            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" value="{{$customer->name}}" required>
        </div>
        <div class="form-group">
            <label for="nombre_cliente">CUIT/CUIL</label>
            <input type="text" class="form-control" id="cuit_cuil" name="cuit_cuil" value="{{$customer->cuit_cuil}}" required>
        </div>
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{$customer->adress}}" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" value={{$customer->telephone}} required>
        </div>
{{--         <div class="form-group">
            <label for="date">Fecha de alta</label>
            <input type="date" class="form-control" id="date" name="date" placeholder="Ingrese la fecha" value="{{$customer->created_at}}" required>
        </div> --}}
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
    </form>
  </div>
@endsection
