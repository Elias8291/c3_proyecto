@extends('layouts.app')

<style>
    /* Aquí van tus estilos CSS, tal como los proporcionaste */
    /* ... (copia todo el contenido del estilo que proporcionaste) ... */
</style>

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Usuarios</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Botón para crear un nuevo usuario -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a class="btn btn-warning css-button-sliding-to-left--yellow" href="{{ route('usuarios.create') }}">
                                <i class="fas fa-plus"></i> Nuevo Usuario
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
                                        <th style="color:#fff;" class="text-center">Email</th>
                                        <th style="color:#fff;" class="text-center">Teléfono</th>
                                        <th style="color:#fff;" class="text-center">Área</th>
                                        <th style="color:#fff;" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td class="text-center">{{ $usuario->id }}</td>
                                        <td class="text-center">{{ $usuario->name }}</td>
                                        <td class="text-center">{{ $usuario->apellido_paterno }}</td>
                                        <td class="text-center">{{ $usuario->apellido_materno }}</td>
                                        <td class="text-center">{{ $usuario->email }}</td>
                                        <td class="text-center">{{ $usuario->telefono }}</td>
                                        <td class="text-center">{{ $usuario->area->nombre_area ?? 'N/A' }}</td> <!-- Asegúrate de tener esta relación -->
                                        <td class="text-center">
                                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning css-button-sliding-to-left--yellow">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <button type="button" class="btn btn-danger css-button-sliding-to-left--red" onclick="confirmarEliminacion({{ $usuario->id }})">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                            <form id="eliminar-form-{{ $usuario->id }}" action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Tarjetas móviles para pantallas pequeñas -->
                            @foreach ($usuarios as $usuario)
                            <div class="mobile-card d-lg-none">
                                <div class="row">
                                    <div class="col-6"><label>ID:</label></div>
                                    <div class="col-6">{{ $usuario->id }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Nombre Completo:</label></div>
                                    <div class="col-6">{{ $usuario->name }} {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Email:</label></div>
                                    <div class="col-6">{{ $usuario->email }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Teléfono:</label></div>
                                    <div class="col-6">{{ $usuario->telefono }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Área:</label></div>
                                    <div class="col-6">{{ $usuario->area->nombre ?? 'N/A' }}</div>
                                </div>
                                <div class="row action-buttons">
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-mobile">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <button type="button" class="btn btn-danger btn-mobile" onclick="confirmarEliminacion({{ $usuario->id }})">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                    <form id="eliminar-form-{{ $usuario->id }}" action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="pagination justify-content-end">
                            {!! $usuarios->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts necesarios -->
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

        function confirmarEliminacion(usuarioId) {
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
                    document.getElementById('eliminar-form-' + usuarioId).submit();
                    Swal.fire({
                        title: 'Eliminado!',
                        text: 'El usuario ha sido eliminado correctamente.',
                        icon: 'success',
                        timer: 4000,
                        showConfirmButton: false
                    });
                }
            });
        }
    </script>
@endsection
