@extends('layouts.app')

@section('content')
    <div class="dashboard-container">
        <!-- Título y Búsqueda -->
        <div class="header-top">
            <div class="d-flex align-items-center">
                <h3 class="page__heading">  <p> Listas de Préstamos</p></h3>
            </div>
            <div class="search-section">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Buscar préstamo...">
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
               
            </div>
        </div>



        <!-- Filtros -->
        <div class="filters-section">
            <form action="{{ route('prestamos.index') }}" method="GET" id="filterForm">
                <input type="hidden" name="estado" id="estadoInput" value="{{ $estado ?? 'Todos' }}">
                <button type="button" class="filter-btn {{ $estado === 'Todos' || !$estado ? 'active' : '' }}"
                    onclick="applyFilter('Todos')">Todos</button>
                <button type="button" class="filter-btn {{ $estado === 'Pendiente' ? 'active' : '' }}"
                    onclick="applyFilter('Pendiente')">Pendientes</button>
                <button type="button" class="filter-btn {{ $estado === 'Aprobado' ? 'active' : '' }}"
                    onclick="applyFilter('Aprobado')">Prestados</button>
                <button type="button" class="filter-btn {{ $estado === 'Devuelto' ? 'active' : '' }}"
                    onclick="applyFilter('Devuelto')">Devueltos</button>
                <button type="button" class="filter-btn {{ $estado === 'Rechazado' ? 'active' : '' }}"
                    onclick="applyFilter('Rechazado')">Rechazados</button>
            </form>
        </div>

        <!-- Lista de Préstamos -->
        <div class="loans-grid">
            @foreach ($prestamos as $prestamo)
                <div class="loan-card">
                    <div class="loan-header">
                        <div class="loan-id">
                            <span class="id-label">Préstamo ID</span>
                            <span class="id-value">#{{ $prestamo->id }}</span>
                        </div>

                    </div>

                    <div class="loan-body">
                        <div class="info-row">
                            <i class="fas fa-user"></i>
                            <div>
                                <label>Solicitante</label>
                                <span>{{ $prestamo->usuario->name }}</span>
                            </div>
                        </div>
                        <div class="info-row">
                            <i class="fas fa-file-alt"></i>
                            <div>
                                <label>Documento</label>
                                <span>{{ $prestamo->documento->evaluado->primer_nombre }}</span>
                            </div>
                        </div>
                        <div class="info-row">
                            <i class="fas fa-archive"></i>
                            <div>
                                <label>Caja</label>
                                <span>Caja #{{ $prestamo->documento->carpeta->caja->numero_caja }}</span>
                            </div>
                        </div>

                        <div class="info-row">
                            <i class="fas fa-archive"></i>
                            <div>
                                <label>Ubicación del Documento</label>
                                <span>Caja #{{ $prestamo->documento->carpeta->caja->numero_caja }} 
                                      ({{ $prestamo->documento->carpeta->caja->ubicacion }})
                                      <br>
                                      <small class="text-muted">
                                          {{ $prestamo->documento->carpeta->caja->mes }} {{ $prestamo->documento->carpeta->caja->anio }}
                                          @if($prestamo->documento->carpeta->caja->rango_alfabetico)
                                              | Rango: {{ $prestamo->documento->carpeta->caja->rango_alfabetico }}
                                          @endif
                                      </small>
                                </span>
                            </div>
                        </div>
                        <div class="info-row">
                            <i class="fas fa-calendar"></i>
                            <div>
                                <label>Fecha Solicitud</label>
                                <span>{{ \Carbon\Carbon::parse($prestamo->fecha_solicitud)->format('d M, Y') }}</span>
                            </div>
                        </div>

                    </div>
                    <div class="loan-actions">
                        <a href="javascript:void(0)" onclick="verDetalles({{ $prestamo->id }})" class="action-btn view">
                            <i class="fas fa-eye"></i> Ver Detalles
                        </a>
                        @if ($prestamo->estado === 'Pendiente')
                            <button onclick="aprobarPrestamo({{ $prestamo->id }})" class="action-btn approve">
                                <i class="fas fa-check"></i> Aprobar
                            </button>
                            <button onclick="cancelarPrestamo({{ $prestamo->id }})" class="action-btn cancel">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Modal de Detalles -->
        <div id="detallesModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="cerrarModalDetalles()">&times;</span>
                <h2>Detalles del Préstamo</h2>
                <div class="detalles-container">
                    <div class="detalles-section prestamo-info">
                        <h3><i class="fas fa-file-alt"></i> Información del Préstamo</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>ID Préstamo:</label>
                                <span id="prestamo-id"></span>
                            </div>
                            <div class="info-item">
                                <label>Solicitante:</label>
                                <span id="prestamo-solicitante"></span>
                            </div>
                            <div class="info-item">
                                <label>Estado:</label>
                                <span id="prestamo-estado"></span>
                            </div>
                            <div class="info-item">
                                <label>Fecha Solicitud:</label>
                                <span id="prestamo-fecha-solicitud"></span>
                            </div>
                            <div class="info-item">
                                <label>Fecha Aprobación:</label>
                                <span id="prestamo-fecha-aprobacion"></span>
                            </div>
                            <div class="info-item">
                                <label>Fecha Devolución:</label>
                                <span id="prestamo-fecha-devolucion"></span>
                            </div>
                        </div>
                    </div>
                    <div class="detalles-section documento-info">
                        <h3><i class="fas fa-book"></i> Información del Documento</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>Evaluado:</label>
                                <span id="documento-evaluado"></span>
                            </div>
                            <div class="info-item">
                                <label>Área:</label>
                                <span id="documento-area"></span>
                            </div>
                           
                            <div class="info-item">
                                <label>Número de Hojas:</label>
                                <span id="documento-hojas"></span>
                            </div>

                            <div class="info-item">
                                <label>Número de Caja:</label>
                                <span id="documento-caja"></span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Paginación -->
        <div class="pagination-container">
            @if ($prestamos->hasPages())
                <div class="pagination">
                    {{-- Botón Anterior --}}
                    @if ($prestamos->onFirstPage())
                        <span class="page-item disabled">
                            <span class="page-link">&laquo;</span>
                        </span>
                    @else
                        <a class="page-link" href="{{ $prestamos->previousPageUrl() }}" rel="prev">&laquo;</a>
                    @endif

                    {{-- Números de Página --}}
                    @foreach ($prestamos->getUrlRange(1, $prestamos->lastPage()) as $page => $url)
                        @if ($page == $prestamos->currentPage())
                            <span class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </span>
                        @else
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Botón Siguiente --}}
                    @if ($prestamos->hasMorePages())
                        <a class="page-link" href="{{ $prestamos->nextPageUrl() }}" rel="next">&raquo;</a>
                    @else
                        <span class="page-item disabled">
                            <span class="page-link">&raquo;</span>
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/dayjs.min.js"></script>
    <script>
        
        function applyFilter(estado) {
            document.getElementById('estadoInput').value = estado;
            document.getElementById('filterForm').submit();
        }

        function aprobarPrestamo(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas aprobar esta solicitud de préstamo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#800020',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, aprobar',
                cancelButtonText: 'No, mantener'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/prestamos/${id}/aprobar`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: data.message,
                                    timer: 1500,
                                    showConfirmButton: false,
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'Error al aprobar el préstamo'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un problema al aprobar el préstamo.'
                            });
                        });
                }
            });
        }

        function cancelarPrestamo(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas cancelar esta solicitud de préstamo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#800020',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'No, mantener'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/prestamos/${id}/cancelar`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: data.message,
                                    timer: 1500,
                                    showConfirmButton: false,
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'Error al cancelar el préstamo'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un problema al cancelar el préstamo.'
                            });
                        });
                }
            });
        }
        function verDetalles(prestamoId) {
    fetch(`/prestamos/${prestamoId}/detalles`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const formatearFecha = (fecha) => {
                    if (!fecha) return 'No disponible';
                    const f = new Date(fecha);
                    const opciones = {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    };
                    return f.toLocaleDateString('es-ES', opciones);
                };

                // Llenar datos del préstamo
                document.getElementById('prestamo-id').textContent = '#' + data.prestamo.id;
                document.getElementById('prestamo-solicitante').textContent = data.prestamo.usuario.name;
                document.getElementById('prestamo-estado').innerHTML = `<span class="estado-badge ${data.prestamo.estado.toLowerCase()}">${data.prestamo.estado}</span>`;
                document.getElementById('prestamo-fecha-solicitud').textContent = formatearFecha(data.prestamo.fecha_solicitud);
                document.getElementById('prestamo-fecha-aprobacion').textContent = formatearFecha(data.prestamo.fecha_aprobacion);
                document.getElementById('prestamo-fecha-devolucion').textContent = formatearFecha(data.prestamo.fecha_devolucion);

                // Llenar datos del documento
                document.getElementById('documento-evaluado').textContent = 
                    `${data.prestamo.documento.evaluado.primer_nombre} ${data.prestamo.documento.evaluado.apellido_paterno || ''}`;
                document.getElementById('documento-area').textContent = data.prestamo.documento.area.nombre_area;
                document.getElementById('documento-hojas').textContent = data.prestamo.documento.numero_hojas;
                document.getElementById('documento-caja').textContent = `Caja #${data.prestamo.documento.carpeta.caja.numero_caja}`;

                // Mostrar modal
                const modal = document.getElementById('detallesModal');
                modal.style.display = 'flex';
                // Forzar un reflow antes de agregar la clase show
                modal.offsetHeight;
                modal.classList.add('show');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar los detalles del préstamo'
            });
        });
}

