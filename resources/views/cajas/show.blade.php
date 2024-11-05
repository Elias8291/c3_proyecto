@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Caja #{{ $caja->numero_caja }} - {{ $caja->mes }} {{ $caja->anio }}</h1>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <p><strong>Ubicación:</strong> {{ $caja->ubicacion }}</p>
                <p><strong>Rango Alfabético:</strong> {{ $caja->rango_alfabetico }}</p>
            </div>
            <div class="mb-4">
                <h2 class="h4 mb-3">Carpetas en esta caja:</h2>
                @if($caja->carpetas->count())
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($caja->carpetas as $carpeta)
                    <div class="col">
                        <div class="card shadow-sm border-0 h-100 folder">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0 text-primary">Carpeta #{{ $carpeta->id }}</h5>
                                
                                </div>
                                <div class="mb-2">
                                    <p class="card-text mb-1 text-secondary">
                                        <i class="bi bi-person-circle me-2"></i>
                                        <strong>Evaluado:</strong> {{ $carpeta->evaluado->nombre ?? 'Sin nombre' }}
                                    </p>
                                    <p class="card-text mb-1 text-secondary">
                                        <i class="bi bi-file-earmark me-2"></i>
                                        <strong>Número de Hojas:</strong> {{ $carpeta->documento->numero_hojas ?? 'N/A' }}
                                    </p>
                                    <p class="card-text mb-1 text-secondary">
                                        <i class="bi bi-clipboard-check me-2"></i>
                                        <strong>Motivo de Evaluación:</strong> {{ $carpeta->documento->motivo_evaluacion ?? 'N/A' }}
                                    </p>
                                    <p class="card-text mb-0 text-secondary">
                                        <i class="bi bi-calendar2 me-2"></i>
                                        <strong>Fecha de Creación:</strong> {{ $carpeta->documento->fecha_creacion ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info">No hay carpetas en esta caja.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .folder {
      position: relative;
      background-color: #e0f7fa; /* Cambio a un tono azul claro */
      border-radius: 6px 6px 4px 4px;
      padding: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-top: 30px;
    }
  
    .folder:before {
      content: "";
      position: absolute;
      top: -20px;
      left: 15px;
      width: 80px;
      height: 20px;
      background-color: #fcc30b; /* Un tono más oscuro para la pestaña */
      border-radius: 6px 6px 0 0;
      box-shadow: -2px -2px 5px rgba(0, 0, 0, 0.1);
    }
  
    .folder .card-body {
      padding-top: 1.5rem;
    }
  
    .folder .card-title {
      font-size: 1.25rem;
      font-weight: bold;
      color: #000000; /* Azul oscuro */
    }
  
    .folder .card-text {
      font-size: 0.9rem;
      color: #6c757d;
    }
  
    .folder .btn-group .btn {
      font-size: 0.8rem;
      background-color: #006064; /* Azul oscuro */
      border-color: #006064;
      color: #fff;
    }
  
    .folder .btn-group .btn:hover {
      background-color: #004d40; /* Tono más oscuro al hacer hover */
      border-color: #004d40;
    }
  
    .folder .bi {
      font-size: 1rem;
      vertical-align: text-bottom;
      color: #6c757d;
    }
  </style>
  