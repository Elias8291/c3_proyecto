@extends('layouts.app')

<style>
    :root {
        --primary-color: #8B1F41;     /* Guinda/Burdeos principal */
        --secondary-color: #4A0404;    /* Guinda oscuro */
        --accent-color: #D4A5A5;       /* Rosa suave complementario */
        --background-color: #FAF6F6;   /* Fondo claro con un toque cálido */
        --border-color: #E9E2E2;       /* Borde suave */
        --hover-color: #F8E6E6;        /* Color hover suave */
        --text-primary: #2D2424;       /* Texto principal */
        --text-secondary: #6B5656;     /* Texto secundario */
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
    color: #D4A5A5; /* Rosa suave complementario */
}
.btn-action i.fa-eye:hover {
    background: #F8E6E6; /* Hover suave */
    color: #8B1F41; /* Guinda */
}

/* Estilo para el botón de "Editar" */
.btn-action i.fa-edit {
    color: #8B1F41; /* Guinda */
}
.btn-action i.fa-edit:hover {
    background: #F8E6E6; /* Hover suave */
    color: #4A0404; /* Guinda oscuro */
}

/* Estilo para el botón de "Eliminar" */
.btn-action i.fa-trash {
    color: #4A0404; /* Guinda oscuro */
}
.btn-action i.fa-trash:hover {
    background: #D4A5A5; /* Rosa suave */
    color: #FAF6F6; /* Blanco claro */
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
                    </div>
                </div>

                <div class="folder-actions">
                    <a href="{{ route('carpetas.show', $carpeta->id) }}" class="btn-action" title="Ver detalles">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('carpetas.edit', $carpeta->id) }}" class="btn-action" title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form id="eliminar-form-{{ $carpeta->id }}" action="{{ route('carpetas.destroy', $carpeta->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-action" title="Eliminar" onclick="confirmarEliminacion({{ $carpeta->id }})">
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