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
        color: var(--primary-burgundy);
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }

    .page__heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--pastel-pink), var(--primary-burgundy));
        border-radius: 2px;
    }

    /* Contenedor de acciones superior */
    .actions-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding: 15px;
        background: linear-gradient(to right, #fff, var(--pastel-pink));
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
</style>

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Evaluados</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="actions-container">
                        <div class="d-flex align-items-center">
                            <a class="btn btn-new" href="{{ route('evaluados.create') }}">
                                <i class="fas fa-plus"></i>
                                <span>Nuevo Evaluado</span>
                            </a>
                        </div>
                    </div>
                    <div class="search-container">
                        <input type="text" id="searchByName" class="search-input" placeholder="Buscar por nombre...">
                    </div>
                    <div class="table-container">
                        <div class="table-responsive">
                            <table class="table" id="miTabla2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre Completo</th>
                                        <th>CURP</th>
                                        <th>RFC</th>
                                        <th>CUIP</th>
                                        <th>IFE</th>
                                        <th>SMN</th>
                                        <th>Fecha de Apertura</th>
                                        <th>Sexo</th>
                                        <th>Actualizar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evaluados as $evaluado)
                                    <tr>
                                        <td>{{ $evaluado->id }}</td>
                                        <td>{{ $evaluado->primer_nombre }} {{ $evaluado->segundo_nombre }} {{
                                            $evaluado->primer_apellido }} {{ $evaluado->segundo_apellido }}</td>
                                        <td>{{ $evaluado->CURP }}</td>
                                        <td>{{ $evaluado->RFC }}</td>
                                        <td>{{ $evaluado->CUIP }}</td>
                                        <td>{{ $evaluado->IFE }}</td>
                                        <td>{{ $evaluado->SMN }}</td>
                                        <td>{{ $evaluado->fecha_apertura }}</td>
                                        <td>{{ $evaluado->sexo }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('evaluados.edit', $evaluado->id) }}"
                                                    class="btn btn-edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <button type="button" class="btn btn-delete"
                                                    onclick="confirmarEliminacion({{ $evaluado->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <form id="eliminar-form-{{ $evaluado->id }}"
                                                    action="{{ route('evaluados.destroy', $evaluado->id) }}"
                                                    method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pagination justify-content-end">
                        {!! $evaluados->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    new DataTable('#miTabla2', {
        lengthMenu: [
            [5, 10, 15, 25, 50],
            [5, 10, 15, 25, 50]
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            search: "_INPUT_",
            searchPlaceholder: "Buscar evaluado...",
            lengthMenu: "Mostrar _MENU_ registros"
        },
        pageLength: 10,
        drawCallback: function() {
            document.querySelectorAll('.paginate_button').forEach(button => {
                button.classList.add('page-item');
                const link = button.querySelector('a');
                if (link) link.classList.add('page-link');
            });
        }
    });

    function confirmarEliminacion(evaluadoId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#800020',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            borderRadius: '10px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('eliminar-form-' + evaluadoId).submit();
                Swal.fire({
                    title: '¡Eliminado!',
                    text: 'El evaluado ha sido eliminado correctamente.',
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'rounded-lg'
                    }
                });
            }
        });
    }

     document.getElementById('searchByName').addEventListener('keyup', function() {
        let searchTerm = this.value;
        table.column(1).search(searchTerm).draw(); // Column index 1 corresponds to the "Nombre Completo" column
    });
</script>
@endsection