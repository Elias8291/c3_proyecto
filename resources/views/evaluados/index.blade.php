@extends('layouts.app')

<style>
:root {
    --primary-burgundy: #800020;
    --light-burgundy: #98304b;
    --pastel-pink: #ffd6e0;
    --pastel-blue: #d6e5ff;
    --pastel-purple: #e5d6ff;
    --hover-pink: #ffecf1;
    --gradient-start: #800020;
    --gradient-end: #b31b41;
}

/* Estilos generales y contenedor principal */
body {
    background: linear-gradient(135deg, #f8f9fa, #fff5f7);
    min-height: 100vh;
}

.section {
    padding: 2rem;
}

.card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    padding: 30px;
    position: relative;
    overflow: hidden;
}

.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
}

/* Encabezado mejorado */
.section-header {
    margin-bottom: 2.5rem;
    position: relative;
    padding: 20px 0;
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
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 6px;
    background: linear-gradient(90deg, var(--pastel-pink), var(--primary-burgundy));
    border-radius: 3px;
}

/* Contenedor de acciones superior */
.actions-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

/* Estilos mejorados de la tabla */
.table-container {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    margin: 20px 0;
    animation: fadeIn 0.5s ease-out;
}

#miTabla2 {
    font-family: 'Open Sans', sans-serif;
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
    font-size: 14px;
    margin: 0;
}

#miTabla2 thead {
    background: linear-gradient(135deg, var(--primary-burgundy), var(--light-burgundy));
    position: relative;
}

#miTabla2 thead::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, #fff, transparent);
}

#miTabla2 thead th {
    padding: 18px 15px;
    text-align: left;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: white;
    font-size: 0.85rem;
    position: relative;
}


#miTabla2 thead th::after {
    content: '';
    position: absolute;
    right: 0;
    top: 25%;
    height: 50%;
    width: 1px;
    background: rgba(255, 255, 255, 0.1);
}

#miTabla2 tbody tr {
    transition: all 0.3s ease;
}

#miTabla2 tbody tr:nth-child(even) {
    background-color: rgba(var(--pastel-pink), 0.05);
}

#miTabla2 tbody tr:hover {
    background-color: var(--hover-pink);
    transform: scale(1.01);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

#miTabla2 tbody td {
    padding: 15px;
    vertical-align: middle;
    border-bottom: 1px solid #eee;
    transition: all 0.3s ease;
    text-align: center;
}

/* Botones mejorados */
.btn {
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    position: relative;
    overflow: hidden;
    cursor: pointer;
}

.btn-new {
    background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    color: white;
    box-shadow: 0 4px 15px rgba(128, 0, 32, 0.2);
    position: relative;
    overflow: hidden;
}

.btn-new:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(128, 0, 32, 0.3);
    background: linear-gradient(135deg, var(--gradient-end), var(--gradient-start));
}

.btn-new i {
    color: white;
    background: #494949;
    padding: 8px;
    border-radius: 50%;
    transition: transform 0.3s ease;
}

.btn-new:hover i {
    transform: translateX(5px);
}

