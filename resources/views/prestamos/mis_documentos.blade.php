@extends('layouts.app')

@section('title', 'Mis Documentos Prestados')

@section('content')
<div class="documentos-container">
    <div class="header">
        <div class="text-left mb-4">
            <a href="{{ route('home') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </div>
        <h1>Documentos en mi Posesión</h1>
    </div>

    <div class="documentos-grid">
        @if($prestamos->count())
            @foreach($prestamos as $prestamo)
                <div class="documento-card">
                    <div class="documento-header">
                        <div class="documento-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                        </div>
                        <div class="documento-info">
                            <h3>{{ $prestamo->documento->area->nombre_area }}</h3>
                        </div>
                    </div>
                    <div class="documento-body">
                        <div class="documento-detail">
                            <span class="label">Evaluado</span>
                            <span class="value">{{ $prestamo->documento->evaluado->primer_nombre }} 
                                {{ $prestamo->documento->evaluado->segundo_nombre }} 
                                {{ $prestamo->documento->evaluado->primer_apellido }} 
                                {{ $prestamo->documento->evaluado->segundo_apellido }}</span>
                        </div>
                        <div class="documento-detail">
                            <span class="label">Número de hojas</span>
                            <span class="value">{{ $prestamo->documento->numero_hojas }}</span>
                        </div>
                        <div class="documento-detail">
                            <span class="label">Fecha de Solicitud</span>
                            <span class="value">{{ \Carbon\Carbon::parse($prestamo->fecha_solicitud)->format('d/m/Y') }}</span>
                        </div>
                        <div class="documento-detail">
                            <span class="label">Estado</span>
                            <span class="value">{{ $prestamo->estado }}</span>
                        </div>
                        @if ($prestamo->documento->pdf_url)
                            <div class="documento-detail pdf-detail">
                                <span class="label">Documento PDF</span>
                                <button class="icon-pdf"
                                    onclick="mostrarPdf('{{ asset('storage/' . $prestamo->documento->pdf_url) }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="pdf-icon">
                                        <path d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    

                    <div class="documento-actions">
                        @if($prestamo->estado == 'Aprobado')
                            <button onclick="devolverPrestamo({{ $prestamo->documento->id }})" class="btn-devolver">Devolver</button>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-documentos">
                <div class="no-documentos-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M13 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V9l-7-7z"/>
                        <path d="M13 3v6h6"/>
                    </svg>
                </div>
                <h2>No tienes documentos prestados</h2>
                <p>Cuando solicites un préstamo, aparecerá aquí.</p>
            </div>
        @endif
    </div>

    <!-- Modal para mostrar PDF -->
    <div id="pdfModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-modal" onclick="cerrarPdfModal()">&times;</span>
            <h2>Vista del Documento PDF</h2>
            <iframe id="pdfViewer" src="" width="100%" height="500px" style="border: none;"></iframe>
        </div>
    </div>
</div>

<style>
    /* Aquí va todo el CSS que tenías en el segundo archivo */
</style>
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
        flex-direction: column;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--color-guinda);
    }
    
    .header h1 {
        color: var(--color-guinda);
        font-size: 2rem;
        font-weight: bold;
        margin: 1rem 0;
    }
    
    .btn-back {
        display: inline-flex;
        align-items: center;
        color: var(--color-guinda);
        font-size: 18px;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .btn-back:hover {
        color: var(--color-guinda-claro);
    }
    
    .btn-back i {
        margin-right: 8px;
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
        stroke: var(--color-blanco);
    }
    
    .documento-info h3 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: bold;
    }
    
    .documento-body {
        padding: 1.5rem;
        background-color: #f9f9f9;
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
        justify-content: flex-end;
        padding: 1rem;
        background-color: var(--color-fondo);
        border-top: 1px solid #E0E0E0;
    }
    
    .btn-devolver {
        background-color: var(--color-guinda);
        color: var(--color-blanco);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-devolver:hover {
        background-color: var(--color-guinda-claro);
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(128, 0, 32, 0.2);
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
    
    .no-documentos {
        grid-column: 1 / -1;
        text-align: center;
        padding: 3rem;
        background-color: var(--color-fondo);
        border-radius: 8px;
    }
    
    .no-documentos-icon svg {
        width: 80px;
        height: 80px;
        fill: none;
        stroke: var(--color-guinda);
        stroke-width: 1;
        stroke-linecap: round;
        stroke-linejoin: round;
        margin-bottom: 1rem;
    }
    
    .no-documentos h2 {
        color: var(--color-guinda);
        margin-bottom: 0.5rem;
        font-size: 1.6rem;
    }
    
    .no-documentos p {
        color: var(--color-texto);
        opacity: 0.8;
    }
    
    /* Modal Styles */
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
        opacity: 1;
    }
    
    .modal-content {
        background-color: #fff;
        margin: 2vh auto;
        padding: 2rem;
        border-radius: 10px;
        width: 90%;
        max-width: 1200px;
        height: 90vh;
        position: relative;
    }
    
    .close-modal {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-size: 2rem;
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
    
    .close-modal:hover {
        background-color: var(--color-guinda-claro);
    }
    
    #pdfViewer {
        width: 100%;
        height: calc(90vh - 100px);
        border: none;
        border-radius: 8px;
    }
    
    @media (max-width: 768px) {
        .documentos-grid {
            grid-template-columns: 1fr;
        }
        
        .header {
            text-align: center;
        }
        
        .modal-content {
            width: 95%;
            padding: 1rem;
        }
        
        #pdfViewer {
            height: calc(95vh - 80px);
        }
    }
    </style>
    
<script>
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

    function mostrarPdf(pdfUrl) {
        const modal = document.getElementById('pdfModal');
        const pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = pdfUrl;
        modal.style.display = 'block';
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
    }

    function cerrarPdfModal() {
        const modal = document.getElementById('pdfModal');
        const pdfViewer = document.getElementById('pdfViewer');
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
            pdfViewer.src = '';
        }, 300);
    }

    window.onclick = function(event) {
        const pdfModal = document.getElementById('pdfModal');
        if (event.target === pdfModal) {
            cerrarPdfModal();
        }
    };
</script>
@endsection