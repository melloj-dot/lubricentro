@extends('adminlte::page')

@section('title', 'Ver ventas')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap4.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap4.css">

@endsection

@section('content_header')
    <h1>Stock</h1>
@stop


@section('content')

    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h4>Cantidad de productos en stock</h4>
    <table id="stock_quantity_table" class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nombre producto</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Cantidad en stock</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description ?? 'Sin descripción' }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock_quantity }}</td>
                    <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <!-- Botón para registrar un nuevo movimiento de stock -->
    <a href="{{ route('stock.create') }}" class="btn btn-primary mb-3">Nuevo Movimiento de Stock</a>

    <!-- Tabla de movimientos de stock -->
    @if($stocks->count() > 0)
        <table id="stock_table" class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $stock->product->name ?? 'Producto eliminado' }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>
                            @if($stock->type === 'addition')
                                <span class="badge bg-success">Adición</span>
                            @else
                                <span class="badge bg-danger">Sustracción</span>
                            @endif
                        </td>
                        <td>{{ $stock->description ?? 'Sin descripción' }}</td>
                        <td>{{ $stock->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('stock.destroy', $stock->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este movimiento?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">No hay movimientos de stock registrados. <a href="{{ route('stock.create') }}">Registra un nuevo movimiento</a>.</p>
    @endif
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
    new DataTable('#stock_table', {
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
                            fillColor: '#FF0000', // Color del encabezado
                        };
                    }
                }
            ]

});

new DataTable('#stock_quantity_table', {
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
                            fillColor: '#FF0000', // Color del encabezado
                        };
                    }
                }
            ]

});


</script>
@endsection
