@extends('layouts.app')

@section('title', 'Documentos de la Carpeta')

@section('content')
    <div class="documentos-container">
        <div class="header">
            <div class="text-left mb-4">
                <a href="{{ route('cajas.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
            <h1>Documentos de Carpeta</h1>
            <div class="header-details">
                <span class="carpeta-id">Carpeta #{{ $carpeta->id }}</span>
                <span class="evaluado-nombre">{{ $carpeta->evaluado->nombre }}</span>
            </div> 
            <div class="add-documento-container">
                <button class="add-documento-btn" onclick="openDocumentoModal()">
                    <span class="plus-icon">+</span>
                    Nuevo Documento
                </button>
            </div>

            

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
                        @if ($documento->pdf_url)
                            <div class="documento-detail pdf-detail">
                                <span class="label">Documento PDF</span>
                                <button class="icon-pdf"
                                    onclick="mostrarPdf('{{ asset('storage/' . $documento->pdf_url) }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="pdf-icon">
                                        <path
                                            d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z" />
                                    </svg>
                                </button>
                            </div>
                        @else
                            <div class="documento-detail pdf-detail">
                                <span class="label">Documento PDF</span>
                                <button class="btn-agregar-pdf" onclick="mostrarModalAgregarPdf({{ $documento->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16"
                                        height="16" fill="currentColor">
                                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                                    </svg>

                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="documento-actions">
                        @if ($documento->estado == 'Disponible')
                            <button class="btn-solicitar"
                                onclick="solicitarPrestamo({{ $documento->id }})">Solicitar</button>
                        @elseif($documento->estado == 'Prestado')
                            <button onclick="devolverPrestamo({{ $documento->id }})" class="btn-devolver">Devolver</button>
                        @elseif($documento->estado == 'Solicitado')
                            <button class="btn-cancelar"
                                onclick="cancelarSolicitud({{ $documento->id }})">Cancelar</button>
                        @endif

                        @if ($documento->estado != 'Solicitado')
                        <button class="btn-eliminar" 
                        onclick="confirmarEliminacionDocumento({{ $documento->id }})">
                        Eliminar
                    </button>
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
                <span class="close-modal" onclick="closeDocumentoModal()">&times;</span>
                <h2>Agregar Nuevo Documento</h2>
                <form id="documentoForm" action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Campo oculto para el ID de la carpeta -->
                    <input type="hidden" name="id_carpeta" value="{{ $carpeta->id }}">
                    <!-- Campo oculto para el ID del evaluado -->
                    <input type="hidden" name="id_evaluado" value="{{ $carpeta->evaluado->id }}">
                    
                    <div class="mb-3">
                        <label for="id_area" class="form-label">Área</label>
                        <select class="form-select" id="id_area" name="id_area" required>
                            <option value="">Seleccione un área</option>
                            @foreach(\App\Models\Area::all() as $area)
                                <option value="{{ $area->id }}">{{ $area->nombre_area }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="numero_hojas" class="form-label">Número de Hojas</label>
                        <input type="number" class="form-control" id="numero_hojas" name="numero_hojas" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="fecha_creacion" class="form-label">Fecha de Creación</label>
                        <input type="date" class="form-control" id="fecha_creacion" name="fecha_creacion" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="pdf_file" class="form-label">Documento PDF (Opcional)</label>
                        <div class="pdf-upload-container">
                            <input type="file" 
                                   class="form-control" 
                                   id="pdf_file" 
                                   name="pdf_url" 
                                   accept="application/pdf">
                            <small class="text-muted">Formato permitido: PDF. Tamaño máximo: 2MB</small>
                        </div>
                    </div>
        
                    <!-- Campo oculto para el estado -->
                    <input type="hidden" name="estado" value="Disponible">
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-guardar">Guardar</button>
                        <button type="button" class="btn-cancelar" onclick="closeDocumentoModal()">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
        

        <!-- Modal para mostrar PDF -->
        <div id="pdfModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close-modal" onclick="cerrarPdfModal()">&times;</span>
                <h2>Vista del Documento PDF</h2>
                <iframe id="pdfViewer" src="" width="100%" height="500px" style="border: none;"></iframe>
            </div>
        </div>

        <div id="agregarPdfModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="cerrarModalAgregarPdf()">&times;</span>
                <h2>Agregar PDF al Documento</h2>
                <form id="pdfUploadForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="pdf_file" class="form-label">Seleccionar archivo PDF</label>
                        <input type="file" name="pdf_url" id="pdf_file" class="form-control" accept="application/pdf"
                            required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Guardar PDF</button>
                        <button type="button" class="btn btn-secondary" onclick="cerrarModalAgregarPdf()">Cancelar</button>
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
            transition: opacity 0.3s ease;
            /* Suave transición de opacidad */
        }

        .modal.show {
            display: block;
            opacity: 1;
            /* Mostrar el modal con transición */
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
            position: relative;
            animation: slideDown 0.3s ease-out;
            /* Animación de entrada */
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
            width: 90%;
            /* Ajusta el ancho del modal */
            max-width: 1200px;
            /* Máximo ancho */
            height: 80%;
            /* Altura del modal */
            max-height: 90%;
            /* Máximo alto */
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

        .form-control,
        .form-select {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #ffffff;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--color-guinda);
            box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
        }

        .form-control:hover,
        .form-select:hover {
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
            max-width: 1400px;
            /* Aumentado de 1200px */
            height: 90vh;
            /* Aumentado de 80% */
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
            height: calc(90vh - 6rem);
            /* Altura total menos el espacio del header */
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
            background-color: #2E7D32;
            /* Verde oscuro */
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
            background-color: #1B5E20;
            /* Verde más oscuro para hover */
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

        .btn-back {
            display: inline-flex;
            align-items: center;
            color: #800020;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-back i {
            margin-right: 8px;
        }

        .btn-back:hover {
            color: #b30000;
        }

        .btn-agregar-pdf {
            background-color: var(--color-guinda);
            color: white;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(128, 0, 32, 0.2);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-agregar-pdf:hover {
            background-color: var(--color-guinda-claro);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(128, 0, 32, 0.3);
        }

        .btn-agregar-pdf:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(128, 0, 32, 0.2);
        }

        .btn-agregar-pdf i {
            font-size: 1.1rem;
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .btn-agregar-pdf {
                padding: 0.6rem 0.8rem;
                font-size: 0.9rem;
            }
        }

        .pdf-detail {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e0e0e0;
        }

        .icon-pdf {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--color-guinda);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .icon-pdf:hover {
            background: var(--color-guinda-claro);
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(128, 0, 32, 0.2);
        }

        .icon-pdf .pdf-icon {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        .icon-pdf span {
            font-weight: 500;
        }

        /* Ajustes para el modal del PDF */
        #pdfModal .modal-content {
            width: 95%;
            max-width: 1200px;
            height: 90vh;
            margin: 2vh auto;
        }

        #pdfViewer {
            width: 100%;
            height: calc(90vh - 100px);
            border: none;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .pdf-detail {
                flex-direction: column;
                align-items: flex-start;
            }

            .icon-pdf {
                margin-top: 0.5rem;
                width: 100%;
                justify-content: center;
            }
        }

        #agregarPdfModal .modal-content {
            max-width: 500px;
        }

        #pdfUploadForm .form-label {
            color: var(--color-guinda);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        #pdfUploadForm input[type="file"] {
            border: 2px dashed var(--color-guinda);
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #pdfUploadForm input[type="file"]:hover {
            border-color: var(--color-guinda-claro);
            background-color: rgba(128, 0, 32, 0.05);
        }
    </style>

    <script>
        // Función para manejar la búsqueda en tiempo real
        document.getElementById('searchInput').addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const folderItems = document.querySelectorAll('[data-search-content]');

            folderItems.forEach(folder => {
                const content = folder.textContent.toLowerCase();
                folder.style.display = content.includes(searchTerm) ? 'flex' : 'none';
            });
        });

        function confirmarEliminacionDocumento(documentoId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción eliminará permanentemente el documento",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#800020',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Obtener el formulario
            const form = document.getElementById(`eliminar-form-${documentoId}`);
            if (!form) {
                console.error('Formulario no encontrado');
                return;
            }

            // Asegurarse que el CSRF token esté presente
            const token = document.querySelector('meta[name="csrf-token"]').content;
            if (!form.querySelector('input[name="_token"]')) {
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = token;
                form.appendChild(csrfInput);
            }

            // Mostrar loading mientras se procesa
            Swal.fire({
                title: 'Eliminando...',
                text: 'Por favor espere',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Enviar el formulario
            form.submit();
        }
    });
}
        // Función para confirmar eliminación con doble verificación
        async function confirmarEliminacion(carpetaId) {
            try {
                // Primera confirmación
                const firstResult = await Swal.fire({
                    title: '¿Eliminar carpeta?',
                    html: `
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p class="mb-0" style="font-size: 1.1rem;">
                        Esta acción eliminará permanentemente la carpeta y todos sus documentos asociados.
                    </p>
                </div>
            `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'swal2-warning-custom',
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    }
                });

                if (firstResult.isConfirmed) {
                    // Segunda confirmación
                    const finalResult = await Swal.fire({
                        title: 'Confirmar eliminación',
                        html: `
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <p class="mb-0" style="font-size: 1.1rem;">
                            ¿Está completamente seguro de eliminar esta carpeta?
                            <br>
                            <strong>Esta acción no se puede deshacer.</strong>
                        </p>
                    </div>
                `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar definitivamente',
                        cancelButtonText: 'Cancelar',
                        customClass: {
                            popup: 'swal2-danger-custom',
                            confirmButton: 'btn btn-danger',
                            cancelButton: 'btn btn-secondary'
                        }
                    });

                    if (finalResult.isConfirmed) {
                        // Mostrar indicador de carga
                        Swal.fire({
                            title: 'Eliminando...',
                            html: 'Por favor espere mientras se elimina la carpeta',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Enviar el formulario
                        const form = document.getElementById(`eliminar-form-${carpetaId}`);
                        if (form) {
                            form.submit();
                        } else {
                            throw new Error('Formulario no encontrado');
                        }
                    }
                }
            } catch (error) {
                console.error('Error en el proceso de eliminación:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Ocurrió un error al intentar eliminar la carpeta',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
            }
        }

        let documentoIdActual;

        function mostrarModalAgregarPdf(documentoId) {
    const modal = document.getElementById('agregarPdfModal');
    const form = document.getElementById('pdfUploadForm');
    
    // Establecer la URL correcta para el formulario
    form.action = `/documentos/${documentoId}/agregar-pdf`;
    
    // Mostrar el modal con animación
    modal.style.display = 'block';
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
}

function cerrarModalAgregarPdf() {
    const modal = document.getElementById('agregarPdfModal');
    
    // Quitar la clase show para la animación
    modal.classList.remove('show');
    
    // Esperar a que termine la animación antes de ocultar
    setTimeout(() => {
        modal.style.display = 'none';
        document.getElementById('pdfUploadForm').reset(); // Limpiar el formulario
    }, 300);
}

// Manejar el envío del formulario de PDF
document.getElementById('pdfUploadForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;
    
    try {
        // Validar el archivo
        const fileInput = this.querySelector('input[type="file"]');
        const file = fileInput.files[0];
        
        if (!file) {
            Swal.fire({
                icon: 'error',
                title: 'No se ha seleccionado ningún archivo',
                text: 'Por favor, selecciona un archivo PDF',
                confirmButtonColor: '#800020'
            });
            return;
        }
        
        if (file.type !== 'application/pdf') {
            const fileType = file.type || 'tipo desconocido';
            Swal.fire({
                icon: 'error',
                title: 'Tipo de archivo no válido',
                text: 'Solo se permiten archivos PDF',
                footer: `Tipo de archivo detectado: ${fileType}`,
                confirmButtonColor: '#800020'
            });
            fileInput.value = ''; // Limpiar el input
            return;
        }
        
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
            Swal.fire({
                icon: 'error',
                title: 'Archivo demasiado grande',
                text: 'El archivo no debe superar los 2MB',
                footer: `Tamaño actual: ${fileSizeMB}MB`,
                confirmButtonColor: '#800020'
            });
            fileInput.value = ''; // Limpiar el input
            return;
        }
        
        // Mostrar estado de carga
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            Subiendo...
        `;
        
        const response = await fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'PDF agregado correctamente',
                text: 'El archivo se ha subido con éxito',
                timer: 1500,
                showConfirmButton: false,
                confirmButtonColor: '#800020'
            }).then(() => {
                window.location.reload();
            });
        } else {
            throw new Error(data.message || 'Error al subir el PDF');
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error en la subida',
            text: error.message,
            confirmButtonColor: '#800020'
        });
    } finally {
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
    }
});
// Cerrar modales al hacer clic fuera
window.onclick = function(event) {
    const pdfModal = document.getElementById('pdfModal');
    const agregarPdfModal = document.getElementById('agregarPdfModal');
    const documentoModal = document.getElementById('documentoModal');

    if (event.target === pdfModal) {
        cerrarPdfModal();
    } else if (event.target === agregarPdfModal) {
        cerrarModalAgregarPdf();
    } else if (event.target === documentoModal) {
        closeDocumentoModal();
    }
};

// Validación del archivo antes de enviar
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function(e) {
        const file = this.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (file) {
            if (file.type !== 'application/pdf') {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo no válido',
                    text: 'Por favor, selecciona un archivo PDF'
                });
                this.value = '';
                return;
            }

            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo demasiado grande',
                    text: 'El archivo no debe superar los 2MB'
                });
                this.value = '';
                return;
            }
        }
    });
});



        // Validación del archivo antes de enviar
        document.getElementById('pdf_file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const maxSize = 2 * 1024 * 1024; // 2MB en bytes

            if (file && file.type !== 'application/pdf') {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo no válido',
                    text: 'Por favor, selecciona un archivo PDF'
                });
                this.value = '';
                return;
            }

            if (file && file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo demasiado grande',
                    text: 'El archivo no debe superar los 2MB'
                });
                this.value = '';
            }
        });

        document.getElementById('id_area').addEventListener('change', function() {
            const selectedArea = this.value;

            fetch(`/api/carpeta/${carpetaId}/check-area/${selectedArea}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.available) {
                        alert('El área seleccionada ya tiene un documento en esta carpeta.');
                        this.value = '';
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        function solicitarPrestamo(documentoId) {
            fetch('/prestamos/solicitar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        documento_id: documentoId
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false,
                        }).then(() => {
                            location.reload(); // Recargar la página para reflejar cambios
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un problema al realizar la solicitud.',
                    });
                });
        }

        function cancelarSolicitud(documentoId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas cancelar esta solicitud de préstamo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#800020',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'No, mantener'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Primero, obtener el préstamo asociado al documento
                    fetch(`/prestamos/cancelar-por-documento/${documentoId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: data.message,
                                    timer: 1500,
                                    showConfirmButton: false,
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'Error al cancelar la solicitud'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un problema al cancelar la solicitud.'
                            });
                        });
                }
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            // Get modal elements
            const addDocumentoBtn = document.querySelector('.add-documento-btn');
            const documentoModal = document.getElementById('documentoModal');
            const closeModalBtn = documentoModal.querySelector('.close-modal');
            const cancelarBtn = documentoModal.querySelector('.btn-secondary');

            // Function to open modal
            function openModal() {
                documentoModal.style.display = 'flex';
                documentoModal.classList.add('show');
                // Reset form if exists
                const form = documentoModal.querySelector('form');
                if (form) form.reset();
            }

            // Function to close modal
            function closeModal() {
                documentoModal.classList.remove('show');
                setTimeout(() => {
                    documentoModal.style.display = 'none';
                }, 300);
            }

            // Add click event listeners
            if (addDocumentoBtn) {
                addDocumentoBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    openModal();
                });
            }

            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeModal);
            }

            if (cancelarBtn) {
                cancelarBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeModal();
                });
            }

            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target === documentoModal) {
                    closeModal();
                }
            });
        });

        function devolverPrestamo(documentoId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas devolver este préstamo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#800020',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, devolver',
                cancelButtonText: 'No, mantener'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/prestamos/devolver-por-documento/${documentoId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: data.message,
                                    timer: 1500,
                                    showConfirmButton: false,
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'Error al devolver el préstamo'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un problema al devolver el préstamo.'
                            });
                        });
                }
            });
        }

        function openDocumentoModal() {
    const modal = document.getElementById('documentoModal');
    modal.style.display = 'block';
    modal.classList.add('show');
}

function closeDocumentoModal() {
    const modal = document.getElementById('documentoModal');
    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

// Cerrar modal al hacer clic fuera de él
window.onclick = function(event) {
    const modal = document.getElementById('documentoModal');
    if (event.target == modal) {
        closeDocumentoModal();
    }
}

// Manejar el envío del formulario
document.getElementById('documentoForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Aquí puedes agregar la lógica para manejar el envío del formulario
    Swal.fire({
        title: 'Éxito',
        text: 'Documento agregado correctamente',
        icon: 'success',
        timer: 1500,
        showConfirmButton: false
    }).then(() => {
        closeDocumentoModal();
    });
});

function mostrarPdf(pdfUrl) {
    const modal = document.getElementById('pdfModal');
    const pdfViewer = document.getElementById('pdfViewer');
    
    // Establecer la URL del PDF en el visor
    pdfViewer.src = pdfUrl;
    
    // Mostrar el modal con animación
    modal.style.display = 'block';
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
}

function cerrarPdfModal() {
    const modal = document.getElementById('pdfModal');
    const pdfViewer = document.getElementById('pdfViewer');
    
    // Quitar la clase show para la animación
    modal.classList.remove('show');
    
    // Esperar a que termine la animación antes de ocultar
    setTimeout(() => {
        modal.style.display = 'none';
        pdfViewer.src = ''; // Limpiar el src del iframe
    }, 300);
}

window.onclick = function(event) {
    const pdfModal = document.getElementById('pdfModal');
    const agregarPdfModal = document.getElementById('agregarPdfModal');
    const documentoModal = document.getElementById('documentoModal');

    if (event.target === pdfModal) {
        cerrarPdfModal();
    } else if (event.target === agregarPdfModal) {
        cerrarModalAgregarPdf();
    } else if (event.target === documentoModal) {
        closeDocumentoModal();
    }
};
    </script>
@endsection
