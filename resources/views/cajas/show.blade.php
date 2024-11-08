@extends('layouts.app')

<style>
    :root {
        --burgundy: #800020;
        --burgundy-light: #aa1835;
        --burgundy-dark: #4a0012;
        --cream: #fff5f5;
        --gray-light: #f8f9fa;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .custom-container {
        padding: 2rem;
        background: linear-gradient(135deg, var(--cream) 0%, #ffffff 100%);
        min-height: 100vh;
    }

    .main-card {
        border: none;
        box-shadow: var(--shadow-md);
        border-radius: 16px;
        overflow: hidden;
        background: white;
        margin-bottom: 2rem;
    }

    .main-card .card-header {
        background: linear-gradient(135deg, var(--burgundy) 0%, var(--burgundy-dark) 100%);
        color: white;
        padding: 2rem;
        border-bottom: none;
        position: relative;
    }

    .main-card .card-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background-color: var(--burgundy-light);
        border-radius: 2px;
    }

    .main-card .card-title {
        font-size: 2rem;
        margin: 0;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .location-info {
        background: var(--gray-light);
        padding: 1.75rem;
        border-radius: 12px;
        margin-bottom: 2.5rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .location-info p {
        margin-bottom: 0.75rem;
        font-size: 1.15rem;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .location-info p:last-child {
        margin-bottom: 0;
    }

    .folders-section h2 {
        color: var(--burgundy);
        font-weight: 700;
        margin-bottom: 2rem;
        padding-bottom: 0.75rem;
        border-bottom: 3px solid var(--burgundy);
        position: relative;
    }

    .folder {
        transition: all 0.3s ease;
        border-radius: 12px;
        background: white;
    }

    .folder:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .folder .card-body {
        padding: 1.75rem;
    }

    .folder .card-title {
        color: var(--burgundy);
        font-weight: 700;
        font-size: 1.35rem;
        margin-bottom: 1.25rem;
        border-bottom: 2px solid var(--burgundy-light);
        padding-bottom: 0.5rem;
    }

    .folder .card-text {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #4a5568;
        font-size: 1.05rem;
    }

    .folder i {
        color: var(--burgundy);
        font-size: 1.2rem;
    }

    .alert-info {
        background-color: #f0f9ff;
        border-left: 4px solid var(--burgundy);
        color: var(--burgundy-dark);
        padding: 1.25rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 1.1rem;
        box-shadow: var(--shadow-sm);
    }

    .folder-info-item {
        padding: 0.5rem 0;
        border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
    }

    .folder-info-item:last-child {
        border-bottom: none;
    }

    @media (max-width: 768px) {
        .custom-container {
            padding: 1rem;
        }
        
        .main-card .card-header {
            padding: 1.5rem;
        }
        
        .main-card .card-title {
            font-size: 1.5rem;
        }
    }
</style>

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<div class="custom-container">
    <div class="main-card card">
        <div class="card-header">
            <h1 class="card-title">
                <i class="bi bi-archive me-2"></i>
                Caja #{{ $caja->numero_caja }} - {{ $caja->mes }} {{ $caja->anio }}
            </h1>
        </div>
        <div class="card-body">
            <div class="location-info">
                <p>
                    <i class="bi bi-geo-alt-fill"></i>
                    <strong>Ubicación:</strong> {{ $caja->ubicacion }}
                </p>
                <p>
                    <i class="bi bi-sort-alpha-down"></i>
                    <strong>Rango Alfabético:</strong> {{ $caja->rango_alfabetico }}
                </p>
            </div>
            
            <div class="folders-section">
                <h2>
                    <i class="bi bi-folder2-open me-2"></i>
                    Carpetas en esta caja
                </h2>
                @if($caja->carpetas->count())
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($caja->carpetas as $carpeta)
                        <div class="col">
                            <div class="card shadow-sm border-0 h-100 folder">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="bi bi-folder me-2"></i>
                                        Carpeta #{{ $carpeta->id }}
                                    </h5>
                                    <div class="folder-info-item">
                                      <p class="card-text">
                                          <i class="bi bi-person-circle"></i>
                                          <span><strong>Evaluado:</strong> {{ $carpeta->evaluado->nombre_completo ?? 'Sin nombre' }}</span>
                                      </p>
                                  </div>
                                  
                                    <div class="folder-info-item">
                                      <p class="card-text">
                                          <i class="bi bi-file-earmark-text"></i>
                                          <span><strong>Número de Hojas:</strong> {{ $carpeta->documentos->first()->numero_hojas ?? 'N/A' }}</span>
                                      </p>
                                  </div>
                                
                                  <div class="folder-info-item">
                                      <p class="card-text">
                                          <i class="bi bi-calendar2"></i>
                                          <span><strong>Creación:</strong> {{ $carpeta->documentos->first()->fecha_creacion ?? 'N/A' }}</span>
                                      </p>
                                  </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle fs-4"></i>
                        <span>No hay carpetas disponibles en esta caja.</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection