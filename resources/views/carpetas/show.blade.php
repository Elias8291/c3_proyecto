@extends('layouts.app')

@section('title', 'Documentos de la Carpeta')

@section('content')
    <div class="documentos-container">
        <div class="header">
            <h1>Documentos de Carpeta</h1>
            <div class="header-details">
                <span class="carpeta-id">Carpeta #{{ $carpeta->id }}</span>
                <span class="evaluado-nombre">{{ $carpeta->evaluado->nombre }}</span>
            </div>
            <button class="add-documento-btn">
                <i class="plus-icon">+</i>
                Agregar Documento
            </button>
        </div>

        <div class="documentos-grid">
            @foreach ($carpeta->documentos as $documento)
                <div class="documento-card">
                    <div class="documento-header">
                        <div class="documento-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                        </div>
                        <div class="documento-info">
                            <h3>{{ $documento->area->nombre_area }}</h3>
                        </div>
                    </div>
                    <div class="documento-body">
                        <div class="documento-detail">
                            <span class="label">Numero de hojas</span>
                            <span class="value">{{ $documento->numero_hojas }}</span>
                        </div>
                        <div class="documento-detail">
                            <span class="label">Fecha de Creación</span>
                            <span
                                class="value">{{ \Carbon\Carbon::parse($documento->fecha_creacion)->format('d/m/Y') }}</span>
                        </div>
                        <div class="documento-detail">
                            <span class="label">Estado</span>
                            <span class="value">{{ $documento->estado }}</span>
                        </div>
                    </div>

                    <div class="documento-actions">
                        @if ($documento->estado == 'Disponible')
                            <button class="btn-solicitar">Solicitar</button>
                        @elseif($documento->estado == 'Prestado')
                            <button class="btn-devolver">Devolver</button>
                        @elseif($documento->estado == 'Solicitado')
                            <button class="btn-cancelar">Cancelar</button>
                        @endif

                        @if ($documento->estado != 'Solicitado')
                            <!-- Eliminar solo si no está "Solicitado" -->
                            <button class="btn-eliminar"
                                onclick="confirmarEliminacionDocumento({{ $documento->id }})">Eliminar</button>
                        @endif

                        <form id="eliminar-form-{{ $documento->id }}"
                            action="{{ route('documentos.destroy', $documento->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            @endforeach

        </div>

        <div id="documentoModal" class="modal">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <h2>Agregar Nuevo Documento</h2>
                <form id="documentoForm" action="{{ route('documentos.store', $carpeta->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="area_id">Área</label>
                        <select name="area_id" id="area_id" required>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->nombre_area }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="numero_hojas">Número de Hojas</label>
                        <input type="number" name="numero_hojas" id="numero_hojas" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <!-- Campo oculto para enviar "Disponible" como estado -->
                        <input type="hidden" name="estado" value="Disponible">
                        <span id="estado" class="estado-valor">Disponible</span> 
                    </div>
                    
                    <div class="form-group">
                        <label for="fecha_creacion">Fecha de Creación</label>
                        <input type="date" name="fecha_creacion" id="fecha_creacion" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-guardar">Guardar Documento</button>
                        <button type="button" class="btn-cancelar">Cancelar</button>

                    </div>
                </form>

            </div>
        </div>
    </div>

    <style>
        :root {
            --color-guinda: #800020;
            --color-guinda-claro: #A84460;
            --color-blanco: #FFFFFF;
            --color-fondo: #F8F4F4;
            --color-texto: #333333;
            --sombra-suave: 0 4px 8px rgba(128, 0, 32, 0.1);
            --color-boton-hover: #A84460;
            --color-boton-activo: #6C2A4E;
            --color-negro: #000000;
            /* Negro */
            --color-gris-oscuro: #2C2C2C;
            /* Gris Oscuro */
            --color-negro-suave: #333333;
            /* Negro suave */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--color-fondo);
            font-family: 'Arial', sans-serif;
        }

        .documentos-container {
            max-width: 1200px;
            margin: 2rem auto;
            background-color: var(--color-blanco);
            border-radius: 12px;
            box-shadow: var(--sombra-suave);
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--color-guinda);
        }

        .header h1 {
            color: var(--color-guinda);
            font-size: 2rem;
            font-weight: bold;
        }

        .header-details {
            text-align: right;
            color: var(--color-guinda-claro);
        }

        .add-documento-btn {
            display: flex;
            align-items: center;
            background-color: var(--color-guinda);
            color: var(--color-blanco);
            border: none;
            padding: 0.7rem 1.2rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(128, 0, 32, 0.2);
        }

        .add-documento-btn:hover {
            background-color: var(--color-guinda-claro);
            transform: translateY(-2px);
        }

        .plus-icon {
            font-weight: bold;
            margin-right: 0.5rem;
            font-size: 1.3rem;
        }

        .documentos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .documento-card {
            background-color: var(--color-blanco);
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--sombra-suave);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .documento-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(128, 0, 32, 0.2);
        }

        .documento-header {
            display: flex;
            align-items: center;
            background-color: var(--color-guinda);
            color: var(--color-blanco);
            padding: 1rem;
        }

        .documento-icon {
            margin-right: 1rem;
        }

        .documento-icon svg {
            width: 40px;
            height: 40px;
            fill: var(--color-blanco);
        }

        .documento-info h3 {
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .documento-body {
            padding: 1.5rem;
            background-color: #f9f9f9;
            border-top: 1px solid #E0E0E0;
        }

        .documento-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .documento-detail .label {
            color: var(--color-guinda);
            font-weight: bold;
        }

        .documento-actions {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background-color: var(--color-fondo);
            border-top: 1px solid #E0E0E0;
        }

        .documento-actions button {
            flex: 1;
            padding: 0.75rem;
            border: none;
            margin: 0 0.25rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Botón de Solicitar (Negro sólido) */
        .btn-solicitar {
            background-color: var(--color-negro);
            /* Negro */
            color: var(--color-blanco);
        }

        .btn-solicitar:hover {
            background-color: var(--color-gris-oscuro);
            /* Gris oscuro */
        }

        /* Botón de Devolver (Negro suave) */
        .btn-devolver {
            background-color: var(--color-negro-suave);
            /* Negro suave */
            color: var(--color-blanco);
        }

        .btn-devolver:hover {
            background-color: var(--color-negro);
            /* Negro sólido */
        }

        /* Botón de Cancelar (Gris oscuro) */
        .btn-cancelar {
            background-color: var(--color-gris-oscuro);
            /* Gris oscuro */
            color: var(--color-blanco);
        }

        .btn-cancelar:hover {
            background-color: var(--color-negro-suave);
            /* Negro suave */
        }

        /* Botón de Eliminar (Negro mate) */
        .btn-eliminar {
            background-color: var(--color-negro-suave);
            /* Negro suave */
            color: var(--color-blanco);
        }

        .btn-eliminar:hover {
            background-color: var(--color-gris-oscuro);
            /* Gris oscuro */
        }

        .no-documentos {
            grid-column: 1 / -1;
            text-align: center;
            padding: 2rem;
            background-color: var(--color-fondo);
            border-radius: 8px;
        }

        .no-documentos-icon svg {
            width: 80px;
            height: 80px;
            fill: var(--color-guinda);
            margin-bottom: 1rem;
        }

        .no-documentos h2 {
            color: var(--color-guinda);
            margin-bottom: 0.5rem;
            font-size: 1.6rem;
        }

        .btn-agregar-primero {
            margin-top: 1rem;
            background-color: var(--color-guinda);
            color: var(--color-blanco);
            border: none;
            padding: 0.7rem 1.2rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-agregar-primero:hover {
            background-color: var(--color-guinda-claro);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: var(--color-blanco);
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            box-shadow: var(--sombra-suave);
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 10px;
            right: 15px;
            color: var(--color-guinda);
            font-size: 2rem;
            cursor: pointer;
        }

        .modal-content h2 {
            color: var(--color-guinda);
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.6rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--color-guinda);
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.7rem;
            border: 1px solid #E0E0E0;
            border-radius: 6px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
        }

        .btn-guardar,
        .btn-cancelar {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-guardar {
            background-color: var(--color-guinda);
            color: var(--color-blanco);
        }

        .btn-cancelar {
            background-color: #6C757D;
            color: var(--color-blanco);
        }

        .btn-guardar:hover {
            background-color: var(--color-guinda-claro);
        }

        .btn-cancelar:hover {
            background-color: #5A6268;
        }

        @media (max-width: 768px) {
            .header {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .header-details {
                align-items: center;
                margin: 1rem 0;
            }

            .documentos-grid {
                grid-template-columns: 1fr;
            }
        }

        .documento-actions button {
            flex: 1;
            padding: 0.75rem;
            border: none;
            margin: 0 0.25rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: var(--color-blanco);
        }

        /* Botón de Solicitar */
        .btn-solicitar {
            background-color: var(--color-guinda-claro);
        }

        .btn-solicitar:hover {
            background-color: var(--color-guinda);
        }

        /* Botón de Devolver */
        .btn-devolver {
            background-color: var(--color-guinda);
        }

        .btn-devolver:hover {
            background-color: var(--color-guinda-claro);
        }

        /* Botón de Cancelar */
        .btn-cancelar {
            background-color: #6C2A4E;
            /* Dark guinda */
            color: var(--color-blanco);
        }

        .btn-cancelar:hover {
            background-color: var(--color-guinda);
        }

        /* Botón de Eliminar */
        .btn-eliminar {
            background-color: #6C2A4E;
            /* Dark guinda */
            color: var(--color-blanco);
        }

        .btn-eliminar:hover {
            background-color: var(--color-guinda);
        }
    </style>


    <script>
        function confirmarEliminacionDocumento(documentoId) {
            // Primera confirmación
            Swal.fire({
                title: '<strong>¡ADVERTENCIA!</strong>',
                html: '<p style="font-size: 1.2rem; color: #d9534f; font-weight: bold;">Estás a punto de BORRAR permanentemente este documento. Esta acción no se puede deshacer.</p>',
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
                    // Segunda confirmación
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
                            // Si el usuario confirma, se envía el formulario para eliminar el documento
                            document.getElementById('eliminar-form-' + documentoId).submit();
                        }
                    });
                }
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
    const addDocumentoBtn = document.querySelector('.add-documento-btn');
    const documentoModal = document.getElementById('documentoModal');
    const closeModalBtn = documentoModal.querySelector('.close-modal');
    const cancelModalBtns = documentoModal.querySelectorAll('.btn-cancelar'); // Cambio importante: usar querySelectorAll

    // Función para abrir el modal
    function openModal() {
        documentoModal.style.display = 'flex';
    }

    // Función para cerrar el modal
    function closeModal() {
        documentoModal.style.display = 'none';
    }

    // Event listeners para abrir y cerrar el modal
    addDocumentoBtn.addEventListener('click', openModal);
    
    // Usar forEach para agregar el evento a todos los botones de cancelar
    cancelModalBtns.forEach(btn => {
        btn.addEventListener('click', function(event) {
            event.preventDefault(); // Previene el comportamiento predeterminado
            closeModal();
        });
    });

    // Event listener para el botón de cerrar (X)
    closeModalBtn.addEventListener('click', closeModal);

    // Cerrar el modal si se hace clic fuera de él
    documentoModal.addEventListener('click', function(event) {
        if (event.target === documentoModal) {
            closeModal();
        }
    });
});
    </script>
@endsection
