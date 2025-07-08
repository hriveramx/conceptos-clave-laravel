@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <h1>Eventos</h1>
    <a href="{{ route('admin.eventos.create') }}" class="btn btn-primary">Crear Evento</a>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>Título</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
            <tr>
                <td>{{ $evento->titulo }}</td>
                <td>{{ $evento->fecha_evento->format('d/m/Y') }}</td>
                <td>{{ $evento->hora_evento ?? '--' }}</td>
                <td>
                    <a href="{{ route('admin.eventos.edit', $evento) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.eventos.destroy', $evento) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar evento?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $eventos->links() }}
@stop