.btn-edit {
    background: linear-gradient(45deg, #4a90e2, #357abd);
    color: white;
}

.btn-delete {
    background: linear-gradient(45deg, #ff6b6b, #ee5253);
    color: white;
}

.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
}

/* Estilos del DataTable */
.dataTables_wrapper {
    padding: 20px 0;
}

.dataTables_filter input {
    border: 2px solid #eee;
    border-radius: 10px;
    padding: 8px 15px;
    transition: all 0.3s ease;
    width: 250px;
}

.dataTables_filter input:focus {
    border-color: var(--primary-burgundy);
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
    outline: none;
}

/* Paginación mejorada */
.pagination {
    margin-top: 2rem;
    gap: 5px;
}

.page-link {
    border: none;
    padding: 10px 18px;
    border-radius: 10px;
    color: var(--primary-burgundy);
    font-weight: 500;
    transition: all 0.3s ease;
}

.page-link:hover {
    background-color: var(--pastel-pink);
    color: var(--primary-burgundy);
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: linear-gradient(45deg, var(--primary-burgundy), var(--light-burgundy));
    border: none;
    box-shadow: 0 4px 10px rgba(255, 255, 255, 0.2);
}

/* Animaciones de carga */
.table-container {
    animation: fadeIn 0.5s ease-out;
}

/* Efecto Ripple al hacer clic */
.btn-new::after {
    content: "";
    position: absolute;
    width: 100px;
    height: 100px;
    background: rgb(253, 0, 0);
    border-radius: 50%;
    transform: scale(0);
    opacity: 0;
    pointer-events: none;
    transition: transform 0.5s ease, opacity 1s ease;
}

.btn-new:active::after {
    transform: scale(4);
    opacity: 1;
    transition: 0s;
}

/* Asegura que el texto dentro del span herede el color blanco */
.btn-new span {
    color: white;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.search-container {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.search-input {
    flex: 1;
    padding: 12px 20px;
    border: 2px solid #eee;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: white;
    color: #333;
}

.search-input:focus {
    border-color: var(--primary-burgundy);
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
    outline: none;
}

.search-input::placeholder {
    color: #999;
}

.filters-container {
    display: flex;
    gap: 20px;
    align-items: center;
    margin-bottom: 20px;
    background: white;
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

/* Add new styles for the year filter */
.filters-section {
    margin-bottom: 20px;
    background: white;
    padding: 15px 20px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.year-filter {
    display: flex;
    align-items: center;
    gap: 12px;
}

.filter-label {
    color: var(--primary-burgundy);
    font-weight: 600;
    font-size: 14px;
}

.year-select {
    padding: 8px 15px;
    border: 2px solid #eee;
    border-radius: 10px;
    font-size: 14px;
    min-width: 120px;
    background: white;
    color: #333;
    transition: all 0.3s ease;
}

.year-select:focus {
    border-color: var(--primary-burgundy);
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
    outline: none;
}

.search-container {
    display: flex;
    align-items: center;
    gap: 15px;
    background: white;
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.search-input {
    flex: 1;
    padding: 12px 20px;
    border: 2px solid #eee;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: white;
    color: #333;
}

.search-input:focus {
    border-color: var(--primary-burgundy);
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
    outline: none;
}

.search-input::placeholder {
    color: #999;
}

.filters-section {
    margin-bottom: 20px;
    background: white;
    padding: 15px 20px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.year-filter {
    display: flex;
    align-items: center;
    gap: 12px;
}

.filter-label {
    color: var(--primary-burgundy);
    font-weight: 600;
    font-size: 14px;
}

.year-select {
    padding: 8px 15px;
    border: 2px solid #eee;
    border-radius: 10px;
    font-size: 14px;
    min-width: 120px;
    background: white;
    color: #333;
    transition: all 0.3s ease;
}

.year-select:focus {
    border-color: var(--primary-burgundy);
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
    outline: none;
}

.swal-title-large {
    font-size: 2rem;
    font-weight: bold;
    color: #d9534f;
}
</style>

@section('content')
<section class="section">
    <div class="d-flex align-items-center">
        <h3 class="page__heading">Evaluados</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="background: #ffffff">
                    <div class="actions-container">
                        <div class="d-flex align-items-center">
                            <a class="btn btn-new" href="{{ route('evaluados.create') }}">
                                <i class="fas fa-plus"></i>
                                <span>Nuevo Evaluado</span>
                            </a>
                        </div>
                        <div class="search-container" style="background: transparent">
                            <input type="text" class="search-input" id="searchInput" placeholder="Buscar evaluado...">
                            <button class="btn btn-new" onclick="searchEvaluados()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="filters-section">
                        <div class="year-filter">
                            <label for="yearSelect" class="filter-label">Filtrar por año:</label>
                            <select class="year-select" id="yearSelect" onchange="filterEvaluados()">
                                <option value="">Todos los años</option>
                                @for ($year = date('Y'); $year >= date('Y') - 10; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>

                            <div class="year-filter">
                                <label for="perPageSelect" class="filter-label">Mostrar:</label>
                                <select class="year-select" id="perPageSelect" onchange="updatePerPage()">
                                    <option value="5" {{ request('perPage')==5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage')==10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('perPage')==25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('perPage')==50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('perPage')==100 ? 'selected' : '' }}>100</option>
                                </select>

                                <span>evaluados por página</span>
                            </div>


                        </div>

                    </div>

                    <div class="table-container">
    <div class="table-responsive">
        <table class="table" id="evaluadosTable">
            <thead>
                <tr>
                    <th class="text-center">Nombre Completo</th>
                    <th class="text-center">CURP</th>
                    <th class="text-center">RFC</th>
                    <th class="text-center">Fecha de Evaluación</th>
                    <th class="text-center">Resultado de Evaluación</th>
                    <th class="text-center">Acciones</th>
                    <th class="text-center">Carpeta</th>
                </tr>
            </thead>
            <tbody id="evaluadosTableBody">

                @foreach ($evaluados as $evaluado)
                <tr>
                    <td class="text-center">
                        {{ $evaluado->primer_nombre }} {{ $evaluado->segundo_nombre }} 
                        {{ $evaluado->primer_apellido }} {{ $evaluado->segundo_apellido }}
                    </td>
                    <td>{{ $evaluado->CURP }}</td>
                    <td>{{ $evaluado->RFC }}</td>
                    <td class="text-center">{{ $evaluado->fecha_apertura }}</td>
                    <td class="text-center">
                        @if ($evaluado->resultado_evaluacion == 1)
                        Aprobó
                        @else
                        No Aprobó
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            @if($evaluado->carpeta)
                            <i class="fas fa-folder" style="color: var(--primary-burgundy);" title="Carpeta asociada"></i>
                            @endif
                            @can('editar-evaluado')
                            <a href="{{ route('evaluados.edit', $evaluado->id) }}" class="btn btn-edit" title="Editar Evaluado">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                            @can('eliminar-evaluado')
                            <button type="button" class="btn btn-delete" title="Borrar Evaluado" onclick="confirmarEliminacion({{ $evaluado->id }})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form id="eliminar-form-{{ $evaluado->id }}" action="{{ route('evaluados.destroy', $evaluado->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endcan
                        </div>
                    </td>
                    <td class="text-center">
            @if($evaluado->carpeta)
                <a href="{{ route('carpetas.show', $evaluado->carpeta->id) }}" class="btn btn-new" title="Ver Carpeta">
                    <i class="fas fa-folder"></i>
                </a>
            @else
                <span title="No hay carpeta asociada">
                    <i class="fas fa-folder-open text-muted"></i>
                </span>
            @endif
        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="pagination justify-content-end">
    {!! $evaluados->appends(request()->query())->links() !!}
</div>

           
                </div>
            </div>
        </div>
    </div>
</section>

<script>
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




// Asignar el evento 'input' al campo de búsqueda
document.getElementById('searchInput').addEventListener('input', function() {
    var searchInput = this.value.toLowerCase();
    var yearSelect = document.getElementById('yearSelect').value;
    var table = document.getElementById('evaluadosTable');
    var rows = table.getElementsByTagName('tr');

    for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var fullName = row.cells[0].textContent.toLowerCase(); // Índice de "Nombre Completo"
        var fecha_apertura = row.cells[3].textContent; // Índice de columna "Fecha de Evaluación"

        // Extraer el año de la fecha de apertura
        var yearFromFechaApertura = new Date(fecha_apertura).getFullYear().toString();

        var showRow = false;
        if (searchInput === '' && yearSelect === '') {
            showRow = true;
        } else if (searchInput !== '' && fullName.includes(searchInput)) {
            showRow = true;
        } else if (yearSelect !== '' && yearFromFechaApertura === yearSelect) {
            showRow = true;
        } else if (
            searchInput !== '' &&
            yearSelect !== '' &&
            fullName.includes(searchInput) &&
            yearFromFechaApertura === yearSelect
        ) {
            showRow = true;
        }

        row.style.display = showRow ? 'table-row' : 'none';
    }
});




function filterEvaluados() {
    var searchInput = document.getElementById('searchInput').value;
    var yearSelect = document.getElementById('yearSelect').value;

    // Redirigir a la misma página con los parámetros de búsqueda y filtrado
    var url = new URL(window.location.href);
    if (searchInput) {
        url.searchParams.set('search', searchInput);
    } else {
        url.searchParams.delete('search');
    }
    if (yearSelect) {
        url.searchParams.set('year', yearSelect);
    } else {
        url.searchParams.delete('year');
    }

    window.location.href = url.toString();
}

function searchEvaluados() {
    const searchInput = document.getElementById('searchInput').value;
    const yearSelect = document.getElementById('yearSelect').value;

    const url = new URL(window.location.href);
    url.searchParams.set('search', searchInput);
    if (yearSelect) {
        url.searchParams.set('year', yearSelect);
    } else {
        url.searchParams.delete('year');
    }

    // Redirigir al backend para procesar la búsqueda en toda la base de datos
    window.location.href = url.toString();
}


document.getElementById('yearSelect').addEventListener('change', filterEvaluados);
document.addEventListener('DOMContentLoaded', function() {
    var table = document.getElementById('evaluadosTable');
    var rows = table.getElementsByTagName('tr');

    for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var fechaCell = row.cells[4]; // La columna de la fecha de apertura
        var fechaApertura = new Date(fechaCell.textContent);

        if (!isNaN(fechaApertura)) {
            var options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            fechaCell.textContent = fechaApertura.toLocaleDateString('es-ES', options);
        }
    }
});

function updateEvaluadosTable() {
    const searchInput = document.getElementById('searchInput').value;
    const yearSelect = document.getElementById('yearSelect').value;
    const perPage = document.getElementById('perPageSelect').value;

    const url = new URL(window.location.href);
    url.searchParams.set('search', searchInput);
    url.searchParams.set('year', yearSelect);
    url.searchParams.set('perPage', perPage);

    fetch(url.toString(), {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => response.json())
    .then(data => {
        // Actualizar el cuerpo de la tabla
        const tableBody = document.getElementById('evaluadosTableBody');
        tableBody.innerHTML = '';

        data.evaluados.forEach(evaluado => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center">${evaluado.primer_nombre} ${evaluado.segundo_nombre} ${evaluado.primer_apellido} ${evaluado.segundo_apellido}</td>
                <td>${evaluado.CURP}</td>
                <td>${evaluado.RFC}</td>
                <td class="text-center">${new Date(evaluado.fecha_apertura).toLocaleDateString('es-ES')}</td>
                <td class="text-center">${evaluado.resultado_evaluacion ? 'Aprobó' : 'No Aprobó'}</td>
                <td>
                    <div class="action-buttons">
                        <a href="/evaluados/${evaluado.id}/edit" class="btn btn-edit" title="Editar Evaluado">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-delete" onclick="confirmarEliminacion(${evaluado.id})" title="Eliminar Evaluado">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        });

        // Actualizar la paginación
        const paginationContainer = document.querySelector('.pagination');
        paginationContainer.innerHTML = data.pagination;
    })
    .catch(error => console.error('Error al actualizar la tabla:', error));
}

// Eventos
document.getElementById('searchInput').addEventListener('input', updateEvaluadosTable);
document.getElementById('yearSelect').addEventListener('change', updateEvaluadosTable);
document.getElementById('perPageSelect').addEventListener('change', updateEvaluadosTable);


function updatePerPage() {
    var perPage = document.getElementById('perPageSelect').value;

    // Redirigir a la misma página con el parámetro de cantidad por página
    var url = new URL(window.location.href);
    url.searchParams.set('perPage', perPage);
    window.location.href = url.toString();
}

</script>

@endsection