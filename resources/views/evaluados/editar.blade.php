@extends('layouts.app')

@section('title', 'Editar Evaluado')

@section('css')
<!-- Incluye los mismos estilos y dependencias que en la vista de creación -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    /* Estilos del Contenedor */
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

    /* Efecto Hover para el Contenedor */
    .container:hover {
        transform: translateY(-2px);
        box-shadow:
            0 20px 40px rgba(128, 0, 32, 0.15),
            0 10px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    /* Decoración Adicional */
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

    /* Estilos de los Labels */
    .form-label {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 10px;
        font-size: 17px !important;
        letter-spacing: 0.3px;
        display: block;
    }

    /* Estilos de los Inputs y Selects */
    .form-control {
        padding: 12px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        transition: all 0.3s ease;
        font-size: 17px !important;
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
    }

    .form-control:hover {
        border-color: #800020;
    }

    .form-error {
        border-color: #e53e3e !important;
        box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.2) !important;
    }

    /* Estilos del Botón de Envío */
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

    /* Estilos del Título */
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

    /* Espaciado */
    .mb-4 {
        margin-bottom: 25px;
    }

    /* Estructura de Filas del Formulario */
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

    /* Estilos de las Alertas */
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

    /* Estilos del Botón de Regresar */
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

    /* Estilos para los Botones de Radio */
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

    /* Enfocar en el Botón de Radio */
    .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.2);
    }

    /* Tamaño de Fuente para Inputs y Selects */
    input[type="text"],
    input[type="date"],
    select,
    textarea {
        font-size: 20px !important;
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
                <h3 class="card-title">Editar Evaluado</h3>
            </div>

            <!-- Formulario de Edición -->
            <form action="{{ route('evaluados.update', $evaluado->id) }}" method="POST">
                @csrf
                @method('PUT')

                <p class="text-muted" style="font-size: 0.9em; color: #800020; font-weight: bold;">Los campos marcados
                    con <span style="color: #e53e3e;">*</span> son obligatorios.</p>
                <div class="form-row">
                    <!-- Primer Nombre -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="primer_nombre">Primer Nombre <span style="color: #e53e3e;">*</span></label>
                        <input name="primer_nombre" value="{{ old('primer_nombre', $evaluado->primer_nombre) }}" class="form-control @error('primer_nombre') form-error @enderror" type="text" required pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" title="Solo se permite un nombre sin números ni caracteres especiales." maxlength="50">
                        @error('primer_nombre')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Segundo Nombre -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="segundo_nombre">Segundo Nombre</label>
                        <input name="segundo_nombre" value="{{ old('segundo_nombre', $evaluado->segundo_nombre) }}" class="form-control @error('segundo_nombre') form-error @enderror" type="text" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" title="Solo se permite un nombre sin números ni caracteres especiales." maxlength="50">
                        @error('segundo_nombre')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Primer Apellido -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="primer_apellido">Primer Apellido <span style="color: #e53e3e;">*</span></label>
                        <input name="primer_apellido" value="{{ old('primer_apellido', $evaluado->primer_apellido) }}" class="form-control @error('primer_apellido') form-error @enderror" type="text" required pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$" title="Solo se permiten letras y espacios." maxlength="50">
                        @error('primer_apellido')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Segundo Apellido -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="segundo_apellido">Segundo Apellido</label>
                        <input name="segundo_apellido" value="{{ old('segundo_apellido', $evaluado->segundo_apellido) }}" class="form-control @error('segundo_apellido') form-error @enderror" type="text" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$" title="Solo se permiten letras y espacios." maxlength="50">
                        @error('segundo_apellido')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Fecha de Nacimiento -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="fecha_nacimiento">Fecha de Nacimiento <span style="color: #e53e3e;">*</span></label>
                        <input name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $evaluado->fecha_nacimiento ? $evaluado->fecha_nacimiento->format('Y-m-d') : '') }}" class="form-control @error('fecha_nacimiento') form-error @enderror" type="date" required id="fecha_nacimiento">
                        @error('fecha_nacimiento')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Género -->
                    <div class="form-group mb-4">
                        <label class="form-label">Género <span style="color: #e53e3e;">*</span></label>
                        <div>
                            <label class="form-check-inline">
                                <input type="radio" name="sexo" value="M" class="form-check-input @error('sexo') form-error @enderror" {{ old('sexo',
                                    $evaluado->sexo) == 'M' ? 'checked' : '' }} required> Mujer
                            </label>
                            <label class="form-check-inline">
                                <input type="radio" name="sexo" value="H" class="form-check-input @error('sexo') form-error @enderror" {{ old('sexo',
                                    $evaluado->sexo) == 'H' ? 'checked' : '' }} required> Hombre
                            </label>
                        </div>
                        @error('sexo')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group mb-4">
                        <label class="form-label" for="estado_nacimiento">Estado de Nacimiento <span
                                style="color: #e53e3e;">*</span></label></label>
                        <select name="estado_nacimiento"
                            class="form-control @error('estado_nacimiento') form-error @enderror" required disabled>
                            <option value="">Seleccione el Estado</option>
                            <!-- ... opciones de estados ... -->
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
                            <option value="MC" {{ old('estado_nacimiento')=='MC' ? 'selected' : '' }}>Estado de México
                                (MC)</option>
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

                            <!-- ... continúa con las demás opciones ... -->
                        </select>
                        @error('estado_nacimiento')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CURP -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="CURP">CURP</label>
                        <input name="CURP" value="{{ old('CURP', $evaluado->CURP) }}" class="form-control @error('CURP') form-error @enderror" type="text" readonly>
                        @error('CURP')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Últimos 3 Dígitos de RFC -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="rfc_last3">Últimos 3 Dígitos de RFC <span style="color: #e53e3e;">*</span></label>
                        <input name="rfc_last3" value="{{ old('rfc_last3', $evaluado->rfc_last3) }}" class="form-control @error('rfc_last3') form-error @enderror" type="text" required pattern="^[A-Z0-9]{3}$" title="Ingresa exactamente 3 caracteres alfanuméricos en mayúsculas (letras y/o números)." maxlength="3">
                        @error('rfc_last3')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- RFC -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="RFC">RFC</label>
                        <input name="RFC" value="{{ old('RFC', $evaluado->RFC) }}" class="form-control @error('RFC') form-error @enderror" type="text" maxlength="13" readonly>
                        @error('RFC')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Fecha de Apertura -->
                    <!-- Fecha de Apertura -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="fecha_apertura">Fecha de Evaluación <span style="color: #e53e3e;">*</span></label>
                        <input name="fecha_apertura" value="{{ old('fecha_apertura', $evaluado->fecha_apertura ? $evaluado->fecha_apertura->format('Y-m-d') : '') }}" class="form-control @error('fecha_apertura') form-error @enderror" type="date" required id="fecha_apertura">
                        @error('fecha_apertura')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Resultado de Evaluación -->
                    <div class="form-group mb-4">
                        <label class="form-label">Resultado de Evaluación <span style="color: #e53e3e;">*</span></label>
                        <div>
                            <label class="form-check-inline">
                                <input type="radio" name="resultado_evaluacion" value="1" class="form-check-input @error('resultado_evaluacion') form-error @enderror" {{
                                    old('resultado_evaluacion', $evaluado->resultado_evaluacion) == '1' ? 'checked' : ''
                                }} required> Aprobado
                            </label>
                            <label class="form-check-inline">
                                <input type="radio" name="resultado_evaluacion" value="0" class="form-check-input @error('resultado_evaluacion') form-error @enderror" {{
                                    old('resultado_evaluacion', $evaluado->resultado_evaluacion) == '0' ? 'checked' : ''
                                }} required> No Aprobado
                            </label>
                        </div>
                        @error('resultado_evaluacion')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botón de Guardar Cambios -->
                <button type="submit" class="btn-submit">Guardar Cambios</button>
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
    // Reutiliza los mismos scripts de la vista de creación
    document.addEventListener('DOMContentLoaded', function() {
        // Pega aquí todo el JavaScript de la vista de creación para habilitar campos y generar CURP/RFC.
        // ...
    });

</script>
@endsection
