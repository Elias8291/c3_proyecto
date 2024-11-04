@extends('layouts.app')

@section('title', 'Crear Evaluado')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
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
        padding: 12px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        transition: all 0.3s ease;
        font-size: 22px;
        /* Aumenta el tamaño de letra aquí */
        width: 100%;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    .form-control:focus {
        border-color: #800020;
        box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
        outline: none;
        background-color: #fff;
        font-size: 20px;
        /* Aumenta el tamaño de letra en enfoque */
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

    /* Estilo para el grupo de botones de radio */
    .form-check-inline {
        display: inline-flex;
        align-items: center;
        margin-right: 15px;
        font-weight: 600;
        color: #2d3748;
    }

    .form-check-input {
        appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid #800020;
        border-radius: 50%;
        margin-right: 8px;
        outline: none;
        transition: all 0.3s ease;
        position: relative;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #800020;
        border-color: #800020;
    }

    .form-check-input:checked::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 10px;
        height: 10px;
        background-color: #ffffff;
        border-radius: 50%;
        transform: translate(-50%, -50%);
    }

    .form-check-input:hover {
        border-color: #b30000;
    }

    /* Enfocar en el botón de radio cuando está seleccionado o en hover */
    .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.2);
    }

    .form-label {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 10px;
        font-size: 17px !important;
        /* Forzar el tamaño de fuente */
        letter-spacing: 0.3px;
        display: block;
    }

    input[type="text"],
    input[type="date"],
    select,
    textarea {
        font-size: 17px !important;
    }

</style>
@endsection

