@extends('adminlte::page')

@section('title', 'Ver clientes')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap4.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap4.css">

@endsection

@section('content_header')
    <h1>Listado de intervenciones</h1>
@stop


@section('content')
<div class="card">
    <div class="card-body">
        <table id="interventions_table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Dominio</th>
                    <th>KM</th>
                    <th>PKM</th>
                    <th>Aceite</th>
                    <th>F.Aceite</th>
                    <th>F.Comb</th>
                    <th>F.Aire</th>
                    <th>A.Caja</th>
                    <th>Balanceo</th>
                    <th>Rot</th>
                    <th>F.Habitaculo</th>
                    <th>A.Diferencial</th>
                    <th>L.Freno</th>
                    <th>F.Hidraulico</th>
                    <th>Obs</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($interventions as $intervention)
                <tr>
                    <td>{{$intervention->id}}</td>
                    <td>{{$intervention->created_at->format('d-m-Y')}}</td>
                    <td>{{$intervention->dominio}}</td>
                    <td>{{$intervention->km}}</td>
                    <td>{{$intervention->pkm}}</td>
                    <td>{{$intervention->aceite}}</td>
                    <td>{{$intervention->filtroaceite}}</td>
                    <td>{{$intervention->filtrocomb}}</td>
                    <td>{{$intervention->filtroaire}}</td>
                    <td>{{$intervention->aceitecaja}}</td>
                    <td>{{$intervention->balanceo}}</td>
                    <td>{{$intervention->rot}}</td>
                    <td>{{$intervention->filtrohabitaculo}}</td>
                    <td>{{$intervention->aceitediferencial}}</td>
                    <td>{{$intervention->liqfreno}}</td>
                    <td>{{$intervention->fluidohidraulico}}</td>
                    <td>{{$intervention->observaciones}}</td>

                    <td>
                        <div class="d-flex align-items-center">
                        <form action="{{ route('intervencion.destroy',  $intervention->id) }}" method="POST">
                            <a href=""><button class="btn btn-secondary me-2"><i class="fas fa-trash-alt"></button></i></a>
                            @csrf
                            @method('DELETE')
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
    new DataTable('#interventions_table', {
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
                    orientation: 'landscape', // Orientación: portrait o landscape
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
