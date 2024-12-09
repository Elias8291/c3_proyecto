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
                            <span class="label">Número de hojas</span>
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
                            <button class="btn-eliminar" onclick="confirmarEliminacionDocumento({{ $documento->id }})">Eliminar</button>
                        @endif
        
                        <!-- Botón para Ver PDF -->
                        @if ($documento->pdf_url)
                            <button class="btn-ver-pdf" onclick="mostrarPdf('{{ asset('storage/' . $documento->pdf_url) }}')">
                                Ver PDF
                            </button>
                        @endif
        
                        <!-- Formulario para eliminar el documento -->
                        <form id="eliminar-form-{{ $documento->id }}" action="{{ route('documentos.destroy', $documento->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Modal para mostrar PDF -->
        <div id="pdfModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close-modal" onclick="cerrarPdfModal()">&times;</span>
                <h2>Vista del Documento PDF</h2>
                <iframe id="pdfViewer" src="" width="100%" height="500px" style="border: none;"></iframe>
            </div>
        </div>
        

        <div id="documentoModal" class="modal">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <h2>Agregar Nuevo Documento</h2>
                <form id="documentoForm" action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Campo oculto para el ID de la carpeta -->
                    <input type="hidden" name="id_carpeta" value="{{ $carpeta->id }}">
                    
                    <!-- Campo oculto para el ID del evaluado asociado a la carpeta -->
                    <input type="hidden" name="id_evaluado" value="{{ $carpeta->id_evaluado }}">
        
                    <div class="mb-3">
                        <label for="numero_hojas" class="form-label">Número de Hojas</label>
                        <input type="text" name="numero_hojas" id="numero_hojas" class="form-control" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="fecha_creacion" class="form-label">Fecha de Creación</label>
                        <input type="date" name="fecha_creacion" id="fecha_creacion" class="form-control" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" id="estado" class="form-select" required>
                            <option value="" disabled selected>Seleccione un estado</option>
                            <option value="Disponible">Disponible</option>
                            <option value="Prestado">Prestado</option>
                            <option value="Solicitado">Solicitado</option>
                        </select>
                    </div>
        
                    <div class="mb-3">
                        <label for="id_area" class="form-label">Área</label>
                        <select name="id_area" id="id_area" class="form-select" required>
                            <option value="" disabled selected>Seleccione un área</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->nombre_area }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="mb-3">
                        <label for="pdf_url" class="form-label">Archivo PDF</label>
                        <input type="file" name="pdf_url" id="pdf_url" class="form-control" accept="application/pdf" required>
                    </div>
        
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Guardar Documento</button>
                        <button type="button" class="btn btn-secondary btn-cancelar">Cancelar</button>
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

         .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease; /* Suave transición de opacidad */
    }

    .modal.show {
        display: block;
        opacity: 1; /* Mostrar el modal con transición */
    }

    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border-radius: 10px;
        width: 80%;
        max-width: 800px;
        position: relative;
        animation: slideDown 0.3s ease-out; /* Animación de entrada */
    }

    .close-modal {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 30px;
        color: #000;
        cursor: pointer;
    }

    .close-modal:hover {
        color: #800020;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .btn-ver-pdf {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-ver-pdf:hover {
        background-color: #0056b3;
    }.modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal.show {
        display: block;
        opacity: 1;
    }

    .modal-content {
        background-color: #fff;
        margin: 3% auto;
        padding: 20px;
        border-radius: 10px;
        width: 90%; /* Ajusta el ancho del modal */
        max-width: 1200px; /* Máximo ancho */
        height: 80%; /* Altura del modal */
        max-height: 90%; /* Máximo alto */
        position: relative;
        animation: slideDown 0.3s ease-out;
    }

    .close-modal {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 30px;
        color: #000;
        cursor: pointer;
    }

    .close-modal:hover {
        color: #800020;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .btn-ver-pdf {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-ver-pdf:hover {
        background-color: #0056b3;
    }

    iframe#pdfViewer {
        width: 100%;
        height: 100%;
        border: none;
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
    align-items: center;
    justify-content: center;
}

.modal.show {
    display: flex;
}

