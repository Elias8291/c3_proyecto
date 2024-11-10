@extends('layouts.app')

<style>
    :root {
        --burgundy: #800020;
        --burgundy-light: #aa1835;
        --gray-light: #f8f9fa;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
        --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .custom-container {
        padding: 2rem;
        background: var(--gray-light);
        min-height: 100vh;
    }

    .main-card {
        border: none;
        box-shadow: var(--shadow-lg);
        border-radius: 16px;
        background: white;
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .main-card .card-header {
        background: linear-gradient(135deg, var(--burgundy) 0%, #4a0012 100%);
        color: white;
        padding: 2rem;
        border-bottom: none;
        position: relative;
    }

    .main-card .card-title {
        font-size: 2rem;
        margin: 0;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .box-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        padding: 1.5rem;
        background: white;
        border-radius: 12px;
        margin-bottom: 2rem;
    }

    .info-card {
        background: var(--gray-light);
        padding: 1.25rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-sm);
    }

    .info-label {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-value {
        font-size: 1.2rem;
        color: var(--burgundy);
        font-weight: 600;
    }

    .folders-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        padding: 1.5rem;
    }

    .folder-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .folder-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .folder-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .folder-icon {
        font-size: 2rem;
        color: var(--burgundy);
    }

    .folder-number {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2d3748;
    }

    .folder-details {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .folder-detail-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #4a5568;
        font-size: 0.95rem;
    }

    .section-title {
        color: var(--burgundy);
        font-size: 1.5rem;
        font-weight: 700;
        margin: 2rem 0 1rem;
        padding-left: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: var(--gray-light);
        border-radius: 12px;
        margin: 1.5rem;
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--burgundy);
        margin-bottom: 1rem;
    }

    .empty-state p {
        font-size: 1.1rem;
        color: #666;
        margin: 0;
    }

    @media (max-width: 768px) {
        .custom-container {
            padding: 1rem;
        }

        .box-info-grid {
            grid-template-columns: 1fr;
        }

        .folders-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<div class="custom-container">
    <div class="main-card">
        <div class="card-header">
            <h1 class="card-title">
                <i class="bi bi-archive"></i>
                Vista Previa de Caja
            </h1>
        </div>
        <div class="card-body">
            <div class="box-info-grid">
                <div class="info-card">
                    <div class="info-label">
                        <i class="bi bi-box-seam"></i>
                        Número de Caja
                    </div>
                    <div class="info-value">{{ $caja->numero_caja }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">
                        <i class="bi bi-calendar2-month"></i>
                        Mes
                    </div>
                    <div class="info-value">{{ $caja->mes }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">
                        <i class="bi bi-calendar"></i>
                        Año
                    </div>
                    <div class="info-value">{{ $caja->anio }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">
                        <i class="bi bi-geo-alt-fill"></i>
                        Ubicación
                    </div>
                    <div class="info-value">{{ $caja->ubicacion }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">
                        <i class="bi bi-sort-alpha-down"></i>
                        Rango Alfabético
                    </div>
                    <div class="info-value">{{ $caja->rango_alfabetico }}</div>
                </div>
                <div class="info-card">
                    <div class="info-label">
                        <i class="bi bi-folder"></i>
                        Máximo de Carpetas
                    </div>
                    <div class="info-value">{{ $caja->maximo_carpetas }}</div>
                </div>
            </div>

            <h2 class="section-title">
                <i class="bi bi-folder2-open"></i>
                Carpetas en esta caja
            </h2>

            @if($caja->carpetas->count())
            <div class="folders-grid">
                @foreach($caja->carpetas as $carpeta)
                <div class="folder-card">
                    <div class="folder-header">
                        <i class="bi bi-folder-fill folder-icon"></i>
                        <div class="folder-number">Carpeta {{ $carpeta->numero_carpeta }}</div>
                    </div>
                    <div class="folder-details">
                        <div class="folder-detail-item">
                            <i class="bi bi-person"></i>
                            @if($carpeta->evaluado)
                            {{ $carpeta->evaluado->primer_nombre }} {{ $carpeta->evaluado->segundo_nombre }} {{
                            $carpeta->evaluado->primer_apellido }} {{ $carpeta->evaluado->segundo_apellido}}
                            @else
                            Sin información de evaluado
                            @endif
                        </div>
                        <div class="folder-detail-item">
                            <i class="bi bi-hash"></i>
                            {{ $carpeta->documentos->count() }} documentos
                        </div>
                        
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
</div>
@endsection