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

    <!-- Botón para registrar un nuevo movimiento de stock -->
    <a href="{{ route('stock.create') }}" class="btn btn-primary mb-3">Nuevo Movimiento de Stock</a>

    <!-- Tabla de movimientos de stock -->
    @if($stocks->count() > 0)
        <table class="table table-bordered table-hover">
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