@section('content')
<main class="profile-page">
    <section class="page-background">
        <div class="container">
            <div class="text-left mb-4">
                <a href="{{ route('evaluados.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
            <div class="text-center mb-4">
                <h3 class="card-title">Crear Nuevo Evaluado</h3>
            </div>

            <!-- Formulario -->
            <form action="{{ route('evaluados.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <!-- Primer Nombre -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="primer_nombre">Primer Nombre</label>
                        <input name="primer_nombre" value="{{ old('primer_nombre') }}" class="form-control @error('primer_nombre') form-error @enderror" type="text" required pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" title="Solo se permite un nombre sin números ni caracteres especiales.">
                        @error('primer_nombre')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Segundo Nombre -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="segundo_nombre">Segundo Nombre</label>
                        <input name="segundo_nombre" value="{{ old('segundo_nombre') }}" class="form-control @error('segundo_nombre') form-error @enderror" type="text" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" title="Solo se permite un nombre sin números ni caracteres especiales.">
                        @error('segundo_nombre')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Primer Apellido -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="primer_apellido">Primer Apellido</label>
                        <input name="primer_apellido" value="{{ old('primer_apellido') }}" class="form-control @error('primer_apellido') form-error @enderror" type="text" required>
                        @error('primer_apellido')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Segundo Apellido -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="segundo_apellido">Segundo Apellido</label>
                        <input name="segundo_apellido" value="{{ old('segundo_apellido') }}" class="form-control @error('segundo_apellido') form-error @enderror" type="text">
                        @error('segundo_apellido')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- CURP -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="CURP">CURP</label>
                        <input name="CURP" value="{{ old('CURP') }}" class="form-control @error('CURP') form-error @enderror" type="text" required>
                        @error('CURP')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- RFC -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="RFC">RFC</label>
                        <input name="RFC" value="{{ old('RFC') }}" class="form-control @error('RFC') form-error @enderror" type="text">
                        @error('RFC')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Género (Radio Buttons) -->
                    <div class="form-group mb-4">
                        <label class="form-label">Género</label>
                        <div>
                            <label class="form-check-inline">
                                <input type="radio" name="sexo" value="M" class="form-check-input @error('sexo') form-error @enderror" {{ old('sexo')=='M'
                                    ? 'checked' : '' }} required> Mujer
                            </label>
                            <label class="form-check-inline">
                                <input type="radio" name="sexo" value="H" class="form-check-input @error('sexo') form-error @enderror" {{ old('sexo')=='H'
                                    ? 'checked' : '' }} required> Hombre
                            </label>
                        </div>
                        @error('sexo')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- IFE -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="IFE">IFE</label>
                        <input name="IFE" value="{{ old('IFE') }}" class="form-control @error('IFE') form-error @enderror" type="text">
                        @error('IFE')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- SMN -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="SMN">SMN</label>
                        <input name="SMN" value="{{ old('SMN') }}" class="form-control @error('SMN') form-error @enderror" type="text">
                        @error('SMN')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha Apertura -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="fecha_apertura">Fecha de Apertura</label>
                        <input name="fecha_apertura" value="{{ old('fecha_apertura') }}" class="form-control @error('fecha_apertura') form-error @enderror" type="date" required id="fecha_apertura">
                        @error('fecha_apertura')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Estado de Nacimiento -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="estado_nacimiento">Estado de Nacimiento</label>
                        <select name="estado_nacimiento" class="form-control @error('estado_nacimiento') form-error @enderror" required>
                            <option value="">Seleccione el Estado</option>
                            <option value="AS" {{ old('estado_nacimiento')=='AS' ? 'selected' : '' }}>Aguascalientes
                                (AS)</option>
                            <option value="BC" {{ old('estado_nacimiento')=='BC' ? 'selected' : '' }}>Baja California
                                (BC)</option>
                            <option value="BS" {{ old('estado_nacimiento')=='BS' ? 'selected' : '' }}>Baja California
                                Sur (BS)</option>
                            <option value="CC" {{ old('estado_nacimiento')=='CC' ? 'selected' : '' }}>Campeche (CC)
                            </option>
                            <option value="CL" {{ old('estado_nacimiento')=='CL' ? 'selected' : '' }}>Coahuila (CL)
                            </option>
                            <option value="CM" {{ old('estado_nacimiento')=='CM' ? 'selected' : '' }}>Colima (CM)
                            </option>
                            <option value="CS" {{ old('estado_nacimiento')=='CS' ? 'selected' : '' }}>Chiapas (CS)
                            </option>
                            <option value="CH" {{ old('estado_nacimiento')=='CH' ? 'selected' : '' }}>Chihuahua (CH)
                            </option>
                            <option value="DF" {{ old('estado_nacimiento')=='DF' ? 'selected' : '' }}>Ciudad de México
                                (DF)</option>
                            <option value="DG" {{ old('estado_nacimiento')=='DG' ? 'selected' : '' }}>Durango (DG)
                            </option>
                            <option value="GT" {{ old('estado_nacimiento')=='GT' ? 'selected' : '' }}>Guanajuato (GT)
                            </option>
                            <option value="GR" {{ old('estado_nacimiento')=='GR' ? 'selected' : '' }}>Guerrero (GR)
                            </option>
                            <option value="HG" {{ old('estado_nacimiento')=='HG' ? 'selected' : '' }}>Hidalgo (HG)
                            </option>
                            <option value="JC" {{ old('estado_nacimiento')=='JC' ? 'selected' : '' }}>Jalisco (JC)
                            </option>
                            <option value="MC" {{ old('estado_nacimiento')=='MC' ? 'selected' : '' }}>México (MC)
                            </option>
                            <option value="MN" {{ old('estado_nacimiento')=='MN' ? 'selected' : '' }}>Michoacán (MN)
                            </option>
                            <option value="MS" {{ old('estado_nacimiento')=='MS' ? 'selected' : '' }}>Morelos (MS)
                            </option>
                            <option value="NT" {{ old('estado_nacimiento')=='NT' ? 'selected' : '' }}>Nayarit (NT)
                            </option>
                            <option value="NL" {{ old('estado_nacimiento')=='NL' ? 'selected' : '' }}>Nuevo León (NL)
                            </option>
                            <option value="OC" {{ old('estado_nacimiento')=='OC' ? 'selected' : '' }}>Oaxaca (OC)
                            </option>
                            <option value="PL" {{ old('estado_nacimiento')=='PL' ? 'selected' : '' }}>Puebla (PL)
                            </option>
                            <option value="QT" {{ old('estado_nacimiento')=='QT' ? 'selected' : '' }}>Querétaro (QT)
                            </option>
                            <option value="QR" {{ old('estado_nacimiento')=='QR' ? 'selected' : '' }}>Quintana Roo (QR)
                            </option>
                            <option value="SP" {{ old('estado_nacimiento')=='SP' ? 'selected' : '' }}>San Luis Potosí
                                (SP)</option>
                            <option value="SL" {{ old('estado_nacimiento')=='SL' ? 'selected' : '' }}>Sinaloa (SL)
                            </option>
                            <option value="SR" {{ old('estado_nacimiento')=='SR' ? 'selected' : '' }}>Sonora (SR)
                            </option>
                            <option value="TC" {{ old('estado_nacimiento')=='TC' ? 'selected' : '' }}>Tabasco (TC)
                            </option>
                            <option value="TS" {{ old('estado_nacimiento')=='TS' ? 'selected' : '' }}>Tamaulipas (TS)
                            </option>
                            <option value="TL" {{ old('estado_nacimiento')=='TL' ? 'selected' : '' }}>Tlaxcala (TL)
                            </option>
                            <option value="VZ" {{ old('estado_nacimiento')=='VZ' ? 'selected' : '' }}>Veracruz (VZ)
                            </option>
                            <option value="YN" {{ old('estado_nacimiento')=='YN' ? 'selected' : '' }}>Yucatán (YN)
                            </option>
                            <option value="ZS" {{ old('estado_nacimiento')=='ZS' ? 'selected' : '' }}>Zacatecas (ZS)
                            </option>
                            <option value="NE" {{ old('estado_nacimiento')=='NE' ? 'selected' : '' }}>Nacido en el
                                Extranjero (NE)</option>
                        </select>
                        @error('estado_nacimiento')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Fecha de Nacimiento -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="form-control @error('fecha_nacimiento') form-error @enderror" type="date" required id="fecha_nacimiento">
                        @error('fecha_nacimiento')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Resultado de Evaluación -->
                <div class="form-group mb-4">
                    <label class="form-label" for="resultado_evaluacion">Resultado de Evaluación</label>
                    <select name="resultado_evaluacion" class="form-control @error('resultado_evaluacion') form-error @enderror" required>
                        <option value="">Seleccione el Resultado</option>
                        <option value="1" {{ old('resultado_evaluacion')=='1' ? 'selected' : '' }}>Aprobado</option>
                        <option value="0" {{ old('resultado_evaluacion')=='0' ? 'selected' : '' }}>No Aprobado</option>
                    </select>
                    @error('resultado_evaluacion')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botón de Guardar Cambios -->
                <button type="submit" class="btn-submit">Crear Evaluado</button>
            </form>


            <!-- Mensajes de éxito o error -->
            @if(session('success'))
            <div class="alert-success">
                <strong>¡Éxito!</strong> {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert-error">
                <strong>¡Error!</strong> Por favor, revisa los siguientes campos:
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
        const fechaAperturaInput = document.getElementById('fecha_apertura');

        // Calcular la fecha máxima permitida para que el evaluado sea mayor de 18 años
        const hoy = new Date();
        const añoMayorEdad = hoy.getFullYear() - 18;
        const mes = (hoy.getMonth() + 1).toString().padStart(2, '0');
        const dia = hoy.getDate().toString().padStart(2, '0');
        const fechaMaximaNacimiento = `${añoMayorEdad}-${mes}-${dia}`;
        const fechaMaximaApertura = `${hoy.getFullYear()}-${mes}-${dia}`;

        // Establecer el valor máximo en los campos de fecha
        fechaNacimientoInput.setAttribute('max', fechaMaximaNacimiento);
        fechaAperturaInput.setAttribute('max', fechaMaximaApertura);

        // Validación en tiempo real para el campo de Fecha de Apertura
        fechaAperturaInput.addEventListener('input', function() {
            const fechaSeleccionada = new Date(fechaAperturaInput.value);
            const fechaHoy = new Date(fechaMaximaApertura);

            if (fechaSeleccionada > fechaHoy) {
                alert("La fecha de apertura no puede ser posterior a la fecha actual.");
                fechaAperturaInput.value = '';
            }
        });

        // Validación en tiempo real para nombres y apellidos
        const campoValidacion = {
            primer_nombre: /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/, // Solo letras, sin espacios
            segundo_nombre: /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/, // Solo letras, sin espacios
            primer_apellido: /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s[a-zA-ZÀ-ÿ\u00f1\u00d1]+)?$/, // Solo letras, permite un espacio y otra palabra
            segundo_apellido: /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s[a-zA-ZÀ-ÿ\u00f1\u00d1]+)?$/ // Solo letras, permite un espacio y otra palabra
        };

        Object.keys(campoValidacion).forEach(campoId => {
            const campo = document.getElementsByName(campoId)[0];
            campo.addEventListener('input', function() {
                const regex = campoValidacion[campoId];
                if (!regex.test(campo.value)) {
                    campo.value = campo.value.slice(0, -1); // Remueve el último carácter si no cumple con el regex
                }
            });
        });

         // Define campos obligatorios en el orden de activación
         const campos = [
            'primer_nombre', 'primer_apellido', 'CURP', 'fecha_apertura', 'fecha_nacimiento'
        ];
        
        // Define los campos opcionales
        const opcionales = ['segundo_nombre', 'segundo_apellido', 'RFC', 'IFE', 'SMN'];

        // Función para habilitar el siguiente campo si el actual está completo
        function activarSiguienteCampo(index) {
            if (index < campos.length - 1) {
                const campoActual = document.getElementsByName(campos[index])[0];
                const siguienteCampo = document.getElementsByName(campos[index + 1])[0];
                
                campoActual.addEventListener('input', function() {
                    if (campoActual.value.trim() !== '') {
                        siguienteCampo.disabled = false;  // Activa el siguiente campo
                    } else {
                        siguienteCampo.disabled = true;  // Desactiva si el actual está vacío
                        // Desactiva y limpia todos los campos posteriores
                        for (let i = index + 1; i < campos.length; i++) {
                            const campoPosterior = document.getElementsByName(campos[i])[0];
                            campoPosterior.value = '';
                            campoPosterior.disabled = true;
                        }
                    }
                });
            }
        }

        // Inicializa campos obligatorios
        campos.forEach((campo, index) => {
            const elemento = document.getElementsByName(campo)[0];
            if (index !== 0) elemento.disabled = true;  // Desactiva todos excepto el primero
            activarSiguienteCampo(index);  // Configura la activación secuencial
        });

        // Inicializa los campos opcionales (sin restricciones)
        opcionales.forEach(opcional => {
            const elemento = document.getElementsByName(opcional)[0];
            elemento.disabled = false;  // Siempre habilitados
        });
    });
</script>
@endsection