function cerrarModalDetalles() {
    const modal = document.getElementById('detallesModal');
    modal.classList.remove('show');
    // Esperar a que termine la animación antes de ocultar
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

// Un solo event listener para el click fuera del modal
document.addEventListener('click', function(e) {
    const modal = document.getElementById('detallesModal');
    if (e.target === modal) {
        cerrarModalDetalles();
    }
});

// Un solo event listener para la tecla ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        cerrarModalDetalles();
    }
});

// Cerrar modal al hacer clic fuera
document.addEventListener('click', function(e) {
    const modal = document.getElementById('detallesModal');
    if (e.target === modal) {
        cerrarModalDetalles();
    }
});

// Cerrar modal con la tecla ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        cerrarModalDetalles();
    }
});
    </script>
    <style>
        .dashboard-container {
            padding: 25px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* Título y Búsqueda */
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .title-section h1 {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .subtitle {
            color: #616161;
            font-size: 1rem;
        }

        .search-section {
            display: flex;
            gap: 15px;
        }

        .search-container {
            position: relative;
            width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 12px 45px 12px 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .search-input:focus {
            border-color: #800020;
            box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
        }

        .search-button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: #800020;
            cursor: pointer;
        }

        .new-loan-btn {
            background: #800020;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .new-loan-btn:hover {
            background: #600018;
            transform: translateY(-2px);
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            display: flex;
            align-items: flex-start;
            gap: 20px;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            background: #f8f9fa;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-card.total .stat-icon {
            color: #800020;
            background: rgba(128, 0, 32, 0.1);
        }

        .stat-card.pending .stat-icon {
            color: #f59e0b;
            background: rgba(245, 158, 11, 0.1);
        }

        .stat-card.approved .stat-icon {
            color: #10b981;
            background: rgba(16, 185, 129, 0.1);
        }

        .stat-info {
            flex-grow: 1;
        }

        .stat-info h3 {
            color: #616161;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .stat-trend {
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-trend.positive {
            color: #10b981;
        }

        .stat-trend.neutral {
            color: #6b7280;
        }

        .stat-trend.waiting {
            color: #f59e0b;
        }

        /* Filters Section */
        .filters-section {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .filter-btn {
            padding: 10px 20px;
            border: 1px solid #800020;
            border-radius: 8px;
            color: #800020;
            background: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #800020;
            color: white;
        }

        /* Loans Grid */
        .loans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .loan-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .loan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .loan-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e0e0e0;
        }

        .loan-id {
            display: flex;
            flex-direction: column;
        }

        .id-label {
            font-size: 12px;
            color: #666;
        }

        .id-value {
            font-size: 18px;
            font-weight: 600;
            color: #800020;
        }

        .loan-status {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .loan-status.aprobado {
            background: #e6f9f1;
            color: #10b981;
        }

        .loan-status.pendiente {
            background: #fef3c7;
            color: #f59e0b;
        }

        .loan-status.cancelado {
            background: #fee2e2;
            color: #ef4444;
        }

        .loan-status i {
            font-size: 8px;
        }

        .loan-body {
            padding: 20px;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .info-row i {
            color: #800020;
            margin-top: 3px;
        }

        .info-row label {
            display: block;
            font-size: 12px;
            color: #666;
            margin-bottom: 2px;
        }

        .info-row span {
            display: block;
            color: #2c3e50;
            font-weight: 500;
        }

        .loan-actions {
            padding: 20px;
            display: flex;
            gap: 10px;
            border-top: 1px solid #e0e0e0;
        }

        .action-btn {
            flex: 1;
            padding: 8px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .action-btn.view {
            background: #f8f9fa;
            color: #800020;
        }

        .action-btn.approve {
            background: #e6f9f1;
            color: #10b981;
        }

        .action-btn.cancel {
            background: #fee2e2;
            color: #ef4444;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination {
            display: flex;
            gap: 5px;
        }

        .page-link {
            padding: 8px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            color: #800020;
            background: white;
            transition: all 0.3s ease;
        }

        .page-item.active .page-link {
            background: #800020;
            color: white;
            border-color: #800020;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-top {
                flex-direction: column;
                gap: 20px;
            }

            .search-section {
                width: 100%;
                flex-direction: column;
            }

            .search-container {
                width: 100%;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .filters-section {
                flex-wrap: wrap;
            }

            .filter-btn {
                flex: 1;
                min-width: 120px;
            }

        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 5px;
        }

        .page-link {
            display: inline-block;
            padding: 8px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            color: #800020;
            background: white;
            transition: all 0.3s ease;
            text-decoration: none;
            min-width: 40px;
            text-align: center;
        }

        .page-link:hover {
            background: rgba(128, 0, 32, 0.1);
            color: #800020;
        }

        .page-item.active .page-link {
            background: #800020;
            color: white;
            border-color: #800020;
        }

        .page-item.disabled .page-link {
            background: #f5f5f5;
            color: #999;
            cursor: not-allowed;
            border-color: #e0e0e0;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }

            .page-link {
                padding: 6px 12px;
                min-width: 35px;
            }
        }

        .loan-status.prestado {
            background: #e6f9f1;
            color: #10b981;
        }

        .loan-status.devuelto {
            background: #cbd5e1;
            color: #475569;
        }

        .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}

.modal.show {
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 1;
    visibility: visible;
}

.modal-content {
    background: white;
    border-radius: 8px;
    padding: 20px;
    width: 90%;
    max-width: 800px;
    position: relative;
    transform: translateY(-20px);
    transition: transform 0.3s ease;
}

.modal.show .modal-content {
    transform: translateY(0);
}

.close-modal {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 30px;
    height: 30px;
    font-size: 24px;
    color: #800020;
    cursor: pointer;
    border: none;
    background: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s ease;
    border-radius: 50%;
}

.close-modal:hover {
    transform: rotate(90deg);
    background: rgba(128, 0, 32, 0.1);
}

.detalles-container {
    display: grid;
    gap: 20px;
}


.detalles-section {
    background: #fff;
    padding: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
}

.detalles-section h3 {
    color: #800020;
    margin-bottom: 15px;
    font-size: 18px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.info-item {
    margin-bottom: 10px;
}

.info-item label {
    display: block;
    color: #666;
    margin-bottom: 5px;
}

.info-item span {
    color: #333;
}

@media (max-width: 768px) {
   

    .info-grid {
        grid-template-columns: 1fr;
    }
}
.detalles-container {
    display: grid;
    gap: 2rem;
}

.detalles-section {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.detalles-section h3 {
    color: #800020;
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #80002020;
}

.info-grid {
    display: grid;
    gap: 1.5rem;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}

.info-item {
    display: grid;
    gap: 0.5rem;
}

.info-item label {
    color: #666;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-item span {
    color: #2c3e50;
    font-size: 1.1rem;
    font-weight: 500;
    padding: 0.5rem;
    background: white;
    border-radius: 6px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}
C
@media (max-width: 768px) {
    .modal-content {
        padding: 1.5rem;
        margin: 1rem;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }
}
/* Animaciones para botones */
button, .action-btn {
    transition: all 0.3s ease;
    transform: scale(1);
}

button:hover, .action-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Animación para tarjetas */
.loan-card {
    transition: all 0.3s ease;
}

.loan-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}



@keyframes fadeIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Botones adicionales con gradiente */
.new-loan-btn {
    background: linear-gradient(45deg, #800020, #b30000);
}

.new-loan-btn:hover {
    background: linear-gradient(45deg, #b30000, #800020);
}

/* Botones de acción */
.action-btn.approve {
    background: linear-gradient(45deg, #10b981, #067d58);
    color: white;
}

.action-btn.approve:hover {
    background: linear-gradient(45deg, #067d58, #10b981);
}

.action-btn.cancel {
    background: linear-gradient(45deg, #ef4444, #b91c1c);
    color: white;
}

.action-btn.cancel:hover {
    background: linear-gradient(45deg, #b91c1c, #ef4444);
}

/* Paginación mejorada */
.page-link {
    transition: all 0.3s ease;
}


.page__heading {
        color: #8B1F41;
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


.page-link:hover {
    background: linear-gradient(45deg, #800020, #b30000);
    color: white;
}
.loan-card {
    border-radius: 15px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.loan-card:hover {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

/* Fondo en gradiente */
.loan-header {
    background: linear-gradient(rgb(155, 40, 71));
    color: white;
    padding: 15px 20px;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.loan-card {
    border: 1px solid rgb(155, 40, 71);
    box-shadow: 0 4px 8px rgba(155, 40, 71, 0.1);
    border-radius: 15px;
}

.loan-card:hover {
    box-shadow: 0 8px 16px rgba(155, 40, 71, 0.2);
}

    </style>
@endsection