/* Estilos mejorados para el modal de Agregar Nuevo Documento */
.modal-content {
    background: linear-gradient(to bottom right, #ffffff, #f8f8f8);
    padding: 2.5rem;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(128, 0, 32, 0.15);
    max-width: 600px;
    width: 95%;
}

.modal-content h2 {
    color: var(--color-guinda);
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 2rem;
    text-align: center;
    border-bottom: 2px solid var(--color-guinda);
    padding-bottom: 1rem;
}

.mb-3 {
    margin-bottom: 1.5rem;
    position: relative;
}

.form-label {
    display: block;
    color: var(--color-guinda);
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control, .form-select {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background-color: #ffffff;
}

.form-control:focus, .form-select:focus {
    outline: none;
    border-color: var(--color-guinda);
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
}

.form-control:hover, .form-select:hover {
    border-color: var(--color-guinda-claro);
}

/* Estilos específicos para el input type file */
input[type="file"].form-control {
    padding: 0.6rem;
    background-color: #f8f8f8;
    cursor: pointer;
}

input[type="file"].form-control::file-selector-button {
    padding: 0.5rem 1rem;
    margin-right: 1rem;
    border: none;
    border-radius: 4px;
    background-color: var(--color-guinda);
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="file"].form-control::file-selector-button:hover {
    background-color: var(--color-guinda-claro);
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e0e0e0;
}

.form-actions button {
    padding: 0.8rem 1.8rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-primary {
    background-color: var(--color-guinda);
    color: white;
    box-shadow: 0 4px 6px rgba(128, 0, 32, 0.2);
}

.btn-primary:hover {
    background-color: var(--color-guinda-claro);
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(128, 0, 32, 0.25);
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
    box-shadow: 0 4px 6px rgba(108, 117, 125, 0.2);
}

.btn-secondary:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(108, 117, 125, 0.25);
}

/* Animación para el modal */
@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal.show .modal-content {
    animation: modalFadeIn 0.4s ease-out forwards;
}

/* Estilos responsivos */
@media (max-width: 576px) {
    .modal-content {
        padding: 1.5rem;
    }

    .form-actions {
        flex-direction: column;
        gap: 0.8rem;
    }

    .form-actions button {
        width: 100%;
    }
}

/* Estilos mejorados para el modal de vista PDF */
#pdfModal .modal-content {
    width: 95%;
    max-width: 1400px; /* Aumentado de 1200px */
    height: 90vh; /* Aumentado de 80% */
    margin: 2vh auto;
    padding: 2rem;
    display: flex;
    flex-direction: column;
}

#pdfModal h2 {
    margin-bottom: 1rem;
    padding-right: 2rem;
}

#pdfModal .close-modal {
    top: 1rem;
    right: 1.5rem;
    font-size: 2rem;
    z-index: 1100;
    background: var(--color-guinda);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#pdfModal .close-modal:hover {
    background-color: var(--color-guinda-claro);
    transform: scale(1.1);
}

#pdfViewer {
    flex: 1;
    width: 100%;
    height: calc(90vh - 6rem); /* Altura total menos el espacio del header */
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Ajustes responsive */
@media (max-width: 768px) {
    #pdfModal .modal-content {
        width: 98%;
        height: 95vh;
        margin: 1vh auto;
        padding: 1rem;
    }

    #pdfViewer {
        height: calc(95vh - 5rem);
    }
}

/* Estilos modificados para el botón Ver PDF */
.btn-ver-pdf {
    background-color: #2E7D32; /* Verde oscuro */
    color: white;
    padding: 0.75rem 1rem;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(46, 125, 50, 0.2);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-ver-pdf:hover {
    background-color: #1B5E20; /* Verde más oscuro para hover */
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(46, 125, 50, 0.3);
}

.btn-ver-pdf:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(46, 125, 50, 0.2);
}

/* Para dispositivos móviles */
@media (max-width: 768px) {
    .btn-ver-pdf {
        padding: 0.6rem 0.8rem;
        font-size: 0.9rem;
    }
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
    const cancelarBtns = documentoModal.querySelectorAll('.btn-cancelar');

    function openModal() {
        documentoModal.style.display = 'flex';
        documentoModal.classList.add('show');
    }

    function closeModal() {
        documentoModal.classList.remove('show');
        setTimeout(() => {
            documentoModal.style.display = 'none';
        }, 300);
    }

    addDocumentoBtn.addEventListener('click', openModal);
    closeModalBtn.addEventListener('click', closeModal);

    cancelarBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            closeModal();
        });
    });

    // Cerrar al hacer clic fuera del modal
    documentoModal.addEventListener('click', function(e) {
        if (e.target === documentoModal) {
            closeModal();
        }
    });
});

function mostrarPdf(pdfUrl) {
        const pdfModal = document.getElementById('pdfModal');
        const pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = pdfUrl; // Asignar la URL del PDF al iframe
        pdfModal.style.display = 'block'; // Mostrar el modal
        pdfModal.classList.add('show'); // Agregar la clase para la animación
    }

    function cerrarPdfModal() {
        const pdfModal = document.getElementById('pdfModal');
        pdfModal.classList.remove('show'); // Quitar la clase para la animación
        setTimeout(() => {
            pdfModal.style.display = 'none'; // Ocultar el modal después de la animación
            document.getElementById('pdfViewer').src = ''; // Limpiar el iframe para evitar recargas
        }, 300);
    }

    // Cerrar el modal si se hace clic fuera del contenido
    window.onclick = function(event) {
        const pdfModal = document.getElementById('pdfModal');
        if (event.target === pdfModal) {
            cerrarPdfModal();
        }
    };
    </script>
@endsection