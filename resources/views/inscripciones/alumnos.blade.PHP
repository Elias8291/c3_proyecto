@extends('layouts.app')

<style>
    #alumnosTable {
        font-family: 'Open Sans', sans-serif;
        border-collapse: collapse;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    #alumnosTable thead {
        background-color: #6777ef;
        color: #fff;
    }

    #alumnosTable thead th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    #alumnosTable tbody tr {
        border-bottom: 1px solid #ddd;
        transition: background-color 0.3s ease;
    }

    #alumnosTable tbody tr:hover {
        background-color: #f5f5f5;
    }

    #alumnosTable tbody td {
        padding: 12px 15px;
    }

    #alumnosTable tbody td .custom-badge {
        background-color: #000000;
        color: #fff;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    #alumnosTable tbody td .btn {
        padding: 6px 12px;
        font-size: 14px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    #alumnosTable tbody td .btn-warning {
        background-color: #fff;
        color: #212529;
    }

    #alumnosTable tbody td .btn-warning:hover {
        background-color: #e0a800;
    }

    #alumnosTable tbody td .btn-danger {
        background-color: #fff;
        color: #041014;
    }

    #alumnosTable tbody td .btn-danger:hover {
        background-color: #c82333;
    }

    .css-button-sliding-to-left--red {
        min-width: 130px;
        height: 40px;
        color: #fff;
        padding: 5px 10px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
        outline: none;
        border-radius: 5px;
        z-index: 0;
        background: #fff;
        overflow: hidden;
        border: 2px solid #d90429;
        color: #d90429;
    }

    .css-button-sliding-to-left--red:hover {
        color: #fff;
    }

    .css-button-sliding-to-left--red:hover:after {
        width: 100%;
    }

    .css-button-sliding-to-left--red:after {
        content: "";
        position: absolute;
        z-index: -1;
        transition: all 0.3s ease;
        left: 0;
        top: 0;
        width: 0;
        height: 100%;
        background: #d90429;
    }

    .css-button-sliding-to-left--yellow {
        min-width: 130px;
        height: 40px;
        color: #fff;
        padding: 5px 10px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
        outline: none;
        border-radius: 5px;
        z-index: 0;
        background: #fff;
        overflow: hidden;
        border: 2px solid #ffd819;
        color: #ffd819;
    }

    .css-button-sliding-to-left--yellow:hover {
        color: #fff;
    }

    .css-button-sliding-to-left--yellow:hover:after {
        width: 100%;
    }

    .css-button-sliding-to-left--yellow:after {
        content: "";
        position: absolute;
        z-index: -1;
        transition: all 0.3s ease;
        left: 0;
        top: 0;
        width: 0;
        height: 100%;
        background: #ffd819;
    }

    .custom-badge {
        background-color: #483eff;
        color: white;
    }

    .dataTables_filter {
        position: relative;
    }

    .dataTables_filter input[type="search"] {
        padding: 12px 40px 12px 20px;
        border: none;
        border-radius: 25px;
        background-color: #f2f2f2;
        font-size: 16px;
        width: 300px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .dataTables_filter input[type="search"]:focus {
        outline: none;
        width: 350px;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .dataTables_filter::after {
        content: "\f002";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        color: #999;
        transition: color 0.3s ease;
    }

    .dataTables_filter input[type="search"]:focus+::after {
        color: #333;
    }

    .dataTables_length {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }

    .dataTables_length label {
        font-size: 16px;
        font-weight: bold;
        color: #555;
    }

    .dataTables_length select {
        padding: 10px 40px 10px 20px;
        border: none;
        border-radius: 25px;
        background-color: #f2f2f2;
        font-size: 16px;
        width: 120px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23999'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .dataTables_length select:focus {
        outline: none;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .dataTables_length select:hover {
        background-color: #e6e6e6;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
    }

    .btn-mobile {
        flex: 0 1 48%;
        margin: 0;
        padding: 8px;
        border-radius: 4px;
        font-size: 0;
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn-mobile i {
        font-size: 20px;
    }

    .btn-mobile:hover {
        opacity: 0.8;
    }

    .btn-warning.btn-mobile {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-danger.btn-mobile {
        background-color: #dc3545;
        color: #fff;
    }

    .dataTables_length::after {
        content: "";
        position: absolute;
        top: 50%;
        right: 30px;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #999;
        pointer-events: none;
        transition: border-color 0.3s ease;
    }

    .dataTables_length select:focus+::after {
        border-top-color: #333;
    }

    @media (max-width: 992px) {
        #alumnosTable {
            display: none;
        }

        .mobile-table {
            display: block;
        }

        .mobile-card {
        background: #fff;
        border: 1px solid #ddd; /* Añadir borde */
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 16px;
        padding: 16px;
    }

    .mobile-card .row {
        margin-bottom: 8px;
    }

    .mobile-card label {
        font-weight: bold;
        color: #333;
    }

    .mobile-card .data {
        font-size: 14px;
        color: #666;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
    }

    .btn-mobile {
        flex: 0 1 48%;
        margin: 0;
        padding: 10px;
        border-radius: 4px;
        font-size: 14px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn-mobile i {
        font-size: 16px;
        margin-right: 5px;
    }

    .btn-mobile:hover {
        opacity: 0.8;
    }

    .btn-warning.btn-mobile {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-danger.btn-mobile {
        background-color: #dc3545;
        color: #fff;
    }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
        }

        .btn-mobile {
            flex: 0 1 48%;
            margin: 0;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn-mobile i {
            font-size: 16px;
            margin-right: 5px;
        }

        .btn-mobile:hover {
            opacity: 0.8;
        }

        .btn-warning.btn-mobile {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-danger.btn-mobile {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-mobile-action {
            flex: 0 1 48%;
            margin: 0;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn-mobile-action i {
            font-size: 16px;
            margin-right: 5px;
        }

        .btn-mobile-action:hover {
            opacity: 0.8;
        }

        .mobile-table {
            display: none;
        }

        .dataTables_length,
        .dataTables_filter,
        .dataTables_paginate {
            display: none !important;
        }
    }

    .btn-status {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        border-radius: 20px;
        color: #000;
        border: 2px solid transparent;
    }

    .btn-status.active {
        color: #28a745;
    }

    .btn-status.inactive {
        color: #dc3545;
    }

    .btn-status .icon {
        margin-right: 5px;
    }

    @media (min-width: 993px) {
        .mobile-table {
            display: none;
        }
    }
</style>

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Alumnos del Grupo</h3>
    </div>
    <div class="section-body">
        <div class="row mb-3">
            <div class="col-lg-12">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if ($alumnos->isEmpty())
                        <div class="alert alert-info" role="alert">
                            No hay alumnos inscritos en este grupo.
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped mt-2" id="alumnosTable">
                                <thead style="background-color:#6777ef">
                                    <tr>
                                        <th style="color:#fff;" class="text-center">Número de Control</th>
                                        <th style="color:#fff;" class="text-center">Nombre del Estudiante</th>
                                        <th style="color:#fff;" class="text-center">Clave del Grupo</th>
                                        <th style="color:#fff;" class="text-center">Nombre de la Materia</th>
                                        <th style="color:#fff;" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alumnos as $alumno)
                                    <tr>
                                        <td class="text-center">{{ $alumno->numeroDeControl }}</td>
                                        <td class="text-center">{{ $alumno->nombre_estudiante }}</td>
                                        <td class="text-center">{{ $alumno->clave_grupo }}</td>
                                        <td class="text-center">{{ $alumno->nombre_materia }}</td>
                                        <td class="text-center">
                                            @if ($grupo->activo)
                                            @can('editar-inscripcion')
                                            <a href="{{ route('inscripciones.edit', $alumno->id) }}"
                                                class="btn btn-warning css-button-sliding-to-left--yellow">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            @endcan

                                            @can('eliminar-inscripcion')
                                            <button type="button" class="btn btn-danger css-button-sliding-to-left--red"
                                                onclick="confirmarEliminacion({{ $alumno->id }})">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                            <form id="eliminar-form-{{ $alumno->id }}"
                                                action="{{ route('inscripciones.destroy', $alumno->id) }}" method="POST"
                                                class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @endcan
                                            @else
                                            <span class="badge badge-secondary">Inactivo</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach ($alumnos as $alumno)
                            <div class="mobile-card d-lg-none">
                                <div class="row">
                                    <div class="col-6"><label>Número de Control:</label></div>
                                    <div class="col-6">{{ $alumno->numeroDeControl }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Nombre del Estudiante:</label></div>
                                    <div class="col-6">{{ $alumno->nombre_estudiante }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Clave del Grupo:</label></div>
                                    <div class="col-6">{{ $alumno->clave_grupo }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Nombre de la Materia:</label></div>
                                    <div class="col-6">{{ $alumno->nombre_materia }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Estatus:</label></div>
                                    <div class="col-6">
                                        <span class="custom-badge">{{ $grupo->activo ? 'Activo' : 'Inactivo' }}</span>
                                    </div>
                                </div>
                                <div class="row action-buttons">
                                    @can('editar-inscripcion')
                                    <a href="{{ route('inscripciones.edit', $alumno->id) }}"
                                        class="btn btn-warning btn-mobile">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    @endcan
                                    @can('eliminar-inscripcion')
                                    <button type="button" class="btn btn-danger btn-mobile"
                                        onclick="confirmarEliminacion({{ $alumno->id }})">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                    <form id="eliminar-form-{{ $alumno->id }}"
                                        action="{{ route('inscripciones.destroy', $alumno->id) }}" method="POST"
                                        class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="pagination justify-content-end">
                            {!! $alumnos->links() !!}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

        $('#alumnosTable').DataTable({
            lengthMenu: [
                [2, 5, 10],
                [2, 5, 10]
            ],
            columns: [
                { data: 'numerocontrol', title: 'Número de Control' },
                { data: 'nombre', title: 'Nombre del Estudiante' },
                { data: 'clave', title: 'Clave del Grupo' },
                { data: 'materia', title: 'Nombre de la Materia' },
                { data: 'actions', title: 'Acciones' }
            ],
            language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            search: "_INPUT_",
            searchPlaceholder: "Buscar...",
            lengthMenu: "Mostrar registros _MENU_ "
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        pageLength: 10

    });
    function confirmarEliminacion(inscripcionId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('eliminar-form-' + inscripcionId).submit();
                Swal.fire({
                    title: 'Eliminado!',
                    text: 'La inscripción ha sido eliminada correctamente.',
                    icon: 'success',
                    timer: 4000,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
@endsection
