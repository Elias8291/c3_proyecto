@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Documentos Prestados</h1>

    @if($prestamos->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Documento</th>
                    <th>Fecha de Solicitud</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestamos as $prestamo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $prestamo->documento->nombre }}</td>
                    <td>{{ $prestamo->fecha_solicitud }}</td>
                    <td>{{ $prestamo->estado }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No tienes documentos prestados actualmente.</p>
    @endif
</div>
@endsection
