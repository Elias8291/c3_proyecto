@extends('layouts.app')

<style>
    /* Estilos de la tabla */
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

    /* Estilos de los botones */
    .css-button-sliding-to-left--yellow, .css-button-sliding-to-left--red {
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
    }

    .css-button-sliding-to-left--yellow {
        border: 2px solid #6d6d6c;
        color: #535352;
    }

    .css-button-sliding-to-left--red {
        border: 2px solid #d90429;
        color: #d90429;
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
</style>

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Evaluadoss</h3>
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
                                
                                <thead class="table-header" style="background-color: #cbdcfc">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Primer Apellido</th>
                                        <th class="text-center">Segundo Apellido</th>
                                        <th class="text-center">CURP</th>
                                        <th class="text-center">RFC</th>
                                        <th class="text-center">CUIP</th>
                                        <th class="text-center">IFE</th>
                                        <th class="text-center">SMN</th>
                                        <th class="text-center">Fecha de Apertura</th>
                                        <th class="text-center">Sexo</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($evaluados as $evaluado)
                                    <tr>
                                        <td class="text-center">{{ $evaluado->id }}</td>
                                        <td class="text-center">{{ $evaluado->primer_nombre }} {{ $evaluado->segundo_nombre }}</td>
                                        <td class="text-center">{{ $evaluado->primer_apellido }}</td>
                                        <td class="text-center">{{ $evaluado->segundo_apellido }}</td>
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
                            <div class="pagination justify-content-end">
                                {!! $evaluados->links() !!}
                            </div>
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
