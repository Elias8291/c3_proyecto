@extends('layouts.app')
<style>
  :root {
    --header-color: #9B2847;
    --primary-color: #ffffff;
    --secondary-color: #ffffff;
    --folder-color: #ffffff; /* Color de cartón */
    --folder-tab: #ffffff; /* Tono ligeramente más oscuro para la pestaña */
    --folder-shadow: rgba(216, 213, 213, 0.05);
    --text-color: #ccd0d8;
    --accent-color: #718096;
    --folder-border: #C5BBA4; /* Bordes más tenues */
}

body {
    background-color: #F7FAFC;
    color: var(--text-color);
}

.figure {
    position: absolute;
    background: rgba(123, 42, 59, 0.08); /* Más translúcido para contraste */
    z-index: 0;
    border-radius: 50%;
}

.figure-1 {
    width: 100px;
    height: 100px;
    top: 20%;
    left: 10%;
}

.figure-2 {
    width: 120px;
    height: 120px;
    bottom: 15%;
    left: 25%;
}

.figure-3 {
    width: 150px;
    height: 150px;
    top: 50%;
    right: 10%;
}

/* Ajustar z-index para que el contenido esté encima del fondo decorativo */
.section {
    position: relative;
    z-index: 1;
}


.section {
    max-width: 1400px;
    margin: 0 auto;
}

.search-section {
    background: white;
    padding: 2rem;
    border-radius: 16px;
    margin-bottom: 2.5rem;
    box-shadow: 0 4px 20px rgba(74, 85, 104, 0.06);
    border: 1px solid var(--folder-border);
}

.cajas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 2rem;
    padding: 1.5rem;
}

/* Estilo de carpeta realista */
.folder-card {
    position: relative;
    background: var(--folder-color);
    border-radius: 8px;
    min-height: 220px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(235, 233, 233, 0.05);
}

/* Pestaña superior de la carpeta */
.folder-card::before {
    content: '';
    position: absolute;
    top: -12px;
    left: 20px;
    width: 100px;
    height: 24px;
    border-bottom: none;
    border-radius: 6px 6px 0 0;
    z-index: 1;
}

/* Efecto de profundidad lateral */
.folder-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        var(--folder-shadow) 0%,
        transparent 1%,
        transparent 99%,
        var(--folder-shadow) 100%
    );
    border-radius: 8px;
    z-index: 0;
    pointer-events: none;
}

.folder-card:hover {
    transform: translateY(-3px);
    box-shadow: 
        0 8px 24px rgba(0, 0, 0, 0.1),
        0 2px 4px rgba(0, 0, 0, 0.05);
}

.folder-content {
    position: relative;
    padding: 1.5rem;
    background: var(--folder-color);
    border-radius: 8px;
    z-index: 2;
    height: 100%;
}

.folder-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid rgb(43, 45, 48);
}

.folder-number {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
    font-family: 'Arial', sans-serif;
}

.folder-period {
    margin-left: auto;
    background: #fcf6f6;
    color: rgb(0, 0, 0);
    padding: 0.4rem 1rem;
    border-radius: 6px;
    font-size: 0.9rem;
    font-weight: 500;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.folder-info {
    display: grid;
    gap: 1.2rem;
    margin-top: 1.5rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.5rem;
    
    border-radius: 8px;
    transition: all 0.2s ease;
}

.info-item:hover {
    background: #E2E8F0;
}

.info-label {
    font-size: 0.9rem;
    color: var(--accent-color);
    font-weight: 500;
    min-width: 120px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-value {
    color: var(--text-color);
    font-size: 0.95rem;
    font-weight: 500;
}

.folder-actions {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    display: flex;
    gap: 0.8rem;
}

.btn-action {
    border: none;
    background: rgb(114, 5, 5);
    color: var(--primary-color);
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(136, 125, 125, 0.05);
}

.btn-action:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}
/* Container for search and per-page selector */
.controls-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(74, 85, 104, 0.06);
    border: 1px solid var(--folder-border);
}

