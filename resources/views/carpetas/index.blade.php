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
    color: var(--primary-color);
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
} :root {
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

    .folders-list {
        display: grid;
        gap: 1rem;
        padding: 0.5rem;
    }

    .folder-item {
        background: white;
        border-radius: 16px;
        padding: 1.25rem;
        display: grid;
        grid-template-columns: auto 1fr auto;
        align-items: center;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    .folder-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(139, 31, 65, 0.08);
        border-color: var(--primary-color);
    }

    .folder-icon {
        color: var(--primary-color);
        font-size: 1.5rem;
        margin-right: 1.25rem;
        background: var(--hover-color);
        padding: 1rem;
        border-radius: 12px;
    }

    .folder-details {
        display: grid;
        gap: 0.5rem;
    }

    .folder-title {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .folder-info {
        display: flex;
        gap: 2rem;
        color: var(--text-secondary);
        font-size: 0.925rem;
    }

    .info-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.25rem 0;
    }

    .info-group i {
        color: var(--primary-color);
    }

    .folder-actions {
        display: flex;
        gap: 0.75rem;
    }

    .btn-action {
        padding: 0.625rem;
        border-radius: 10px;
        background: transparent;
        border: none;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        background: var(--hover-color);
        color: var(--primary-color);
        transform: scale(1.05);
    }

    .new-folder-btn {
        position: fixed;
        bottom: 2.5rem;
        right: 2.5rem;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(139, 31, 65, 0.25);
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .new-folder-btn:hover {
        transform: translateY(-3px) rotate(90deg);
        box-shadow: 0 6px 16px rgba(139, 31, 65, 0.35);
        background: var(--secondary-color);
    }

    @media (max-width: 768px) {
        .main-container {
            padding: 1.5rem;
        }

        .section-header {
            flex-direction: column;
            gap: 1.25rem;
            padding: 0 1rem 1.5rem 1rem;
        }

        .search-container {
            width: 100%;
        }

        .folder-item {
            grid-template-columns: 1fr auto;
            gap: 1.25rem;
            padding: 1rem;
        }

        .folder-icon {
            display: none;
        }

        .folder-info {
            flex-direction: column;
            gap: 0.75rem;
        }

        .folder-actions {
            gap: 0.5rem;
        }
    }

    .btn-action {
        padding: 0.625rem;
        border-radius: 10px;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
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
        color: #8B1F41;
        /* Guinda */
        font-size: 1.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 0;
        padding-bottom: 10px;
        position: relative;
    }

    .page__heading::after {
        content: '';
        display: block;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #D4A5A5, #8B1F41);
        /* Gradiente de rosa a guinda */
        border-radius: 2px;
        margin-top: 5px;
        position: absolute;
        bottom: 0;
        left: 0;
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

    /* Tamaño de Fuente para Inputs y Selects */
    input[type="text"],
    select,
    textarea {
        font-size: 20px !important;
    }
</style>

@section('content')
<div class="main-container">
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">
                <i class="fas fa-folder"></i>
                Gestión de Carpetas
            </h3>
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Buscar carpetas...">
            </div>
        </div>

        <div class="folders-list">
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
                    <a href="{{ route('carpetas.show', $carpeta->id) }}" class="btn-action" title="Ver detalles de la carpeta">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('carpetas.edit', $carpeta->id) }}" class="btn-action" title="Editar esta carpeta">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form id="eliminar-form-{{ $carpeta->id }}" action="{{ route('carpetas.destroy', $carpeta->id) }}"
                          method="POST" style="display:inline;" title="Eliminar carpeta">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-action" title="Eliminar permanentemente esta carpeta"
                                onclick="confirmarEliminacion({{ $carpeta->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                
            </div>
            @endforeach
        </div>

        <button class="new-folder-btn" onclick="window.location.href='{{ route('carpetas.create') }}'">
            <i class="fas fa-plus"></i>
        </button>
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

    function confirmarEliminacion(carpetaId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8B1F41',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('eliminar-form-' + carpetaId).submit();
            }
        });
    }
</script>
@endsection