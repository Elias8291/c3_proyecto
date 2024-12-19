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

    /* Encabezado mejorado */
    .section-header {
        margin-bottom: 2.5rem;
        position: relative;
        padding: 20px 0;
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
        box-shadow: 0 4px 15px #ebe8e833;
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

/* ... Tus estilos existentes ... */

/* Agregar figuras decorativas al fondo del contenedor .card */
.card {
    position: relative;
    overflow: hidden;
}

.card::before,
.card::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
    z-index: 0;
}



.card::after {
    width: 200px;
    height: 200px;
    background: var(--pastel-pink);
    bottom: -50px;
    right: -50px;
    transform: rotate(-30deg);
}


/* Agregar figuras abstractas al fondo del body */
body {
    position: relative;
    background: linear-gradient(135deg, #f8f9fa, #fff5f7);
    min-height: 100vh;
    overflow: hidden; /* Previene barras de desplazamiento por las figuras */
}

body::before,
body::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    opacity: 0.02;
    z-index: 0;
}

body::before {
    width: 500px;
    height: 500px;
    background: var(--gradient-start);
    top: -200px;
    left: -200px;
    transform: rotate(0deg);
}

body::after {
    width: 400px;
    height: 400px;
    background: var(--gradient-end);
    bottom: -150px;
    right: -150px;
    transform: rotate(90deg);
}

/* Opcional: Añadir una capa oscura sutil sobre el fondo para resaltar los contenedores */
.section, .section-header, .section-body, .card, .table-container, {
    position: relative;
    z-index: 1;
}

    
</style>

@section('content')
<div class="main-container">
    <section class="section">
        <div class="d-flex align-items-center">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="actions-container">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-new" href="{{ route('roles.create') }}">
                            <i class="fas fa-plus"></i>
                            <span>Nuevo Rol</span>
                        </a>
                    </div>
                </div>
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table" id="miTabla2">
                            <thead>
                                <tr>
                                    <th class="text-center">Rol</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-edit">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <button type="button" class="btn btn-delete" onclick="confirmarEliminacion({{ $role->id }})">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                            <form id="eliminar-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-none">
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
              
            </div>
            <div class="paginations justify-content-end">
                {!! $roles->links() !!}
            </div>
        </div>
    </section>
</div>



<script>
    new DataTable('#miTabla2', {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        }
    });

    function confirmarEliminacion(evaluadoId) {
        Swal.fire({
            title: '<strong>¡ADVERTENCIA!</strong>'
            , html: '<p style="font-size: 1.2rem; color: #d9534f; font-weight: bold;">Estás a punto de BORRAR permanentemente este evaluado. Esta acción no se puede deshacer.</p>'
            , icon: 'error'
            , showCancelButton: true
            , confirmButtonColor: '#d9534f'
            , cancelButtonColor: '#6c757d'
            , confirmButtonText: '<span style="font-size: 1.1rem;">Sí, BORRAR</span>'
            , cancelButtonText: '<span style="font-size: 1rem;">Cancelar</span>'
            , customClass: {
                popup: 'animated shake'
                , title: 'swal-title-large'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar la segunda confirmación
                Swal.fire({
                    title: '<strong>¿Estás completamente seguro?</strong>'
                    , html: '<p style="font-size: 1.1rem;">Esta es tu última oportunidad para cancelar.</p>'
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#d9534f'
                    , cancelButtonColor: '#6c757d'
                    , confirmButtonText: '<span style="font-size: 1.1rem;">Sí, estoy seguro</span>'
                    , cancelButtonText: '<span style="font-size: 1rem;">Cancelar</span>'
                    , customClass: {
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
