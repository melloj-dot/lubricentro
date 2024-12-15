<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <style type="text/css">
    *{
      font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
      font-size: 12px;
    }
    .tables{
        justify-content: center;
    }
    #obs{
        text-align: right;
    }
    th{
      border: 1px solid black;
      text-align: center;
    }

    tr,td {
      border: 1px solid black;
      text-align: center;
    }
    h2{
      font-size: 14px;
      text-align: center;
    }
    .thead-intervencion{
        background: rgba(255, 0, 0, 0.918);
        color: white;
    }
    body {
        min-height : 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

  </style>

  <title>Impresion de Registro</title>
</head>
<body>

    @php
    $path = 'img/shell.jpg';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $b64a = 'data:img/' . $type . ';base64,' . base64_encode($data);
@endphp

@php
    $path = 'img/ypf.png';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $b64b = 'data:img/' . $type . ';base64,' . base64_encode($data);
@endphp

@php
    $path = 'img/mannfilter.png';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $b64c = 'data:img/' . $type . ';base64,' . base64_encode($data);
@endphp

@php
    $path = 'img/firestone.png';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $b64d = 'data:img/' . $type . ';base64,' . base64_encode($data);
@endphp

@php
    $path = 'img/bridgestone.png';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $b64e = 'data:img/' . $type . ';base64,' . base64_encode($data);
@endphp


<div style="text-align: center">
    <img src="<?php echo $b64a?>" width="130" height="50">
    <img src="<?php echo $b64b?>" width="130" height="50">
    <img src="<?php echo $b64c?>" width="130" height="50">
    <img src="<?php echo $b64d?>" width="130" height="50">
    <img src="<?php echo $b64e?>" width="130" height="50">
</div>

@php
    $path = 'img/logo.png';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $b64l = 'data:img/' . $type . ';base64,' . base64_encode($data);
@endphp

<div style="text-align: center">
    <img src="<?php echo $b64l?>" width="450" height="100">
</div>
  <div id="proprietary">
    <p><b>Propietario: </b>{{ $vehicleData[0]->NPropietario  }}</p>
    <p><b>Cuit-Cuil </b>{{ $vehicleData[0]->CuitCuil }}</p>
    <p><b>Modelo: </b>{{ $vehicleData[0]->Modelo }}</p>
    <p><b>Aceite: </b>{{ $vehicleData[0]->Aceite }}</p>
    <p><b>Patente: </b>{{ $vehicleData[0]->Dominio }}</p>
    <p><b>Cubiertas: </b>{{ $vehicleData[0]->NCubiertas }}</p>

  </div>

  <h2>Historial de intervenciones</h2>

  <table class="tables" cellspacing="0" cellpadding="0" style="text-align: center" width="100%">
      <thead class="thead-intervencion">
          <tr>
          <th>Fecha</th>
          <th>Km</th>
          <th>Próximo cambio</th>
          <th>Aceite</th>
          <th>Filtro aceite</th>
          <th>Filtro comb.</th>
          <th>Filtro aire</th>
          <th>Aceite Caja</th>
          <th>Balanceo</th>
          <th>Rotación</th>
          <th>Filtro hab.</th>
          <th>A. Diferencial
          <th>Liq. Freno</th>
          <th>Fluido Hidráulico</th>
          <th>Refrig. radiador</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($interventions as $intervention)
            <tr>
                <th>{{ $intervention->created_at->format('d-m-Y') }}</th>
                <th>{{ $intervention->km }}</th>
                <th>{{ $intervention->pkm  }}</th>
                @if ($intervention->aceite == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->aceite }}</th>
                @endif
                @if ($intervention->filtroaceite == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->filtroaceite }}</th>
                @endif
                @if ($intervention->filtrocomb == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->filtrocomb }}</th>
                @endif
                @if ($intervention->filtroaire == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->filtroaire }}</th>
                @endif
                @if ($intervention->aceitecaja == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->aceitecaja }}</th>
                @endif
                @if ($intervention->balanceo == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->balanceo }}</th>
                @endif
                @if ($intervention->rot == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->rot }}</th>
                @endif
                @if ($intervention->filtrohabitaculo == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->filtrohabitaculo }}</th>
                @endif
                @if ($intervention->aceitediferencial == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->aceitediferencial }}</th>
                @endif
                @if ($intervention->liqfreno == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->liqfreno }}</th>

                @endif
                @if ($intervention->fluidohidraulico == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->fluidohidraulico }}</th>
                @endif

                @if ($intervention->refrigradiador == null)
                    <th>NO</th>
                @else
                    <th>{{ $intervention->refrigradiador }}</th>
                @endif
            </tr>
          @endforeach
      </tbody>
      </table>


  <h2>Observaciones</h2>
  <table id="obs" class="tables" cellspacing="0" cellpadding="0" width="100%">
      <thead class="thead-intervencion">
          <tr>
          <th>Fecha</th>
          <th>Observaciones</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($interventions as $intervention)
              <tr>
                @if ($intervention->created_at == null)
                    <td>
                        -
                    </td>
                @else
                <td>{{ $intervention->created_at->format('d-m-Y') }}</td>

                @endif
                  <td>{{ $intervention->observaciones }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>

</body>
</html>

