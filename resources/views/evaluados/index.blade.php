@extends('layouts.app')

<style>
    #miTabla2 {
        font-family: 'Open Sans', sans-serif;
        border-collapse: collapse;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    #miTabla2 thead {
        background-color: #483eff;
        color: #fff;
    }

    #miTabla2 thead th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    #miTabla2 tbody tr {
        border-bottom: 1px solid #ddd;
        transition: background-color 0.3s ease;
    }

    #miTabla2 tbody tr:hover {
        background-color: #f5f5f5;
    }

    #miTabla2 tbody td {
        padding: 12px 15px;
        text-align: center;
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
        background: #fff;
        overflow: hidden;
        border: 2px solid #6d6d6c;
        color: #535352;
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
        background: #fff;
        overflow: hidden;
        border: 2px solid #d90429;
        color: #d90429;
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

    @media (max-width: 992px) {
        .mobile-card {
            background: #fff;
            border: 1px solid #ddd;
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
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a class="btn btn-warning css-button-sliding-to-left--yellow" href="{{ route('evaluados.create') }}">
                                <i class="fas fa-plus"></i> Nuevo Evaluado
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped mt-2" id="miTabla2">
                                <thead style="background-color:#000000">
                                    <tr>
                                        <th style="color:#fff;" class="text-center">ID</th>
                                        <th style="color:#fff;" class="text-center">Nombre</th>
                                        <th style="color:#fff;" class="text-center">Apellido Paterno</th>
                                        <th style="color:#fff;" class="text-center">Apellido Materno</th>
                                        <th style="color:#fff;" class="text-center">CURP</th>
                                        <th style="color:#fff;" class="text-center">RFC</th>
                                        <th style="color:#fff;" class="text-center">CUIP</th>
                                        <th style="color:#fff;" class="text-center">IFE</th>
                                        <th style="color:#fff;" class="text-center">SMN</th>
                                        <th style="color:#fff;" class="text-center">Fecha de Apertura</th>
                                        <th style="color:#fff;" class="text-center">Sexo</th>
                                        <th style="color:#fff;" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evaluados as $evaluado)
                                    <tr>
                                        <td class="text-center">{{ $evaluado->id }}</td>
                                        <td class="text-center">{{ $evaluado->nombre }}</td>
                                        <td class="text-center">{{ $evaluado->AP }}</td>
                                        <td class="text-center">{{ $evaluado->AM }}</td>
                                        <td class="text-center">{{ $evaluado->CURP }}</td>
                                        <td class="text-center">{{ $evaluado->RFC }}</td>
                                        <td class="text-center">{{ $evaluado->CUIP }}</td>
                                        <td class="text-center">{{ $evaluado->IFE }}</td>
                                        <td class="text-center">{{ $evaluado->SMN }}</td>
                                        <td class="text-center">{{ $evaluado->fecha_apertura }}</td>
                                        <td class="text-center">{{ $evaluado->sexo }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('evaluados.edit', $evaluado->id) }}" class="btn btn-warning css-button-sliding-to-left--yellow">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <button type="button" class="btn btn-danger css-button-sliding-to-left--red" onclick="confirmarEliminacion({{ $evaluado->id }})">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                            <form id="eliminar-form-{{ $evaluado->id }}" action="{{ route('evaluados.destroy', $evaluado->id) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach ($evaluados as $evaluado)
                            <div class="mobile-card d-lg-none">
                                <div class="row">
                                    <div class="col-6"><label>ID:</label></div>
                                    <div class="col-6">{{ $evaluado->id }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Nombre Completo:</label></div>
                                    <div class="col-6">{{ $evaluado->nombre }} {{ $evaluado->apellido_paterno }} {{ $evaluado->apellido_materno }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>CURP:</label></div>
                                    <div class="col-6">{{ $evaluado->CURP }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>RFC:</label></div>
                                    <div class="col-6">{{ $evaluado->RFC }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>CUIP:</label></div>
                                    <div class="col-6">{{ $evaluado->CUIP }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>IFE:</label></div>
                                    <div class="col-6">{{ $evaluado->IFE }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>SMN:</label></div>
                                    <div class="col-6">{{ $evaluado->SMN }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Fecha de Apertura:</label></div>
                                    <div class="col-6">{{ $evaluado->fecha_apertura }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Sexo:</label></div>
                                    <div class="col-6">{{ $evaluado->sexo }}</div>
                                </div>
                                <div class="row action-buttons">
                                    <a href="{{ route('evaluados.edit', $evaluado->id) }}" class="btn btn-warning btn-mobile">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <button type="button" class="btn btn-danger btn-mobile" onclick="confirmarEliminacion({{ $evaluado->id }})">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                    <form id="eliminar-form-{{ $evaluado->id }}" action="{{ route('evaluados.destroy', $evaluado->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="pagination justify-content-end">
                            {!! $evaluados->links() !!}
                        </div>
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
    new DataTable('#miTabla2', {
        lengthMenu: [
            [2, 5, 10, 15, 50],
            [2, 5, 10, 15, 50]
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            search: "_INPUT_",
            searchPlaceholder: "Buscar...",
            lengthMenu: "Mostrar registros _MENU_ "
        },
        pageLength: 10
    });

    function confirmarEliminacion(evaluadoId) {
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
                document.getElementById('eliminar-form-' + evaluadoId).submit();
                Swal.fire({
                    title: 'Eliminado!',
                    text: 'El evaluado ha sido eliminado correctamente.',
                    icon: 'success',
                    timer: 4000,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
@endsection
