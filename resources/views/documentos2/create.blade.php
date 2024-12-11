@extends('layouts.app')

@section('content')
<div id="documentoModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2>Agregar Nuevo Documento</h2>
        <form id="documentoForm" action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_carpeta" value="{{ $carpeta->id }}">
            
            <div class="mb-3">
                <label for="numero_hojas" class="form-label">Número de Hojas</label>
                <input type="text" name="numero_hojas" id="numero_hojas" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="fecha_creacion" class="form-label">Fecha de Creación</label>
                <input type="date" name="fecha_creacion" id="fecha_creacion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="" disabled selected>Seleccione un estado</option>
                    <option value="Disponible">Disponible</option>
                    <option value="Prestado">Prestado</option>
                    <option value="Solicitado">Solicitado</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_evaluado" class="form-label">Evaluado</label>
                <select name="id_evaluado" id="id_evaluado" class="form-select" required>
                    <option value="" disabled selected>Seleccione un evaluado</option>
                    @foreach($evaluados as $evaluado)
                        <option value="{{ $evaluado->id }}">{{ $evaluado->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_area" class="form-label">Área</label>
                <select name="id_area" id="id_area" class="form-select" required>
                    <option value="" disabled selected>Seleccione un área</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre_area }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="pdf_url" class="form-label">Archivo PDF</label>
                <input type="file" name="pdf_url" id="pdf_url" class="form-control" accept="application/pdf" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar Documento</button>
                <button type="button" class="btn btn-secondary btn-cancelar">Cancelar</button>
            </div>
        </form>
    </div>
</div>

@endsection
