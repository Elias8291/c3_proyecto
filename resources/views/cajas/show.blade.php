@extends('layouts.app')

<style>
    :root {
        --guinda: #800020;
        --guinda-light: #a3324d;
        --guinda-dark: #590016;
        --cream: #ffffff;
        --gold: #f7f7f7;
        --gray-text: #4a4a4a;
        --shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .preview-container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 1.5rem;
        background: var(--cream);
        border-radius: 12px;
    }

    .title-section {
        background: var(--guinda);
        margin: -1.5rem -1.5rem 1.5rem;
        padding: 1.5rem;
        border-radius: 12px 12px 0 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .title-section h1 {
        color: white;
        font-size: 1.75rem;
        margin: 0;
        font-weight: 600;
    }

    .info-list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: var(--shadow);
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem;
        border-bottom: 1px solid rgba(128, 0, 32, 0.1);
    }

    .info-label {
        color: var(--guinda);
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 120px;
    }

    .info-value {
        color: var(--gray-text);
        font-size: 0.95rem;
    }

    .folders-section {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: var(--shadow);
    }

    .section-title {
        color: var(--guinda);
        font-size: 1.25rem;
        margin: 0 0 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--guinda);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .folders-list {
        display: grid;
        gap: 1rem;
    }

    .folder-item {
        display: grid;
        grid-template-columns: auto 1fr auto;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: var(--cream);
        border-radius: 6px;
        transition: transform 0.2s ease;
    }

    .folder-item:hover {
        transform: translateX(5px);
        background: #ffffff;
    }

    .folder-icon {
        color: var(--guinda);
        font-size: 1.5rem;
    }

    .folder-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .folder-number {
        font-weight: 600;
        color: var(--guinda-dark);
    }

    .folder-evaluado {
        font-size: 0.9rem;
        color: var(--gray-text);
    }

    .folder-docs {
        background: var(--guinda-light);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.85rem;
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--guinda);
    }

    @media (max-width: 768px) {
        .info-list {
            grid-template-columns: 1fr;
        }
        
        .preview-container {
            margin: 1rem;
            padding: 1rem;
        }
    }
</style>

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

<div class="preview-container">
    <div class="title-section">
        <i class="bi bi-archive-fill"></i>
        <h1>Vista Previa de Caja</h1>
    </div>

    <div class="info-list">
        <div class="info-item">
            <div class="info-label">
                <i class="bi bi-box-seam"></i>
                Número de Caja
            </div>
            <div class="info-value">{{ $caja->numero_caja }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">
                <i class="bi bi-calendar2-month"></i>
                Mes
            </div>
            <div class="info-value">{{ $caja->mes }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">
                <i class="bi bi-calendar"></i>
                Año
            </div>
            <div class="info-value">{{ $caja->anio }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">
                <i class="bi bi-geo-alt"></i>
                Ubicación
            </div>
            <div class="info-value">{{ $caja->ubicacion }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">
                <i class="bi bi-sort-alpha-down"></i>
                Rango
            </div>
            <div class="info-value">{{ $caja->rango_alfabetico }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">
                <i class="bi bi-folder"></i>
                Máx. Carpetas
            </div>
            <div class="info-value">{{ $caja->maximo_carpetas }}</div>
        </div>
    </div>

    <div class="folders-section">
        <h2 class="section-title">
            <i class="bi bi-folder2-open"></i>
            Carpetas en esta caja
        </h2>

        @if($caja->carpetas->count())
        <div class="folders-list">
            @foreach($caja->carpetas as $carpeta)
            <div class="folder-item">
                <i class="bi bi-folder-fill folder-icon"></i>
                <div class="folder-info">
                    <div class="folder-number">Carpeta {{ $carpeta->numero_carpeta }}</div>
                    <div class="folder-evaluado">
                        @if($carpeta->evaluado)
                            {{ $carpeta->evaluado->primer_nombre }} {{ $carpeta->evaluado->segundo_nombre }}
                            {{ $carpeta->evaluado->primer_apellido }} {{ $carpeta->evaluado->segundo_apellido}}
                        @else
                            Sin información de evaluado
                        @endif
                    </div>
                </div>
                <div class="folder-docs">
                    {{ $carpeta->documentos->count() }} docs
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="bi bi-folder-x"></i>
            <p>No hay carpetas disponibles en esta caja.</p>
        </div>
        @endif
    </div>
</div>
@endsection