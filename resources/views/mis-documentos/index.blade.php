@extends('layouts.app')

@section('title', 'Mis Documentos Prestados')

@section('content')
<div class="documentos-container">
    <div class="header">
        <div class="text-left mb-4">
            <a href="{{ url('/') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </div>
        <h1>Mis Documentos Prestados</h1>
    </div>

    <div class="documentos-grid">
        @forelse ($prestamos as $prestamo)
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
                        <span class="label">Número de Hojas</span>
                        <span class="value">{{ $prestamo->documento->numero_hojas }}</span>
                    </div>
                    <div class="documento-detail">
                        <span class="label">Fecha de Préstamo</span>
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
                                    <path d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2z" />
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="documento-actions">
                    <button onclick="devolverPrestamo({{ $prestamo->documento->id }})" class="btn-devolver">Devolver</button>
                </div>
            </div>
        @empty
            <div class="no-documentos">
                <h2>No tienes documentos prestados actualmente.</h2>
            </div>
        @endforelse
    </div>
</div>

<script>
    function mostrarPdf(pdfUrl) {
        window.open(pdfUrl, '_blank');
    }

    function devolverPrestamo(documentoId) {
        fetch(`/prestamos/devolver-por-documento/${documentoId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                alert('Préstamo devuelto correctamente.');
                location.reload();
            } else {
                alert('Error al devolver el préstamo.');
            }
        });
    }
</script>
@endsection
