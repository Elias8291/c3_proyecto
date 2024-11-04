@extends('layouts.app')

@section('title', 'Editar Caja')

@section('css')
<style>
    /* Estilos reutilizados del formulario de crear */
    .container {
        max-width: 900px;
        margin: 50px auto;
        background: linear-gradient(135deg, #ffffff 0%, #fcfafa 100%);
        padding: 40px;
        box-shadow: 0 15px 35px rgba(128, 0, 32, 0.1), 0 5px 15px rgba(0, 0, 0, 0.05);
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(128, 0, 32, 0.1);
        backdrop-filter: blur(5px);
    }

    .container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #800020, #b30000);
        animation: gradient 3s linear infinite;
    }

    .page-background {
        background-color: #dbd6d7;
        padding: 60px 0;
        min-height: 100vh;
    }

    .form-label {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 10px;
        font-size: 16px;
        display: block;
    }

    .form-control {
        padding: 12px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 16px;
        background-color: #ffffff;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #800020;
        box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
    }

    .btn-submit {
        background: linear-gradient(135deg, #800020 0%, #b30000 100%);
        color: #fff;
        padding: 14px 28px;
        border: none;
        border-radius: 10px;
        font-size: 18px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
        cursor: pointer;
        text-transform: uppercase;
    }

    .form-preview {
        background: #f4e4bc;
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 2rem;
        position: relative;
    }

    .form-preview::before {
        content: 'Vista Previa';
        position: absolute;
        top: -0.75rem;
        left: 1rem;
        background: #800020;
        color: white;
        padding: 0.25rem 1rem;
        border-radius: 15px;
        font-size: 0.875rem;
    }

    .preview-content {
        display: grid;
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .preview-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.5);
        padding: 0.5rem;
        border-radius: 6px;
    }

    .preview-label {
        font-weight: 600;
        min-width: 120px;
    }
</style>
@endsection

@section('content')
<main class="profile-page">
    <section class="page-background">
        <div class="container">
            <div class="text-left mb-4">
                <a href="{{ route('cajas.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
            <div class="text-center mb-4">
                <h3 class="card-title">Editar Caja</h3>
            </div>

            <!-- Formulario -->
            <form action="{{ route('cajas.update', $caja->id) }}" method="POST" id="cajaForm">
                @csrf
                @method('PUT') <!-- Método para actualizar -->

                <div class="form-row">
                    <div class="form-group mb-4">
                        <label class="form-label" for="numero_caja">Número de Caja</label>
                        <input name="numero_caja" value="{{ old('numero_caja', $caja->numero_caja) }}"
                               class="form-control @error('numero_caja') form-error @enderror" type="number" required>
                        @error('numero_caja')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label" for="mes">Mes</label>
                        <select name="mes" class="form-control @error('mes') form-error @enderror" required>
                            <option value="">Seleccionar mes</option>
                            @foreach(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $mes)
                                <option value="{{ $mes }}" {{ old('mes', $caja->mes) == $mes ? 'selected' : '' }}>
                                    {{ $mes }}
                                </option>
                            @endforeach
                        </select>
                        @error('mes')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label" for="anio">Año</label>
                        <input name="anio" value="{{ old('anio', $caja->anio) }}"
                               class="form-control @error('anio') form-error @enderror" type="number" required>
                        @error('anio')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="form-label" for="ubicacion">Ubicación</label>
                    <input name="ubicacion" value="{{ old('ubicacion', $caja->ubicacion) }}"
                           class="form-control @error('ubicacion') form-error @enderror" type="text" required>
                    @error('ubicacion')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label class="form-label" for="rango_alfabetico">Rango Alfabético</label>
                    <input name="rango_alfabetico" value="{{ old('rango_alfabetico', $caja->rango_alfabetico) }}"
                           class="form-control @error('rango_alfabetico') form-error @enderror" type="text" required>
                    @error('rango_alfabetico')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Vista Previa -->
                <div class="form-preview">
                    <div class="preview-content">
                        <div class="preview-item">
                            <span class="preview-label">Número de Caja:</span>
                            <span id="previewNumeroCaja">{{ $caja->numero_caja }}</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Mes:</span>
                            <span id="previewMes">{{ $caja->mes }}</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Año:</span>
                            <span id="previewAnio">{{ $caja->anio }}</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Ubicación:</span>
                            <span id="previewUbicacion">{{ $caja->ubicacion }}</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Rango Alfabético:</span>
                            <span id="previewRangoAlfabetico">{{ $caja->rango_alfabetico }}</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Guardar Cambios</button>
            </form>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('cajaForm');
    const inputs = form.querySelectorAll('input, select');

    function updatePreview() {
        document.getElementById('previewNumeroCaja').textContent = form.numero_caja.value || '-';
        document.getElementById('previewMes').textContent = form.mes.value || '-';
        document.getElementById('previewAnio').textContent = form.anio.value || '-';
        document.getElementById('previewUbicacion').textContent = form.ubicacion.value || '-';
        document.getElementById('previewRangoAlfabetico').textContent = form.rango_alfabetico.value || '-';
    }

    inputs.forEach(input => {
        input.addEventListener('input', updatePreview);
    });
});
</script>
@endsection
