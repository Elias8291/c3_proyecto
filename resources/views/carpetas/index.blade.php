@extends('layouts.app')

<style>
:root {
    --primary-color: #8B1F41;
    --primary-dark: #4A0404;
    --primary-light: #D4A5A5;
    --background-light: #FAF6F6;
    --gray-100: #F8F9FA;
    --gray-200: #E9ECEF;
    --gray-300: #DEE2E6;
    --gray-400: #CED4DA;
    --gray-500: #ADB5BD;
    --gray-600: #6C757D;
    --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px rgba(139, 31, 65, 0.1);
}

.main-container {
    background: linear-gradient(135deg, var(--background-light) 0%, #FFFFFF 100%);
    min-height: 100vh;
    padding: 3rem;
    position: relative;
}

.section-header {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--gray-200);
}

.page__heading {
    font-size: 2rem;
    font-weight: 700;
    color: back;
    margin-bottom: 0;
    position: relative;
    padding-bottom: 1rem;
}

.page__heading::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100px;
    height: 4px;
    background: linear-gradient(to right, var(--primary-color), var(--primary-light));
    border-radius: 2px;
}

.search-container {
    position: relative;
    width: 400px;
}

.search-input {
    width: 100%;
    padding: 1rem 1.5rem 1rem 3rem;
    border-radius: 15px;
    border: 2px solid var(--gray-200);
    background-color: var(--gray-100);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: var(--primary-color);
    background-color: white;
    box-shadow: 0 0 0 4px rgba(139, 31, 65, 0.1);
}

.folder-item {
    background: white;
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.25rem;
    border: 1px solid var(--gray-200);
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
}

.folder-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: linear-gradient(to bottom, var(--primary-color), var(--primary-light));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.folder-item:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary-light);
}

.folder-item:hover::before {
    opacity: 1;
}

.folder-icon {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    padding: 1.25rem;
    border-radius: 15px;
    font-size: 1.75rem;
    box-shadow: var(--shadow-sm);
}

.folder-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--primary-dark);
    margin-bottom: 0.75rem;
}

.folder-info {
    gap: 2.5rem;
}

.info-group {
    padding: 0.5rem 0;
}

.info-group i {
    color: var(--primary-color);
    font-size: 1.1rem;
}

.btn-action {
    padding: 0.75rem;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.btn-action i {
    font-size: 1.2rem;
}

.btn-action:hover {
    background: var(--gray-100);
    transform: translateY(-2px);
}

.new-folder-btn {
    width: 4.5rem;
    height: 4.5rem;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    box-shadow: 0 4px 15px rgba(139, 31, 65, 0.3);
    font-size: 1.75rem;
}

.new-folder-btn:hover {
    transform: translateY(-4px) rotate(90deg);
    box-shadow: 0 6px 20px rgba(139, 31, 65, 0.4);
}

/* Decorative elements */
.main-container::before,
.main-container::after {
    content: '';
    position: fixed;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(139, 31, 65, 0.05) 0%, rgba(212, 165, 165, 0.05) 100%);
}

.main-container::before {
    width: 300px;
    height: 300px;
    top: -100px;
    left: -100px;
}

.main-container::after {
    width: 250px;
    height: 250px;
    bottom: -50px;
    right: -50px;
}

@media (max-width: 768px) {
    .main-container {
        padding: 1.5rem;
    }

    .section-header {
        padding: 1.5rem;
    }

    .search-container {
        width: 100%;
    }

    .folder-info {
        gap: 1.5rem;
    }
}

:root {
    --primary-color: #8B1F41;
    /* Guinda/Burdeos principal */
    --secondary-color: #4A0404;
    /* Guinda oscuro */
    --accent-color: #D4A5A5;
    /* Rosa suave complementario */
    --background-color: #FAF6F6;
    /* Fondo claro con un toque cálido */
    --border-color: #E9E2E2;
    /* Borde suave */
    --hover-color: #F8E6E6;
    /* Color hover suave */
    --text-primary: #2D2424;
    /* Texto principal */
    --text-secondary: #6B5656;
    /* Texto secundario */
}

.main-container {
    padding: 2.5rem;
    background: var(--background-color);
    min-height: 100vh;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 1.5rem 2rem 1.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid var(--accent-color);
}

.page__heading {
    color: var(--primary-color);
    font-size: 1.75rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.search-container {
    position: relative;
    width: 320px;
}

.search-input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.75rem;
    border-radius: 12px;
    border: 2px solid var(--border-color);
    background-color: white;
    font-size: 0.925rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(139, 31, 65, 0.1);
    outline: none;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-color);
}