/* Enhanced search container */
.search-container {
    flex-grow: 1;
    max-width: 500px;
    position: relative;
}

.search-input {
    width: 100%;
    padding: 0.875rem 1.25rem 0.875rem 3rem;
    border: 2px solid #E2E8F0;
    border-radius: 10px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    background-color: #F8FAFC;
    color: #1A202C;
}

.search-input:focus {
    background-color: white;
    border-color: #800020;
    outline: none;
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
}

.search-input::placeholder {
    color: #A0AEC0;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #800020;
    font-size: 1.1rem;
}

/* Per page selector styling */
.per-page-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.5rem 0;
}

.per-page-container label {
    font-size: 0.95rem;
    color: #4A5568;
    font-weight: 500;
}

.per-page-select {
    padding: 0.5rem 2.5rem 0.5rem 1rem;
    border: 2px solid #E2E8F0;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #1A202C;
    background-color: #F8FAFC;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%23800020' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.5rem center;
    background-size: 1.5em;
}

.per-page-select:focus {
    outline: none;
    border-color: #800020;
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
}

.per-page-select:hover {
    border-color: #800020;
}

.results-text {
    color: #718096;
    font-size: 0.95rem;
}

/* Nuevo diseño del encabezado y búsqueda */
.section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        padding: 1rem 1.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(74, 85, 104, 0.06);
        border: 1px solid #b9b9b3;
    }

    .page__heading {
        color: var(--header-color);
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 2.5rem;
        position: relative;
        padding-bottom: 1rem;
        letter-spacing: -0.5px;
        text-shadow: 2px 2px 4px rgba(155, 40, 71, 0.1);
    }

    .page__heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100px;
        height: 6px;
        background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
        border-radius: 3px;
        box-shadow: 0 2px 4px rgba(155, 40, 71, 0.2);
    }
/* Container for search and per-page selector */
.controls-container {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(74, 85, 104, 0.06);
    border: 1px solid var(--folder-border);
}

/* Enhanced search container */
.search-container {
    flex-grow: 1;
    max-width: 500px;
    position: relative;
}

.search-input {
    width: 100%;
    padding: 0.875rem 1.25rem 0.875rem 3rem;
    border: 2px solid #E2E8F0;
    border-radius: 10px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    background-color: #F8FAFC;
    color: #1A202C;
}

.search-input:focus {
    background-color: white;
    border-color: #800020;
    outline: none;
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
}

.search-input::placeholder {
    color: #A0AEC0;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #800020;
    font-size: 1.1rem;
}

/* Per page selector styling */
.per-page-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.5rem 0;
}

.per-page-container label {
    font-size: 0.95rem;
    color: #4A5568;
    font-weight: 500;
}

.per-page-select {
    padding: 0.5rem 2.5rem 0.5rem 1rem;
    border: 2px solid #E2E8F0;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #1A202C;
    background-color: #F8FAFC;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%23800020' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.5rem center;
    background-size: 1.5em;
}

.per-page-select:focus {
    outline: none;
    border-color: #800020;
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
}

.per-page-select:hover {
    border-color: #800020;
}

.results-text {
    color: #718096;
    font-size: 0.95rem;
}




.page__heading::after {
    content: '';
    display: block;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #F5F3E7, #800020); /* Color guinda */
    border-radius: 2px;
    margin-top: 5px;
}


.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
    padding: 1rem 1.5rem;
    background: rgb(2, 2, 2);
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(25, 58, 116, 0.06);
    border: 1px solid var(--folder-border);
}




</style>

