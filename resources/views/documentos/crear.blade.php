{{-- resources/views/documentos/crear.blade.php --}}

@extends('layouts.app')

@section('content')
<h2>Crear Documentos para la Carpeta de {{ $evaluado->primer_nombre }} {{ $evaluado->primer_apellido }}</h2>

<form action="{{ route('documentos.store') }}" method="POST">
    @csrf
    <input type="hidden" name="id_carpeta" value="{{ $carpeta->id }}">
    <input type="hidden" name="id_evaluado" value="{{ $evaluado->id }}">

    <label for="numero_hojas">Número de Hojas:</label>
    <input type="text" name="numero_hojas" required>

    <label for="fecha_creacion">Fecha de Creación:</label>
    <input type="date" name="fecha_creacion" required>

    <label for="motivo_evaluacion">Motivo de Evaluación:</label>
    <input type="text" name="motivo_evaluacion" required>

    <label for="estado">Estado:</label>
    <input type="text" name="estado" required>

    <button type="submit">Guardar Documento</button>
</form>
@endsection
