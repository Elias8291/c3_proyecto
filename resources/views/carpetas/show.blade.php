@extends('layouts.app')

@section('title', 'Documentos de la Carpeta')

@section('content')
<style>
    .profile-page {
        background: linear-gradient(135deg, #fff5f5 0%, #fef2f2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.25rem;
        color: #942F2F;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(148, 47, 47, 0.05);
    }

    .btn-back:hover {
        color: #7B1818;
        transform: translateX(-5px);
        box-shadow: 0 4px 6px rgba(148, 47, 47, 0.1);
    }

    .btn-back i {
        margin-right: 0.75rem;
        font-size: 1.1rem;
    }

    .header-section {
        background: white;
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 4px 6px rgba(148, 47, 47, 0.05);
        margin-bottom: 2rem;
        position: relative;
        border-left: 6px solid #942F2F;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-content {
        flex: 1;
    }

    .header-section h3 {
        color: #7B1818;
        font-size: 1.875rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        line-height: 1.2;
    }

    .header-section p {
        color: #942F2F;
        font-size: 1.125rem;
        margin-bottom: 0;
    }

    .btn-agregar {
        background: linear-gradient(135deg, #942F2F 0%, #7B1818 100%);
        color: white;
        padding: 0.875rem 1.75rem;
        border-radius: 12px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        box-shadow: 0 4px 6px rgba(148, 47, 47, 0.2);
    }

    .btn-agregar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 12px rgba(148, 47, 47, 0.3);
    }

    .btn-agregar i {
        font-size: 1.2rem;
    }

    .alert-info {
        background-color: #fff5f5;
        border-left: 5px solid #942F2F;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .alert-info p {
        color: #7B1818;
        font-size: 1.1rem;
        margin: 0;
    }

    .document-section {
        padding: 1rem;
    }

    .list-group {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }

    .list-group-item {
        background: white;
        border-radius: 16px;
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(148, 47, 47, 0.1);
        overflow: hidden;
    }

    .list-group-item:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(148, 47, 47, 0.1), 0 10px 10px -5px rgba(148, 47, 47, 0.04);
    }

    .document-header {
        background: linear-gradient(135deg, #942F2F 0%, #7B1818 100%);
        color: white;
        padding: 1.5rem;
        font-weight: 600;
        font-size: 1.1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .document-details {
        padding: 2rem;
    }

    .document-details p {
        margin-bottom: 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .document-details strong {
        color: #7B1818;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    .document-details span {
        color: #942F2F;
        font-size: 1.05rem;
    }

    .estado-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1.25rem;
        border-radius: 24px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .estado-activo {
        background-color: #fef2f2;
        color: #7B1818;
    }

    .estado-inactivo {
        background-color: #f9e4e4;
        color: #942F2F;
    }

    .document-footer {
        padding: 1.5rem;
        background-color: #fff5f5;
        border-top: 1px solid #fef2f2;
    }

    .document-footer a {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #942F2F;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .document-footer a:hover {
        color: #7B1818;
        transform: translateX(5px);
    }

    .document-icon {
        font-size: 1.75rem;
        color: rgba(255, 255, 255, 0.9);
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        padding-top: 100px;
    }

    .modal-content {
        background-color: white;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        border-radius: 8px;
    }

    .close-btn {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<main class="profile-page">
    <div class="page-container">
        <div class="text-left mb-4">
            <a href="{{ route('carpetas.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </div>

        <div class="header-section">
            <div class="header-content">
                <h3>Documentos de la Carpeta #{{ $carpeta->id }}</h3>
                <p>Nombre del Evaluado: {{ $carpeta->evaluado->primer_nombre }} {{ $carpeta->evaluado->primer_apellido }}</p>
            </div>
            <button class="btn-agregar" onclick="openModal()">
                <i class="fas fa-plus"></i>
                Agregar Documento
            </button>
        </div>

        @if($carpeta->documentos->isEmpty())
            <div class="alert-info">
                <i class="fas fa-info-circle fa-2x text-burgundy-600"></i>
                <p>No hay documentos registrados en esta carpeta actualmente.</p>
            </div>
        @else
            <div class="document-section">
                <ul class="list-group">
                    @foreach($carpeta->documentos as $documento)
                        <li class="list-group-item">
                            <div class="document-header">
                                {{ $documento->area->nombre_area }}
                                <i class="fas fa-file-alt document-icon"></i>
                            </div>
                            <div class="document-details">
                                <p>
                                    <strong>Número de Hojas</strong>
                                    <span>{{ $documento->numero_hojas }}</span>
                                </p>
                                <p>
                                    <strong>Fecha de Creación</strong>
                                    <span>{{ $documento->fecha_creacion }}</span>
                                </p>
                                <p>
                                    <strong>Estado</strong>
                                    <span class="estado-badge {{ $documento->estado === 'Activo' ? 'estado-activo' : 'estado-inactivo' }}">
                                        {{ $documento->estado }}
                                    </span>
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Modal para agregar documento -->
    <div id="addDocumentModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h3>Agregar Documento</h3>
            <form action="{{ route('documentos.store') }}" method="POST">
                @csrf
                <input type="hidden" name="carpeta_id" value="{{ $carpeta->id }}">
                
                <div class="form-group">
                    <label for="area">Área</label>
                    <select name="area_id" class="form-control" required>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->nombre_area }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="numero_hojas">Número de Hojas</label>
                    <input type="number" name="numero_hojas" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="fecha_creacion">Fecha de Creación</label>
                    <input type="date" name="fecha_creacion" class="form-control" required>
                </div>
                
                <button type="submit" class="btn-agregar">Guardar Documento</button>
            </form>
        </div>
    </div>
</main>

<script>
    function openModal() {
        document.getElementById("addDocumentModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("addDocumentModal").style.display = "none";
    }

    // Cerrar el modal al hacer clic fuera del contenido del modal
    window.onclick = function(event) {
        var modal = document.getElementById("addDocumentModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
@endsection
