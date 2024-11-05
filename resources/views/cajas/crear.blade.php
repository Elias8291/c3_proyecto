@extends('layouts.app')

@section('title', 'Crear Caja')

@section('css')
<style>
    .side-menu {
        padding: 0;
        margin: 0;
    }

    /* Reutiliza los estilos del formulario de usuario */
    .container {
        max-width: 900px;
        margin: 50px auto;
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        position: relative;
        overflow: hidden;
    }


    .container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #800020, #b30000);
    }

    .page-background {
        background: linear-gradient(135deg, #f0f4f8 40%, #e0e0eb);
        padding: 60px 0;
        min-height: 100vh;
    }

    .form-label {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 10px;
        font-size: 16px;
        letter-spacing: 0.3px;
        display: block;
    }

    .form-control {
        padding: 12px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        transition: all 0.3s ease;
        font-size: 16px;
        width: 100%;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    .form-control:focus {
        border-color: #800020;
        box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
        outline: none;
        background-color: #fff;
    }

    .form-control:hover {
        border-color: #800020;
    }

    .form-error {
        border-color: #e53e3e !important;
        box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.2) !important;
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
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(128, 0, 32, 0.2);
    }

    .btn-submit:active {
        transform: translateY(1px);
    }

    .card-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 30px;
        text-align: center;
        position: relative;
        padding-bottom: 15px;
    }

    .card-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #800020, #b30000);
        border-radius: 2px;
    }

    .mb-4 {
        margin-bottom: 25px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .form-row .form-group {
        flex: 1;
    }

    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
        }
    }

    .alert-success,
    .alert-error {
        padding: 16px 20px;
        border-radius: 12px;
        margin: 25px 0;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    .alert-success {
        background-color: #f0fdf4;
        border-left: 5px solid #22c55e;
        color: #166534;
    }

    .alert-error {
        background-color: #fef2f2;
        border-left: 5px solid #ef4444;
        color: #991b1b;
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

    .page-background {
        background-color: #dbd6d7;
        background-image:
            linear-gradient(45deg, rgba(0, 48, 73, 0.03) 25%, transparent 25%),
            linear-gradient(-45deg, rgba(0, 48, 73, 0.03) 25%, transparent 25%),
            linear-gradient(45deg, transparent 75%, rgba(0, 48, 73, 0.03) 75%),
            linear-gradient(-45deg, transparent 75%, rgba(0, 48, 73, 0.03) 75%),
            radial-gradient(circle at 50% 50%, rgba(0, 48, 73, 0.05) 2px, transparent 3px);
        background-size: 50px 50px, 50px 50px, 50px 50px, 50px 50px, 25px 25px;
        background-position: 0 0, 25px 0, 25px -25px, 0 0, 0 0;
        position: relative;
        padding: 60px 0;
        min-height: 100vh;
    }

    .page-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(circle at 30% 30%, rgba(0, 48, 73, 0.08) 0%, transparent 60%),
            radial-gradient(circle at 70% 70%, rgba(0, 48, 73, 0.08) 0%, transparent 60%);
        pointer-events: none;
        z-index: -1;
    }

    .container {
        max-width: 900px;
        margin: 50px auto;
        background: linear-gradient(135deg, #ffffff 0%, #fcfafa 100%);
        padding: 40px;
        box-shadow:
            0 15px 35px rgba(128, 0, 32, 0.1),
            0 5px 15px rgba(0, 0, 0, 0.05);
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
        background: linear-gradient(90deg,
                #800020 0%,
                #a31545 25%,
                #800020 50%,
                #a31545 75%,
                #800020 100%);
        background-size: 200% auto;
        animation: gradient 3s linear infinite;
    }

    .container::after {
        content: '';
        position: absolute;
        top: 5px;
        left: 0;
        right: 0;
        height: 1px;
        background: rgba(255, 255, 255, 0.5);
    }

    @keyframes gradient {
        0% {
            background-position: 0% center;
        }

        100% {
            background-position: 200% center;
        }
    }

    /* Efecto hover para el container */
    .container:hover {
        transform: translateY(-2px);
        box-shadow:
            0 20px 40px rgba(128, 0, 32, 0.15),
            0 10px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    /* Decoración adicional */
    .decoration {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
        overflow: hidden;
        z-index: 1;
    }

    .decoration::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        top: -50%;
        left: -50%;
        background: radial-gradient(circle at center, rgba(128, 0, 32, 0.01) 0%, transparent 50%);
        animation: rotate 30s linear infinite;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Mejoras para los campos del formulario */
    .form-control {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(128, 0, 32, 0.1);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background: #ffffff;
        border-color: rgba(128, 0, 32, 0.3);
        box-shadow:
            0 0 0 3px rgba(128, 0, 32, 0.1),
            0 2px 4px rgba(0, 0, 0, 0.05);
    }

    /* Efecto de brillo en el borde superior */
    @keyframes shimmer {
        0% {
            background-position: -200% center;
        }

        100% {
            background-position: 200% center;
        }
    }

    .container::before {
        animation: shimmer 6s linear infinite;
        background-size: 200% auto;
    }

    input[type="text"],
    input[type="date"],
    select,
    textarea {
        font-size: 17px !important;
    }

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
        background: rgba(255, 255, 255, 0.5);
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
                <h3 class="card-title">Crear Nueva Caja</h3>
            </div>

            <!-- Formulario -->
            <form action="{{ route('cajas.store') }}" method="POST" id="cajaForm">
                @csrf

                <div class="form-row">
                    <div class="form-group mb-4">
                        <label class="form-label" for="anio">Año</label>
                        <input name="anio" value="{{ old('anio', date('Y')) }}"
                            class="form-control @error('anio') form-error @enderror" type="number" required>
                        @error('anio')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" for="numero_caja">Número de Caja</label>
                        <input name="numero_caja" id="numero_caja" value="{{ old('numero_caja') }}"
                            class="form-control @error('numero_caja') form-error @enderror" type="number" min="1"
                            required>
                        <small class="text-danger" id="numeroCajaError" style="display: none;">Este número de caja ya
                            existe para el año seleccionado.</small>
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
                            <option value="{{ $mes }}" {{ old('mes')==$mes ? 'selected' : '' }}>
                                {{ $mes }}
                            </option>
                            @endforeach
                        </select>
                        @error('mes')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>


                </div>

                <div class="form-group mb-4">
                    <label class="form-label" for="ubicacion">Ubicación</label>
                    <select name="ubicacion" class="form-control @error('ubicacion') form-error @enderror" required>
                        <option value="">Seleccionar ubicación</option>
                        @foreach(range(1, 8) as $num)
                        <option value="Armario {{ $num }} - Lado A" {{ old('ubicacion')=="Armario $num - Lado A"
                            ? 'selected' : '' }}>Armario {{ $num }} - Lado A</option>
                        <option value="Armario {{ $num }} - Lado B" {{ old('ubicacion')=="Armario $num - Lado B"
                            ? 'selected' : '' }}>Armario {{ $num }} - Lado B</option>
                        @endforeach
                    </select>
                    @error('ubicacion')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>


                <div class="form-group mb-4">
                    <label class="form-label" for="rango_alfabetico">Rango Alfabético</label>
                    <input name="rango_alfabetico" value="{{ old('rango_alfabetico') }}"
                        class="form-control @error('rango_alfabetico') form-error @enderror" type="text" required>
                    @error('rango_alfabetico')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Cantidad Máxima de Carpetas -->
                <div class="form-group mb-4">
                    <label class="form-label" for="maximo_carpetas">Cantidad Máxima de Carpetas</label>
                    <input name="maximo_carpetas" value="{{ old('maximo_carpetas') }}"
                        class="form-control @error('maximo_carpetas') form-error @enderror" type="number" min="1"
                        required>
                    @error('maximo_carpetas')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Vista Previa -->
                <div class="form-preview">
                    <div class="preview-content">
                        <div class="preview-item">
                            <span class="preview-label">Número de Caja:</span>
                            <span id="previewNumeroCaja">-</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Mes:</span>
                            <span id="previewMes">-</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Año:</span>
                            <span id="previewAnio">-</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Ubicación:</span>
                            <span id="previewUbicacion">-</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Cantidad Máxima de Carpetas:</span>
                            <span id="previewMaximoCarpetas">-</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Crear Caja</button>
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
    const rangoAlfabeticoInput = form.rango_alfabetico;
    const numeroCajaInput = document.getElementById('numero_caja');
    const anioInput = document.querySelector('input[name="anio"]');
    const numeroCajaError = document.getElementById('numeroCajaError');
    const submitButton = document.querySelector('.btn-submit');
    const maximoCarpetasInput = document.querySelector('input[name="maximo_carpetas"]'); // Asegurarse de seleccionar el campo de cantidad máxima

    function updatePreview() {
        document.getElementById('previewNumeroCaja').textContent = form.numero_caja.value || '-';
        document.getElementById('previewMes').textContent = form.mes.value || '-';
        document.getElementById('previewAnio').textContent = form.anio.value || '-';
        document.getElementById('previewUbicacion').textContent = form.ubicacion.value || '-';
        document.getElementById('previewRangoAlfabetico').textContent = form.rango_alfabetico.value || '-';
        document.getElementById('previewMaximoCarpetas').textContent = form.maximo_carpetas.value || '-'; // Actualización correcta de la cantidad máxima
    }

    // Función para manejar el input en rango alfabético
    rangoAlfabeticoInput.addEventListener('input', function() {
        let value = rangoAlfabeticoInput.value.toUpperCase();
        value = value.replace(/[^A-Z-]/g, '');
        if (value.length === 2 && /^[A-Z]$/.test(value[0]) && value[1] !== '-') {
            value = value[0] + '-' + value[1];
        }
        if (value.length > 3) {
            value = value.slice(0, 3);
        }
        rangoAlfabeticoInput.value = value;
        updatePreview();

        const regex = /^[A-Z]-[A-Z]?$/;
        const errorMessage = document.querySelector('.error-rango-alfabetico');
        if (!regex.test(value) && value.length === 3) {
            rangoAlfabeticoInput.classList.add('form-error');
            if (!errorMessage) {
                const errorElement = document.createElement('p');
                errorElement.className = 'form-error error-rango-alfabetico';
                errorElement.textContent = 'El rango alfabético debe tener el formato "A-Z".';
                rangoAlfabeticoInput.parentElement.appendChild(errorElement);
            }
        } else {
            rangoAlfabeticoInput.classList.remove('form-error');
            if (errorMessage) {
                errorMessage.remove();
            }
        }
    });

    // Actualiza la vista previa cuando se modifiquen los campos del formulario
    inputs.forEach(input => {
        input.addEventListener('input', updatePreview);
    });

    function validateNumeroCaja() {
        const numeroCaja = numeroCajaInput.value;
        const anio = anioInput.value;

        if (numeroCaja && anio) {
            fetch(`/cajas/check-numero-caja?anio=${anio}&numero_caja=${numeroCaja}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        numeroCajaError.style.display = 'block';
                        numeroCajaInput.classList.add('form-error');
                        submitButton.disabled = true;
                    } else {
                        numeroCajaError.style.display = 'none';
                        numeroCajaInput.classList.remove('form-error');
                        submitButton.disabled = false;
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    numeroCajaInput.addEventListener('input', validateNumeroCaja);
    anioInput.addEventListener('input', validateNumeroCaja);

    numeroCajaInput.addEventListener('input', function() {
        if (numeroCajaInput.value < 1) {
            numeroCajaInput.value = '';
        }
    });
});
</script>
@endsection