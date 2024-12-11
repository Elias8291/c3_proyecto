@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Lista de Documentos</h1>
 
    <a href="{{ route('documentos2.create') }}" class="btn btn-primary mb-3">Crear Documento</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Número de Hojas</th>
                <th>Fecha de Creación</th>
                <th>Estado</th>
                <th>Evaluado</th>
                <th>Área</th>
                <th>Carpeta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($documentos as $documento)
                <tr>
                    <td>{{ $documento->id }}</td>
                    <td>{{ $documento->numero_hojas }}</td>
                    <td>{{ $documento->fecha_creacion }}</td>
                    <td>{{ $documento->estado }}</td>
                    <td>{{ $documento->id_evaluado }}</td>
                    <td>{{ $documento->id_area }}</td>
                    <td>{{ $documento->id_carpeta ?? 'N/A' }}</td>
                    
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay documentos disponibles</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