@section('content')
<div class="main-container" >
    <section class="section">
        <div class="d-flex align-items-center">
            <h3 class="page__heading">Cajas</h3>
        </div>

        <div class="controls-container">

            
        @can('crear-caja')
            <div class="d-flex align-items-center">
                <a class="btn btn-new" href="{{ route('cajas.create') }}"
                   style="background: #800020; color: white; font-weight: bold; text-decoration: none;">
                    <i class="fas fa-plus"></i>
                    <span>Nueva Caja</span>
                </a>
            </div>
            @endcan
        
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchInput" class="search-input" placeholder="Buscar cajas...">
            
        </div>
        

       
        <form method="GET" action="{{ route('cajas.index') }}" class="mb-3">
            <label for="perPage">Mostrar:</label>
            <select name="per_page" id="perPage" onchange="this.form.submit()">
                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
            </select> resultados por página
        </form>
    </div>

        <div class="cajas-grid" style="background: #E2E8F0">
            @foreach ($cajas as $caja)
            <div class="folder-card" data-id="{{ $caja->id }}">
                <div class="folder-content">
                    <div class="folder-header">
                        <div class="folder-number">CAJA {{ $caja->numero_caja }} - {{ $caja->anio }}</div>
                        <div class="folder-period">{{ $caja->mes }} {{ $caja->anio }}</div>
                    </div>
                    

                    <div class="folder-info">
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-map-marker-alt me-2"></i>Ubicación
                            </span>
                            <span class="info-value">{{ $caja->ubicacion }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-sort-alpha-down me-2"></i>Rango
                            </span>
                            <span class="info-value">{{ $caja->rango_alfabetico }}</span>
                        </div>
                    </div>

                    <div class="folder-actions">
                        <!-- Botón "Ver detalles" protegido con permiso -->
                        @can('ver-cajas')
                        <a href="{{ route('cajas.show', $caja->id) }}" class="btn-action" title="Ver documentos de la caja">
                            <i class="fas fa-eye"></i>
                        </a>
                        @endcan

                        <!-- Botón "Editar" protegido con permiso -->
                        @can('editar-caja')
                        <a href="{{ route('cajas.edit', $caja->id) }}" class="btn-action" title="Editar detalles de la caja">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan

                        <!-- Botón "Eliminar" protegido con permiso -->
                        @can('eliminar-caja')
                        <form id="eliminar-form-{{ $caja->id }}" action="{{ route('cajas.destroy', $caja->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-action" title="Eliminar la caja" onclick="confirmarEliminacion({{ $caja->id }})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endcan
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>

       

        <div class="pagination justify-content-end mt-4">
            {!! $cajas->links() !!}
        </div>
    </section>
</div>

<script>
  document.getElementById('searchInput').addEventListener('keyup', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const folders = document.querySelectorAll('.folder-card');

        folders.forEach(folder => {
            const content = folder.textContent.toLowerCase();
            if (content.includes(searchTerm)) {
                folder.style.display = '';
            } else {
                folder.style.display = 'none';
            }
        });
    });

    

    function confirmarEliminacion(evaluadoId) {
        Swal.fire({
            title: '<strong>¡ADVERTENCIA!</strong>'
            , html: '<p style="font-size: 1.2rem; color: #d9534f; font-weight: bold;">Estás a punto de BORRAR permanentemente este evaluado. Esta acción no se puede deshacer.</p>'
            , icon: 'error'
            , showCancelButton: true
            , confirmButtonColor: '#d9534f'
            , cancelButtonColor: '#6c757d'
            , confirmButtonText: '<span style="font-size: 1.1rem;">Sí, BORRAR</span>'
            , cancelButtonText: '<span style="font-size: 1rem;">Cancelar</span>'
            , customClass: {
                popup: 'animated shake'
                , title: 'swal-title-large'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar la segunda confirmación
                Swal.fire({
                    title: '<strong>¿Estás completamente seguro?</strong>'
                    , html: '<p style="font-size: 1.1rem;">Esta es tu última oportunidad para cancelar.</p>'
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#d9534f'
                    , cancelButtonColor: '#6c757d'
                    , confirmButtonText: '<span style="font-size: 1.1rem;">Sí, estoy seguro</span>'
                    , cancelButtonText: '<span style="font-size: 1rem;">Cancelar</span>'
                    , customClass: {
                        popup: 'animated shake'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('eliminar-form-' + evaluadoId).submit();
                    }
                });
            }
        });
    }
</script>
@endsection