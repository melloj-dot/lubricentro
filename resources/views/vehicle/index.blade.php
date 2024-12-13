@extends('adminlte::page')

@section('title', 'Ver clientes')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap4.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap4.css">

@endsection

@section('content_header')
    <h1>Listado de vehículos</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="vehiclestable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Dominio</th>
                    <th>Aceite</th>
                    <th>A.Diferencial</th>
                    <th>N.Cubiertas</th>
                    <th>N.Propietario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{$vehicle->ID}}</td>
                    <td>{{$vehicle->Modelo}}</td>
                    <td>{{$vehicle->Dominio}}</td>
                    <td>{{$vehicle->Aceite}}</td>
                    <td>{{$vehicle->ADiferencial}}</td>
                    <td>{{$vehicle->NCubiertas}}</td>
                    <td>{{$vehicle->NPropietario}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                        <form action="{{ route('vehiculo.destroy',  $vehicle->ID) }}" method="POST">
                            <a href=""><button class="btn btn-secondary me-2"><i class="fas fa-trash-alt"></button></i></a>
                            @csrf
                            @method('DELETE')
                        </form>
                        -
                        <form action="{{ route('vehiculo.edit',  $vehicle->ID) }}">
                            @csrf
                            @method('PUT')
                            <a href=""><button class="btn btn-secondary me-2"><i class="fas fa-user-edit"></button></i></a>
                        </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>
<!-- Responsive DataTables -->
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap4.js"></script>
<!-- DataTables Buttons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.min.js"></script>
<!-- PDFMake -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script>
    new DataTable('#vehiclestable', {
        responsive: true,
                "language":{
                    "search": "Buscar",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "info":     "Mostrando página _PAGE_ de _PAGES_",
                    "paginate":  {
                            "previous": "Anterior",
                            "next": "Siguiente",
                    }

                },
                order: [[0, 'desc']],
                dom: 'Bfrtip', // Habilita los botones
            buttons: [
                'copy',
                'excel',
                'csv',
                {
                    extend: 'pdfHtml5',
                    title: 'Reporte de Tabla', // Título del PDF
                    text: 'Exportar a PDF', // Texto del botón
                    orientation: 'portrait', // Orientación: portrait o landscape
                    pageSize: 'A4', // Tamaño de la página: A4, Letter, etc.
                    customize: function (doc) {
                        doc.styles.title = {
                            fontSize: 16,
                            bold: true,
                            alignment: 'center',
                        };
                        doc.styles.tableHeader = {
                            bold: true,
                            fontSize: 12,
                            color: 'white',
                            fillColor: '#f7d71c', // Color del encabezado
                        };
                    }
                }
            ]

});
</script>
@endsection