.folder-item {
    background: linear-gradient(135deg, #fffdfd, #fae6e6);
    border-radius: 20px;
    padding: 1.5rem;
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    border: 1px solid transparent;
    transition: all 0.4s ease-in-out;
    box-shadow: 0 4px 12px rgba(139, 31, 65, 0.1);
    position: relative;
    overflow: hidden;
}

.folder-item:hover {
    transform: translateY(-5px);
    background: linear-gradient(135deg, #ffffff, #fcdede);
    box-shadow: 0 8px 20px rgba(139, 31, 65, 0.2);
    border: 2px solid #d4a5a5;
}

.folder-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 8px;
    height: 100%;
    background: linear-gradient(to bottom, #800020, #d4a5a5);
    border-radius: 10px;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.folder-item:hover::before {
    opacity: 1;
}

.folder-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #800020, #4a0404);
    color: white;
    font-size: 2rem;
    box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.2), 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.4s ease;
}

.folder-icon:hover {
    transform: scale(1.2);
    background: linear-gradient(135deg, #4a0404, #800020);
}

.folder-details {
    display: grid;
    gap: 0.75rem;
}

.folder-title {
    font-weight: 700;
    color: #800020;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: color 0.4s ease;
}

.folder-title:hover {
    color: #4a0404;
}

.folder-info {
    display: flex;
    gap: 1.5rem;
    color: #6b5656;
    font-size: 0.95rem;
}

.info-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0;
}

.info-group i {
    color: #800020;
    font-size: 1rem;
}

.folder-actions {
    display: flex;
    gap: 0.75rem;
}

.btn-action {
    padding: 0.75rem;
    border-radius: 50%;
    background: #f8e6e6;
    border: 2px solid transparent;
    color: #6b5656;
    transition: all 0.4s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.btn-action:hover {
    background: #ffe6e6;
    border-color: #800020;
    color: #800020;
    transform: scale(1.2);
}
.folder-item {
    background: linear-gradient(135deg, #fffdfd, #fae6e6);
    border-radius: 20px;
    padding: 1.5rem;
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    border: 1px solid transparent;
    transition: all 0.4s ease-in-out;
    box-shadow: 0 4px 12px rgba(139, 31, 65, 0.1);
    position: relative;
    overflow: hidden;
}

.folder-item:hover {
    transform: translateY(-5px);
    background: linear-gradient(135deg, #ffffff, #fcdede);
    box-shadow: 0 8px 20px rgba(139, 31, 65, 0.2);
    border: 2px solid #d4a5a5;
}

.folder-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 8px;
    height: 100%;
    background: linear-gradient(to bottom, #800020, #d4a5a5);
    border-radius: 10px;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.folder-item:hover::before {
    opacity: 1;
}

.folder-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #800020, #4a0404);
    color: white;
    font-size: 2rem;
    box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.2), 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.4s ease;
}

.folder-icon:hover {
    transform: scale(1.2);
    background: linear-gradient(135deg, #4a0404, #800020);
}

.folder-details {
    display: grid;
    gap: 0.75rem;
}

.folder-title {
    font-weight: 700;
    color: #800020;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: color 0.4s ease;
}

.folder-title:hover {
    color: #4a0404;
}

.folder-info {
    display: flex;
    gap: 1.5rem;
    color: #6b5656;
    font-size: 0.95rem;
}

.info-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0;
}

.info-group i {
    color: #800020;
    font-size: 1rem;
}

.folder-actions {
    display: flex;
    gap: 0.75rem;
}

.btn-action {
    padding: 0.75rem;
    border-radius: 50%;
    background: #f8e6e6;
    border: 2px solid transparent;
    color: #6b5656;
    transition: all 0.4s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.btn-action:hover {
    background: #ffe6e6;
    border-color: #800020;
    color: #800020;
    transform: scale(1.2);
}


/* Estilo para el botón de "Ver" */
.btn-action i.fa-eye {
    color: #D4A5A5;
    /* Rosa suave complementario */
}

.btn-action i.fa-eye:hover {
    background: #F8E6E6;
    /* Hover suave */
    color: #8B1F41;
    /* Guinda */
}

/* Estilo para el botón de "Editar" */
.btn-action i.fa-edit {
    color: #8B1F41;
    /* Guinda */
}

.btn-action i.fa-edit:hover {
    background: #F8E6E6;
    /* Hover suave */
    color: #4A0404;
    /* Guinda oscuro */
}

/* Estilo para el botón de "Eliminar" */
.btn-action i.fa-trash {
    color: #4A0404;
    /* Guinda oscuro */
}

.btn-action i.fa-trash:hover {
    background: #D4A5A5;
    /* Rosa suave */
    color: #FAF6F6;
    /* Blanco claro */
}

.page__heading {
    color: #ffffff;
    font-weight: 800;
    font-size: 2.5rem;
    margin: 0 0 1.8rem;
    position: relative;
    display: inline-block;
    padding-bottom: 1rem;
}

.page__heading::after {
    content: '';
    display: block;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #F5F3E7, #800020);
    /* Color guinda */
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


.main-container {
    padding: 2.5rem;
    background: var(--background-color);
    min-height: 100vh;
    position: relative;
    overflow: hidden;
}

.main-container::before,
.main-container::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    background-color: rgba(139, 31, 65, 0.05);
    /* Suave guinda translúcido */
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

/* Opcional: añadir más figuras decorativas */
.figure-1 {
    position: absolute;
    width: 150px;
    height: 150px;
    top: 20%;
    left: 10%;
    background: rgba(139, 31, 65, 0.05);
    border-radius: 50%;
    z-index: 0;
}

.figure-2 {
    position: absolute;
    width: 100px;
    height: 100px;
    bottom: 20%;
    right: 15%;
    background: rgba(139, 31, 65, 0.05);
    border-radius: 50%;
    z-index: 0;
}


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

/* Tamaño de Fuente para Inputs y Selects */
input[type="text"],
select,
textarea {
    font-size: 20px !important;
}
</style>

@section('content')
<div class="main-container" style="background: transparent">
    <section class="section">
        <div class="d-flex align-items-center">
            <h3 class="page__heading">Carpetas</h3>
        </div>

        <div class="controls-container">
            <div class="d-flex align-items-center">
                @can('crear-carpeta')
                <a class="btn btn-new" href="{{ route('carpetas.create') }}"
                    style="background: #800020; color: white; font-weight: bold; text-decoration: none;">
                    <i class="fas fa-plus"></i>
                    <span>Nueva Carpeta</span>
                </a>
                @endcan

            </div>
            <div class="search-section"  style="background: transparent">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Buscar cajas...">
                </div>
            </div>
        </div>


        <div class="folders-list"  style="background: transparent">
            @foreach($carpetas as $carpeta)
            <div class="folder-item" data-search-content>
                <i class="fas fa-folder folder-icon"></i>

                <div class="folder-details">
                    <div class="folder-title">
                        Carpeta #{{ $carpeta->id }}
                    </div>
                    <div class="folder-info">
                        <div class="info-group">
                            <i class="fas fa-user"></i>
                            <span>
                                {{ $carpeta->evaluado ?
                                $carpeta->evaluado->primer_nombre . ' ' .
                                 $carpeta->evaluado->segundo_nombre . ' ' .
                                $carpeta->evaluado->primer_apellido : 'No asignado'
                                
                                }}
                            </span>
                        </div>
                        <div class="info-group">
                            <i class="fas fa-archive"></i>
                            <span>
                                {{ $carpeta->caja ? 'Caja #' . $carpeta->caja->numero_caja : 'No asignada' }}
                            </span>
                        </div>

                        <div class="info-group">
                            <i class="fas fa-archive"></i>
                            <span>
                                {{ $carpeta->caja ? 'Año:' . $carpeta->caja->anio : 'No asignada' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="folder-actions" title="Acciones de carpeta">
                    <!-- Permiso para ver detalles de la carpeta -->
                    @can('ver-carpetas')
                    <a href="{{ route('carpetas.show', $carpeta->id) }}" class="btn-action"
                        title="Ver detalles de la carpeta">
                        <i class="fas fa-eye"></i>
                    </a>
                    @endcan

                    <!-- Permiso para editar la carpeta -->
                    @can('editar-carpeta')
                    <a href="{{ route('carpetas.edit', $carpeta->id) }}" class="btn-action" title="Editar esta carpeta">
                        <i class="fas fa-edit"></i>
                    </a>
                    @endcan

                    <!-- Permiso para eliminar la carpeta -->
                    @can('eliminar-carpeta')
                    <form id="eliminar-form-{{ $carpeta->id }}" action="{{ route('carpetas.destroy', $carpeta->id) }}"
                        method="POST" style="display:inline;" title="Eliminar carpeta">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-action" title="Eliminar permanentemente esta carpeta"
                            onclick="confirmarEliminacion({{ $carpeta->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endcan
                </div>


            </div>
            @endforeach
        </div>
    </section>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    document.querySelectorAll('.folder-item').forEach(folder => {
        const content = folder.textContent.toLowerCase();
        folder.style.display = content.includes(searchTerm) ? '' : 'none';
    });
});

function confirmarEliminacion(evaluadoId) {
    Swal.fire({
        title: '<strong>¡ADVERTENCIA!</strong>',
        html: '<p style="font-size: 1.2rem; color: #d9534f; font-weight: bold;">Estás a punto de BORRAR permanentemente este evaluado. Esta acción no se puede deshacer.</p>',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#d9534f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<span style="font-size: 1.1rem;">Sí, BORRAR</span>',
        cancelButtonText: '<span style="font-size: 1rem;">Cancelar</span>',
        customClass: {
            popup: 'animated shake',
            title: 'swal-title-large'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Mostrar la segunda confirmación
            Swal.fire({
                title: '<strong>¿Estás completamente seguro?</strong>',
                html: '<p style="font-size: 1.1rem;">Esta es tu última oportunidad para cancelar.</p>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<span style="font-size: 1.1rem;">Sí, estoy seguro</span>',
                cancelButtonText: '<span style="font-size: 1rem;">Cancelar</span>',
                customClass: {
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