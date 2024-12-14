@extends('adminlte::page')

@section('title', 'Crear intervención')

@section('content_header')
    <h1>Alta de intervención</h1>
@stop


@section('content')


    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error}}
        </div>
    @endforeach

    <form action="{{route('intervencion.store')}}" method="POST">
        @csrf
        <div class="container">
          <div class="card card-primary mb-3">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <i class="fas fa-file fa-2x me-2"></i>
                    <button class="btn btn-primary">Datos de la intervención</button>
                  </div>
            </div>
            <div class="card-body">
              <br>

            <div class="form-group">
                <label for="dominio" class="form-label">Patente</label>
                <select id="dominio" name="dominio" class="form-control" required>
                    <option value="" selected disabled>Seleccione una patente</option>
                    <!-- Suponiendo que tienes una lista de clientes -->
                    @foreach ($vehiculos as $vehiculo)
                        <option value="{{ $vehiculo->Dominio }}">{{ $vehiculo->Dominio }} - {{$vehiculo->NPropietario}}</option>
                    @endforeach
                </select>
            </div>
              <br>
              <div class="row">
                <input
                  type="text"
                  name="km"
                  id="kmtxt"
                  class="form-control"
                  placeholder="Kilómetros actuales:"
                  required>
              </div>
              <br>
              <div class="row">
                <input
                  type="text"
                  name="pkm"
                  id="pkmtxt"
                  class="form-control"
                  placeholder="Próximos kilómetros"
                  required>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-3">
                  <label for="aceite">Aceite</label>
                  <input type="checkbox" name="aceite" value="SI">
                </div>
                <div class="col-sm-3">
                  <label for="filaceite">Filtro aceite</label>
                  <input type="checkbox" name="filaceite" value="SI">
                </div>
                <div class="col-sm-3">
                  <label for="filcomb">Filtro Combustible</label>
                  <input type="checkbox" name="filcomb" value="SI">
                </div>
                <div class="col-sm-3">
                  <label for="filaire">Filtro aire</label>
                  <input type="checkbox" name="filaire" value="SI">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-3">
                  <label for="aceitecaja">Aceite Caja</label>
                  <input type="checkbox" name="aceitecaja" value="SI">
                </div>
                <div class="col-sm-3">
                  <label for="balanceo">Balanceo</label>
                  <input type="checkbox" name="balanceo" value="SI">
                </div>
                <div class="col-sm-3">
                  <label for="rotacion">Rotación</label>
                  <input type="checkbox" name="rotacion" value="SI">
                </div>
                <div class="col-sm-3">
                  <label for="filhab">Filtro habitaculo</label>
                  <input type="checkbox" name="filhab" value="SI">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-3">
                  <label for="aceitedif">Aceite diferencial</label>
                  <input type="checkbox" name="aceitedif" value="SI">
                </div>
                <div class="col-sm-3">
                  <label for="liqfreno">Líquido de freno</label>
                  <input type="checkbox" name="liqfreno" value="SI">
                </div>
                <div class="col-sm-3">
                  <label for="fhid">Fluido hidráulico</label>
                  <input type="checkbox" name="fhid" value="SI">
                </div>
                <div class="col-sm-3">
                  <label for="refrigrad">Refrigerante radiador</label>
                  <input type="checkbox" name="refrigrad" value="SI">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <input type="text" class="form-control" id="observaciones" name="observaciones" placeholder="Ingrese las observaciones" required>
                    </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Añadir intervención</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

@endsection
