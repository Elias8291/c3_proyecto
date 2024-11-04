@extends('layouts.app')
<style>
  :root {
    --primary-color: #4A5568;
    --secondary-color: #EDF2F7;
    --folder-color: #F5F3E7; /* Color de cartón */
    --folder-tab: #D9D3C3; /* Tono ligeramente más oscuro para la pestaña */
    --folder-shadow: rgba(0, 0, 0, 0.05);
    --text-color: #2D3748;
    --accent-color: #718096;
    --folder-border: #C5BBA4; /* Bordes más tenues */
}

body {
    background-color: #F7FAFC;
    color: var(--text-color);
}

.main-container {
    padding: 2rem;
    background: linear-gradient(135deg, #ECE4EC 0%, #F7EAEF 100%); /* Fondo suave que combina con guinda */
    min-height: 100vh;
    position: relative;
    overflow: hidden;
}

.main-container::before,
.main-container::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    background-color: rgba(123, 42, 59, 0.1); /* Suave guinda translúcido */
    z-index: 0;
}

.main-container::before {
    width: 250px;
    height: 250px;
    top: -50px;
    left: -50px;
}

.main-container::after {
    width: 200px;
    height: 200px;
    bottom: 50px;
    right: 50px;
}

/* Añadir más figuras geométricas */
.main-container::after,
.main-container::before,
.main-container .figure {
    background: rgba(123, 42, 59, 0.05); /* Suave guinda translúcido */
    border-radius: 50%;
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
    border: 1px solid var(--folder-border);
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
    border-bottom: 2px solid var(--folder-border);
}

.folder-number {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
    font-family: 'Arial', sans-serif;
}

.folder-period {
    margin-left: auto;
    background: #6e6d6e;
    color: white;
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
    background: var(--secondary-color);
    color: var(--primary-color);
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.btn-action:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

.search-container {
    position: relative;
    max-width: 400px;
}

.search-input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid var(--folder-border);
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s;
}

.search-input:focus {
    border-color: var(--primary-color);
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
}

.new-folder-btn {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    width: 56px;
    height: 56px;
    border-radius: 12px;
    background: var(--primary-color);
    color: white;
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}

.new-folder-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
}

.page__heading {
    color: var(--primary-color);
    font-size: 2rem;
    margin-bottom: 2rem;
    font-weight: 600;
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
    border: 1px solid var(--folder-border);
}

.page__heading {
    color: var(--primary-color);
    font-size: 1.75rem;
    margin: 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.page__heading i {
    color: var(--accent-color);
    font-size: 1.5rem;
}

.search-container {
    position: relative;
    width: 300px;
}

.search-input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid var(--folder-border);
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s;
    background-color: #F9FAFB;
}

.search-icon {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--accent-color);
    font-size: 0.9rem;
}

.search-input:focus {
    background-color: white;
    border-color: var(--primary-color);
    outline: none;
    box-shadow: 0 0 0 3px rgba(74, 85, 104, 0.1);
}

.search-input::placeholder {
    color: #A0AEC0;
    font-size: 0.9rem;
}

/* Eliminar la search-section anterior */
.search-section {
    display: none;
}

</style>

@section('content')
<div class="main-container">
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">
                <i class="fas fa-archive"></i>
                Cajas
            </h3>
        </div>

        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchInput" class="search-input" placeholder="Buscar cajas...">
        </div>

        <div class="cajas-grid">
            @foreach ($cajas as $caja)
            <div class="folder-card" data-id="{{ $caja->id }}">
                <div class="folder-content">
                    <div class="folder-header">
                        <div class="folder-number">Caja #{{ $caja->numero_caja }}</div>
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
                        <a href="{{ route('cajas.show', $caja->id) }}" class="btn-action" title="Ver documentos">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('cajas.edit', $caja->id) }}" class="btn-action">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn-action" onclick="confirmarEliminacion({{ $caja->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button class="new-folder-btn" onclick="window.location.href='{{ route('cajas.create') }}'">
            <i class="fas fa-plus fa-lg"></i>
        </button>

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

    function confirmarEliminacion(cajaId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#800020',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/cajas/${cajaId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        document.querySelector(`.folder-card[data-id="${cajaId}"]`).remove();
                        Swal.fire('Eliminado', 'La caja ha sido eliminada.', 'success');
                    } else {
                        Swal.fire('Error', 'No se pudo eliminar la caja. Intenta de nuevo.', 'error');
                    }
                })
                .catch(() => {
                    Swal.fire('Error', 'Ocurrió un error al eliminar la caja.', 'error');
                });
            }
        });
    }
</script>
@endsection
