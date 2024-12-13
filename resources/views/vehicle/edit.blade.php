@extends('adminlte::page')

@section('title', 'Editar vehículos')

@section('content_header')
    <h1>Editar datos de vehículo</h1>
@stop


@section('content')

@foreach ($errors->all() as $error)
<div class="alert alert-danger">
    {{ $error}}
</div>
@endforeach


<div class="card-body">
    <form action="{{ route('vehiculo.update', $vehiculo->ID) }}" method="POST">
        @csrf
        @method('patch')


        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo"
                   placeholder="Ingrese el modelo del vehículo"
                   value="{{ $vehiculo->Modelo }}" required>
        </div>

        <div class="form-group">
            <label for="dominio">Dominio</label>
            <input type="text" class="form-control" id="dominio" name="dominio"
                   placeholder="Ingrese el dominio del vehículo"
                   value="{{$vehiculo->Dominio}}" required>
        </div>

        <div class="form-group">
            <label for="aceite">Aceite</label>
            <input type="text" class="form-control" id="aceite" name="aceite"
                   placeholder="Ingrese el aceite del vehículo"
                   value="{{ $vehiculo->Aceite }}" required>
        </div>

        <div class="form-group">
            <label for="aceitedif">Aceite Diferencial</label>
            <input type="text" class="form-control" id="aceitedif" name="aceitedif"
                   placeholder="Ingrese el aceite diferencial del vehículo"
                   value="{{ $vehiculo->ADiferencial }}" required>
        </div>

        <div class="form-group">
            <label for="ncubiertas">Numero de cubiertas</label>
            <input type="text" class="form-control" id="ncubiertas" name="ncubiertas"
                   placeholder="Ingrese el número de cubiertas del vehículo"
                   value="{{$vehiculo->NCubiertas}}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

@endsection

