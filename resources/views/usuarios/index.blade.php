@extends('layouts.app')

<style>
    :root {
        --header-color: #9B2847;
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

    .section-header {
        margin-bottom: 3rem;
        padding: 30px 0;
        border-bottom: 1px solid #eee;
    }

    .page__heading {
        color: var(--header-color);
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

    /* Efecto de brillo animado */
    .btn::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0));
        transform: rotate(0deg);
        transition: transform 0.6s ease;
    }

    .btn:hover::before {
        transform: rotate(90deg);
    }

    .btn-new {
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        color: rgb(0, 0, 0);
        box-shadow: 0 4px 15px rgba(128, 0, 32, 0.2);
        position: relative;
        overflow: hidden;
    }

    .btn-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(128, 0, 32, 0.3);
        background: linear-gradient(135deg, var(--gradient-end), var(--gradient-start));
    }

    .btn-new:active {
        transform: translateY(0);
        box-shadow: 0 4px 15px rgba(128, 0, 32, 0.2);
    }

    .btn-new i {
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

    .dataTables_length select {
        border: 2px solid #eee;
        border-radius: 8px;
        padding: 8px 30px 8px 15px;
        appearance: none;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3E%3Cpath d='M0 2l4 4 4-4z' fill='%23800020'/%3E%3C/svg%3E") no-repeat right 15px center;
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
        box-shadow: 0 4px 10px rgba(128, 0, 32, 0.2);
    }

    /* Animaciones de carga */
    .table-container {
        animation: fadeIn 0.5s ease-out;
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

    /* Estilos para el modal de SweetAlert2 */
    .swal2-popup {
        border-radius: 20px !important;
        padding: 2rem !important;
    }

    .swal2-title {
        color: var(--primary-burgundy) !important;
    }

    .swal2-confirm {
        background: linear-gradient(45deg, var(--primary-burgundy), var(--light-burgundy)) !important;
        border-radius: 10px !important;
    }

    .swal2-cancel {
        border-radius: 10px !important;
    }

    /* Botón Nuevo Usuario Mejorado */
    .btn-new {
        background: linear-gradient(135deg, var(--primary-burgundy), var(--light-burgundy));
        color: rgb(3, 3, 3);
        /* Asegura que el texto sea blanco */
        padding: 12px 24px;
        border: none;
        border-radius: 30px;
        font-size: 16px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 6px 20px rgba(128, 0, 32, 0.3);
        transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .btn-new:hover {
        background: linear-gradient(135deg, var(--light-burgundy), var(--primary-burgundy));
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(128, 0, 32, 0.4);
    }

    .btn-new:active {
        transform: translateY(0);
        box-shadow: 0 6px 20px rgba(128, 0, 32, 0.3);
    }

    .btn-new i {
        color: rgb(95, 39, 39);
        /* Asegura que el icono también sea blanco */
        background: #494949;
        /* Fondo del icono */
        padding: 8px;
        /* Espaciado interno del icono */
        border-radius: 50%;
        /* Hace el fondo circular */
        transition: transform 0.3s ease;
    }

    .btn-new:hover i {
        transform: translateX(5px);
        /* Mueve el icono hacia la derecha al hacer hover */
    }

    /* Efecto Ripple al hacer clic */
    .btn-new::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        background: rgba(12, 12, 12, 0.3);
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
</style>

@section('content')
    <section class="section">
        <div class="d-flex align-items-cente">
            <h3 class="page__heading">Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="actions-container">
                            <div class="d-flex align-items-center">
                                <a class="btn btn-new" href="{{ route('usuarios.create') }}">
                                    <i class="fas fa-plus" style="background: #d6e5ff"></i>
                                    <span>Nuevo Usuario</span>
                                </a>
                            </div>
                            <div class="stats-container">
                                <!-- Aquí puedes agregar estadísticas rápidas si lo deseas -->
                            </div>
                        </div>

                        <div class="table-container">
                            <div class="table-responsive">
                                <table class="table" id="miTabla2">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre Completo</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Área</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $usuario)
                                            <tr>
                                                <td>{{ $usuario->id }}</td>
                                                <td>{{ $usuario->name }} {{ $usuario->apellido_paterno }}
                                                    {{ $usuario->apellido_materno }}</td>
                                                <td>{{ $usuario->email }}</td>
                                                <td>{{ $usuario->telefono }}</td>
                                                <td>{{ $usuario->area->nombre_area ?? 'N/A' }}</td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                                            class="btn btn-edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-delete"
                                                            onclick="confirmarEliminacion({{ $usuario->id }})">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                    <form id="eliminar-form-{{ $usuario->id }}"
                                                        action="{{ route('usuarios.destroy', $usuario->id) }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination justify-content-end">
                            {!! $usuarios->links() !!}
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
                searchPlaceholder: "Buscar usuario...",
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
