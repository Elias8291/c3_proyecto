@extends('layouts.app')

@section('title', 'Crear Evaluado')

@section('css')
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

        .form-section {
            background: #ffffff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(128, 0, 32, 0.1);
        }

        .section-title {
            color: #800020;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(128, 0, 32, 0.2);
        }

        .section-content {
            padding: 15px 0;
        }

        .required {
            color: #e53e3e;
        }

        .radio-group {
            display: flex;
            gap: 20px;
        }

        /* Estilos para input deshabilitado */
.form-control:disabled {
    background-color: #f5f5f5;
    cursor: not-allowed;
    opacity: 0.7;
    border-color: #e2e8f0;
}

/* Estilos para input habilitado */
.form-control:enabled {
    background-color: #ffffff;
    cursor: pointer;
    opacity: 1;
    border-color: #e2e8f0;
    transition: all 0.3s ease;
}

/* Efecto visual cuando se habilita un campo */
@keyframes enableField {
    0% { background-color: #f5f5f5; }
    100% { background-color: #ffffff; }
}

.form-control:enabled {
    animation: enableField 0.5s ease forwards;
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

                <form action="{{ route('evaluados.store') }}" method="POST">
                    @csrf
                    <p class="text-muted" style="font-size: 0.9em; color: #800020; font-weight: bold;">Los campos marcados
                        con <span style="color: #e53e3e;">*</span> son obligatorios.</p>
                    <div class="form-row">


                        <div class="form-section">
                            <h4 class="section-title">Datos Personales</h4>
                            <div class="section-content">
                                <div class="form-row">
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="primer_nombre">Primer Nombre <span
                                                style="color: #e53e3e;">*</span></label>
                                        <input name="primer_nombre" value="{{ old('primer_nombre') }}"
                                            class="form-control @error('primer_nombre') form-error @enderror" type="text"
                                            required pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$"
                                            title="Solo se permite un nombre sin números ni caracteres especiales."
                                            maxlength="50">
                                        @error('primer_nombre')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Segundo Nombre -->
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="segundo_nombre">Segundo Nombre </label>
                                        <input name="segundo_nombre" value="{{ old('segundo_nombre') }}"
                                            class="form-control @error('segundo_nombre') form-error @enderror"
                                            type="text" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$"
                                            title="Solo se permite un nombre sin números ni caracteres especiales."
                                            maxlength="50" disabled>
                                        @error('segundo_nombre')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- Primer Apellido -->
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="primer_apellido">Primer Apellido <span
                                                style="color: #e53e3e;">*</span></label> </label>
                                        <input name="primer_apellido" value="{{ old('primer_apellido') }}"
                                            class="form-control @error('primer_apellido') form-error @enderror"
                                            type="text" required pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$"
                                            title="Solo se permiten letras y espacios." maxlength="50" disabled>
                                        @error('primer_apellido')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Segundo Apellido -->
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="segundo_apellido">Segundo Apellido</label>
                                        <input name="segundo_apellido" value="{{ old('segundo_apellido') }}"
                                            class="form-control @error('segundo_apellido') form-error @enderror"
                                            type="text" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$"
                                            title="Solo se permiten letras y espacios." maxlength="50" disabled>
                                        @error('segundo_apellido')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- Fecha de Nacimiento -->
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="fecha_nacimiento">Fecha de Nacimiento <span
                                                style="color: #e53e3e;">*</span></label></label>
                                        <input name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                            class="form-control @error('fecha_nacimiento') form-error @enderror"
                                            type="date" required id="fecha_nacimiento" disabled>
                                        @error('fecha_nacimiento')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Género (Radio Buttons) -->
                                    <div class="form-group mb-4">
                                        <label class="form-label">Género <span
                                                style="color: #e53e3e;">*</span></label></label>
                                        <div>
                                            <label class="form-check-inline">
                                                <input type="radio" name="sexo" value="M"
                                                    class="form-check-input @error('sexo') form-error @enderror"
                                                    {{ old('sexo') == 'M' ? 'checked' : '' }} required disabled> Mujer
                                            </label>
                                            <label class="form-check-inline">
                                                <input type="radio" name="sexo" value="H"
                                                    class="form-check-input @error('sexo') form-error @enderror"
                                                    {{ old('sexo') == 'H' ? 'checked' : '' }} required disabled> Hombre
                                            </label>
                                        </div>
                                        @error('sexo')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="form-label" for="estado_nacimiento">Estado de Nacimiento <span
                                                style="color: #e53e3e;">*</span></label></label>
                                        <select name="estado_nacimiento"
                                            class="form-control @error('estado_nacimiento') form-error @enderror" required
                                            disabled>
                                            <option value="">Seleccione el Estado</option>
                                            <!-- ... opciones de estados ... -->
                                            <option value="AS" {{ old('estado_nacimiento') == 'AS' ? 'selected' : '' }}>
                                                Aguascalientes
                                                (AS)</option>
                                            <option value="BC" {{ old('estado_nacimiento') == 'BC' ? 'selected' : '' }}>
                                                Baja
                                                California
                                                (BC)</option>
                                            <option value="BS" {{ old('estado_nacimiento') == 'BS' ? 'selected' : '' }}>
                                                Baja
                                                California
                                                Sur (BS)</option>
                                            <option value="CC" {{ old('estado_nacimiento') == 'CC' ? 'selected' : '' }}>
                                                Campeche (CC)
                                            </option>
                                            <option value="CL" {{ old('estado_nacimiento') == 'CL' ? 'selected' : '' }}>
                                                Coahuila (CL)
                                            </option>
                                            <option value="CM" {{ old('estado_nacimiento') == 'CM' ? 'selected' : '' }}>
                                                Colima
                                                (CM)
                                            </option>
                                            <option value="CS" {{ old('estado_nacimiento') == 'CS' ? 'selected' : '' }}>
                                                Chiapas (CS)
                                            </option>
                                            <option value="CH" {{ old('estado_nacimiento') == 'CH' ? 'selected' : '' }}>
                                                Chihuahua (CH)
                                            </option>
                                            <option value="DF" {{ old('estado_nacimiento') == 'DF' ? 'selected' : '' }}>
                                                Ciudad
                                                de México
                                                (DF)</option>
                                            <option value="DG" {{ old('estado_nacimiento') == 'DG' ? 'selected' : '' }}>
                                                Durango (DG)
                                            </option>
                                            <option value="GT" {{ old('estado_nacimiento') == 'GT' ? 'selected' : '' }}>
                                                Guanajuato (GT)
                                            </option>
                                            <option value="GR" {{ old('estado_nacimiento') == 'GR' ? 'selected' : '' }}>
                                                Guerrero (GR)
                                            </option>
                                            <option value="HG" {{ old('estado_nacimiento') == 'HG' ? 'selected' : '' }}>
                                                Hidalgo (HG)
                                            </option>
                                            <option value="JC" {{ old('estado_nacimiento') == 'JC' ? 'selected' : '' }}>
                                                Jalisco (JC)
                                            </option>
                                            <option value="MC" {{ old('estado_nacimiento') == 'MC' ? 'selected' : '' }}>
                                                Estado
                                                de México
                                                (MC)</option>
                                            <option value="MN" {{ old('estado_nacimiento') == 'MN' ? 'selected' : '' }}>
                                                Michoacán (MN)
                                            </option>
                                            <option value="MS" {{ old('estado_nacimiento') == 'MS' ? 'selected' : '' }}>
                                                Morelos (MS)
                                            </option>
                                            <option value="NT" {{ old('estado_nacimiento') == 'NT' ? 'selected' : '' }}>
                                                Nayarit (NT)
                                            </option>
                                            <option value="NL" {{ old('estado_nacimiento') == 'NL' ? 'selected' : '' }}>
                                                Nuevo
                                                León (NL)
                                            </option>
                                            <option value="OC" {{ old('estado_nacimiento') == 'OC' ? 'selected' : '' }}>
                                                Oaxaca
                                                (OC)
                                            </option>
                                            <option value="PL" {{ old('estado_nacimiento') == 'PL' ? 'selected' : '' }}>
                                                Puebla
                                                (PL)
                                            </option>
                                            <option value="QT" {{ old('estado_nacimiento') == 'QT' ? 'selected' : '' }}>
                                                Querétaro (QT)
                                            </option>
                                            <option value="QR" {{ old('estado_nacimiento') == 'QR' ? 'selected' : '' }}>
                                                Quintana Roo (QR)
                                            </option>
                                            <option value="SP" {{ old('estado_nacimiento') == 'SP' ? 'selected' : '' }}>
                                                San
                                                Luis Potosí
                                                (SP)</option>
                                            <option value="SL" {{ old('estado_nacimiento') == 'SL' ? 'selected' : '' }}>
                                                Sinaloa (SL)
                                            </option>
                                            <option value="SR" {{ old('estado_nacimiento') == 'SR' ? 'selected' : '' }}>
                                                Sonora
                                                (SR)
                                            </option>
                                            <option value="TC" {{ old('estado_nacimiento') == 'TC' ? 'selected' : '' }}>
                                                Tabasco (TC)
                                            </option>
                                            <option value="TS" {{ old('estado_nacimiento') == 'TS' ? 'selected' : '' }}>
                                                Tamaulipas (TS)
                                            </option>
                                            <option value="TL" {{ old('estado_nacimiento') == 'TL' ? 'selected' : '' }}>
                                                Tlaxcala (TL)
                                            </option>
                                            <option value="VZ" {{ old('estado_nacimiento') == 'VZ' ? 'selected' : '' }}>
                                                Veracruz (VZ)
                                            </option>
                                            <option value="YN" {{ old('estado_nacimiento') == 'YN' ? 'selected' : '' }}>
                                                Yucatán (YN)
                                            </option>
                                            <option value="ZS" {{ old('estado_nacimiento') == 'ZS' ? 'selected' : '' }}>
                                                Zacatecas (ZS)
                                            </option>
                                            <option value="NE" {{ old('estado_nacimiento') == 'NE' ? 'selected' : '' }}>
                                                Nacido
                                                en el
                                                Extranjero (NE)</option>

                                            <!-- ... continúa con las demás opciones ... -->
                                        </select>
                                        @error('estado_nacimiento')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group mb-4">
                                        <label class="form-label" for="curp_last2">2 Últimos Dígitos de CURP <span
                                                style="color: #e53e3e;">*</span></label> </label>
                                        <input name="curp_last2" value="{{ old('curp_last2') }}"
                                            class="form-control @error('curp_last2') form-error @enderror" type="text"
                                            required pattern="^[A-Z0-9]{2}$"
                                            title="Ingresa exactamente 2 caracteres alfanuméricos (una letra y un número o un número y una letra)."
                                            maxlength="2" disabled>
                                        @error('curp_last2')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-4">
                                        <label class="form-label" for="CURP">CURP</label>
                                        <input name="CURP" value="{{ old('CURP') }}"
                                            class="form-control @error('CURP') form-error @enderror" type="text"
                                            readonly>
                                        @error('CURP')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>


                                </div>



                                <div class="form-row">

                                    <div class="form-group mb-4">
                                        <label class="form-label" for="rfc_last3">Últimos 3 Dígitos de RFC <span
                                                style="color: #e53e3e;">*</span></label></label>
                                        <input name="rfc_last3" value="{{ old('rfc_last3') }}"
                                            class="form-control @error('rfc_last3') form-error @enderror" type="text"
                                            required pattern="^[A-Z0-9]{3}$"
                                            title="Ingresa exactamente 3 caracteres alfanuméricos en mayúsculas (letras y/o números)."
                                            maxlength="3" disabled>
                                        @error('rfc_last3')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="RFC">RFC</label>
                                        <input name="RFC" value="{{ old('RFC') }}"
                                            class="form-control @error('RFC') form-error @enderror" type="text"
                                            maxlength="13" readonly>
                                        @error('RFC')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>


                                </div>
                            </div>



                            <h4 class="section-title">Datos de Evaluación</h4>
                            <div class="section-content">
                                <div class="form-row">
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="fecha_apertura">Fecha de Evaluación <span
                                                style="color: #e53e3e;">*</span></label></label>
                                        <input name="fecha_apertura" value="{{ old('fecha_apertura') }}"
                                            class="form-control @error('fecha_apertura') form-error @enderror"
                                            type="date" required id="fecha_apertura" disabled>
                                        @error('fecha_apertura')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="form-label">Resultado de Evaluación <span
                                                style="color: #e53e3e;">*</span></label></label>
                                        <div>
                                            <label class="form-check-inline">
                                                <input type="radio" name="resultado_evaluacion" value="1"
                                                    class="form-check-input @error('resultado_evaluacion') form-error @enderror"
                                                    {{ old('resultado_evaluacion') == '1' ? 'checked' : '' }} required
                                                    disabled>
                                                Aprobado
                                            </label>
                                            <label class="form-check-inline">
                                                <input type="radio" name="resultado_evaluacion" value="0"
                                                    class="form-check-input @error('resultado_evaluacion') form-error @enderror"
                                                    {{ old('resultado_evaluacion') == '0' ? 'checked' : '' }} required
                                                    disabled>
                                                No Aprobado
                                            </label>
                                        </div>
                                        @error('resultado_evaluacion')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>



                            <button type="submit" class="btn-submit">Crear Evaluado</button>
                </form>
                <div id="carpetaModal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <h4>¡Evaluado creado exitosamente!</h4>
                        <p>¿Deseas agregar una carpeta para este evaluado?</p>
                        <div class="modal-buttons">
                            <a href="{{ route('carpetas.create') }}" class="btn-confirm">Sí, agregar carpeta</a>
                            <button onclick="closeModal()" class="btn-cancel">No, gracias</button>
                        </div>
                    </div>
                </div>

                @if (session('success'))
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

            const rfcInput = document.getElementsByName('RFC')[0];
            const primerNombreInput = document.getElementsByName('primer_nombre')[0];
            const segundoNombreInput = document.getElementsByName('segundo_nombre')[0];
            const primerApellidoInput = document.getElementsByName('primer_apellido')[0];
            const segundoApellidoInput = document.getElementsByName('segundo_apellido')[0];
            const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
            const estadoNacimientoSelect = document.getElementsByName('estado_nacimiento')[0];
            const curpLast2Input = document.getElementsByName('curp_last2')[0];
            const fechaAperturaInput = document.getElementById('fecha_apertura');
            const sexoInputs = document.getElementsByName('sexo');
            const curpInput = document.getElementsByName('CURP')[0];
            const resultadoEvaluacionInputs = document.getElementsByName('resultado_evaluacion');
            const fechaMaxima = new Date();
            fechaMaxima.setFullYear(fechaMaxima.getFullYear() - 18); // Resta 18 años de la fecha actual
            const rfcLast3Input = document.getElementsByName('rfc_last3')[0];

            // Inicializa flatpickr para el campo de fecha de nacimiento
            flatpickr("#fecha_nacimiento", {
                maxDate: fechaMaxima, // Fecha máxima para que el evaluado sea mayor de 18 años
                dateFormat: "Y-m-d",
                locale: "es" // Esto asegura que el calendario esté en español
            });

            @if (session('showCreateFolderModal'))
                showModal();
            @endif

            // Función para habilitar el siguiente campo en la secuencia
            function habilitarCampoSiguiente(campoActual) {
                switch (campoActual) {
                    case 'primer_nombre':
                        if (primerNombreInput.value.trim() !== '' && primerNombreInput.checkValidity()) {
                            primerApellidoInput.disabled = false;
                            segundoNombreInput.disabled = false;
                            segundoApellidoInput.disabled = false;
                        } else {
                            primerApellidoInput.disabled = true;
                            segundoNombreInput.disabled = true;
                            segundoApellidoInput.disabled = true;
                            primerApellidoInput.value = '';
                            segundoNombreInput.value = '';
                            segundoApellidoInput.value = '';
                            limpiarCamposPosteriores(['primer_apellido']);
                        }
                        break;
                    case 'primer_apellido':
                        if (primerApellidoInput.value.trim() !== '' && primerApellidoInput.checkValidity()) {
                            fechaNacimientoInput.disabled = false;
                        } else {
                            fechaNacimientoInput.disabled = true;
                            fechaNacimientoInput.value = '';
                            limpiarCamposPosteriores(['fecha_nacimiento']);
                        }
                        break;
                    case 'fecha_nacimiento':
                        if (fechaNacimientoInput.value.trim() !== '' && fechaNacimientoInput.checkValidity()) {
                            estadoNacimientoSelect.disabled = false;
                            // Habilitar Género (sexo)
                            Array.from(sexoInputs).forEach(radio => {
                                radio.disabled = false;
                            });
                        } else {
                            estadoNacimientoSelect.disabled = true;
                            estadoNacimientoSelect.value = '';
                            Array.from(sexoInputs).forEach(radio => {
                                radio.disabled = true;
                                radio.checked = false;
                            });
                            limpiarCamposPosteriores(['estado_nacimiento']);
                        }
                        break;
                    case 'estado_nacimiento':
                        if (estadoNacimientoSelect.value !== '') {
                            curpLast2Input.disabled = false;
                            document.getElementsByName('rfc_last3')[0].disabled = false; // Habilita el campo RFC

                        } else {
                            curpLast2Input.disabled = true;
                            curpLast2Input.value = '';
                            document.getElementsByName('rfc_last3')[0].disabled = true; // Desactiva el campo RFC
                            document.getElementsByName('rfc_last3')[0].value = ''; // Limpia el campo RFC
                            limpiarCamposPosteriores(['curp_last2']);
                        }
                        break;
                    case 'curp_last2':
                        const regex = /^[A-Z0-9]{2}$/;
                        if (curpLast2Input.value.length === 2 && regex.test(curpLast2Input.value)) {
                            curpLast2Input.classList.remove('form-error');
                            curpLast2Input.setCustomValidity('');
                            habilitarCampoSiguiente('curp_last2');
                        } else if (curpLast2Input.value.length === 2) {
                            curpLast2Input.classList.add('form-error');
                            curpLast2Input.setCustomValidity(
                                'Formato incorrecto. Usa una letra y un número o un número y una letra.');
                        } else {
                            curpLast2Input.classList.remove('form-error');
                            curpLast2Input.setCustomValidity('');
                            fechaAperturaInput.disabled = true;
                            fechaAperturaInput.value = '';
                            Array.from(resultadoEvaluacionInputs).forEach(radio => {
                                radio.disabled = true;
                                radio.checked = false;
                            });
                        }
                        // Generar CURP si el formato es correcto
                        if (curpLast2Input.value.length === 2 && regex.test(curpLast2Input.value)) {
                            generarCURP();
                        } else {
                            curpInput.value = '';
                        }
                        break;
                    case 'fecha_apertura':
                        if (fechaAperturaInput.value.trim() !== '' && fechaAperturaInput.checkValidity()) {
                            // Habilitar Resultado de Evaluación
                            Array.from(resultadoEvaluacionInputs).forEach(radio => {
                                radio.disabled = false;
                            });
                        } else {
                            Array.from(resultadoEvaluacionInputs).forEach(radio => {
                                radio.disabled = true;
                                radio.checked = false;
                            });
                        }
                        break;
                }
            }
            document.querySelector('form').addEventListener('submit', function() {
                curpInput.disabled = false; // Habilitar el campo CURP al enviar el formulario
            });

            // Función para limpiar y deshabilitar campos posteriores
            function limpiarCamposPosteriores(campos) {
                campos.forEach(campo => {
                    switch (campo) {
                        case 'primer_apellido':
                            primerApellidoInput.value = '';
                            limpiarCamposPosteriores(['fecha_nacimiento']);
                            break;
                        case 'fecha_nacimiento':
                            fechaNacimientoInput.value = '';
                            estadoNacimientoSelect.value = '';
                            Array.from(sexoInputs).forEach(radio => {
                                radio.checked = false;
                            });
                            limpiarCamposPosteriores(['estado_nacimiento']);
                            break;
                        case 'estado_nacimiento':
                            estadoNacimientoSelect.value = '';
                            curpLast2Input.value = '';
                            limpiarCamposPosteriores(['curp_last2']);
                            break;
                        case 'curp_last2':
                            curpLast2Input.value = '';
                            limpiarCamposPosteriores(['fecha_apertura']);
                            break;
                        case 'fecha_apertura':
                            fechaAperturaInput.value = '';
                            Array.from(resultadoEvaluacionInputs).forEach(radio => {
                                radio.checked = false;
                            });
                            break;
                    }
                });
            }

            function generarRFC() {
                const primerApellido = primerApellidoInput.value.trim().toUpperCase();
                const segundoApellido = (segundoApellidoInput.value || 'X').trim().toUpperCase();
                const primerNombre = primerNombreInput.value.trim().toUpperCase();
                const fechaNacimiento = fechaNacimientoInput.value;
                const rfcLast3 = rfcLast3Input.value.trim().toUpperCase();

                // Validación para asegurar que todos los campos necesarios están llenos
                if (!primerApellido || !primerNombre || !fechaNacimiento || rfcLast3.length !== 3) {
                    console.warn("Faltan datos para generar el RFC");
                    rfcInput.value = '';
                    return;
                }

                try {
                    // Letras iniciales del RFC
                    const primeraLetraApellido = primerApellido.charAt(0);
                    const primeraVocalInternaApellido = primerApellido.slice(1).match(/[AEIOU]/)?.[0] || 'X';
                    const primeraLetraSegundoApellido = segundoApellido.charAt(0);
                    const primeraLetraNombre = primerNombre.charAt(0);

                    // Fecha de nacimiento en formato AAMMDD
                    const [anio, mes, dia] = fechaNacimiento.split('-');
                    const fechaFormato = anio.slice(2) + mes.padStart(2, '0') + dia.padStart(2, '0');

                    // Construcción del RFC
                    const rfcBase =
                        `${primeraLetraApellido}${primeraVocalInternaApellido}${primeraLetraSegundoApellido}${primeraLetraNombre}${fechaFormato}`;

                    // Completar el RFC con los últimos 3 dígitos
                    const rfcCompleto = rfcBase + rfcLast3;

                    // Asignar el RFC al campo correspondiente
                    rfcInput.value = rfcCompleto;
                    console.log("RFC generado exitosamente:", rfcCompleto);
                } catch (error) {
                    console.error("Error al generar el RFC:", error);
                    rfcInput.value = '';
                }
            }
            rfcLast3Input.addEventListener('input', function() {
                this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0,
                3); // Formateo en mayúsculas y sin caracteres especiales

                if (this.value.length === 3) {
                    generarRFC(); // Genera el RFC cuando se ingresan 3 caracteres
                } else {
                    rfcInput.value = ''; // Limpia el RFC si no se cumplen los requisitos
                }
            });

            [primerNombreInput, primerApellidoInput, segundoApellidoInput, fechaNacimientoInput].forEach(
            elemento => {
                elemento.addEventListener('change', generarRFC);
            });
            // Evento para el Primer Nombre
            primerNombreInput.addEventListener('input', function() {
                habilitarCampoSiguiente('primer_nombre');
            });

            // Evento para el Primer Apellido
            primerApellidoInput.addEventListener('input', function() {
                habilitarCampoSiguiente('primer_apellido');
            });

            // Evento para la Fecha de Nacimiento
            fechaNacimientoInput.addEventListener('input', function() {
                habilitarCampoSiguiente('fecha_nacimiento');
            });

            // Evento para el Estado de Nacimiento
            estadoNacimientoSelect.addEventListener('change', function() {
                habilitarCampoSiguiente('estado_nacimiento');
            });

            // Evento para los Botones de Radio de Género (sexo)
            sexoInputs.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    generarCURP();
                });
            });

            // Evento para los 2 Últimos Dígitos de CURP
            // Evento para los 2 Últimos Dígitos de CURP
            curpLast2Input.addEventListener('input', function() {
                // Convertir a mayúsculas y eliminar caracteres no permitidos
                curpLast2Input.value = curpLast2Input.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0,
                    2);

                // Validar el formato
                const regex = /^[A-Z0-9]{2}$/;
                if (curpLast2Input.value.length === 2 && regex.test(curpLast2Input.value)) {
                    curpLast2Input.classList.remove('form-error');
                    curpLast2Input.setCustomValidity('');
                    habilitarCampoSiguiente('curp_last2');

                    // Generar la CURP una vez que el formato es correcto
                    generarCURP();
                } else {
                    curpLast2Input.classList.add('form-error');
                    curpLast2Input.setCustomValidity(
                        'Formato incorrecto. Usa una letra y un número o un número y una letra.');
                    curpInput.value = ''; // Limpiar el campo CURP si el formato es incorrecto
                }
            });


            // Evento para la Fecha de Apertura
            fechaAperturaInput.addEventListener('input', function() {
                habilitarCampoSiguiente('fecha_apertura');
                generarCURP();
            });

            // Evento para Resultado de Evaluación (opcional, si se necesita lógica adicional)
            resultadoEvaluacionInputs.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    // Lógica adicional si es necesaria
                });
            });

            // Reemplaza el evento listener actual del curp_last2Input con este:
            curpLast2Input.addEventListener('input', function() {
                // Convertir a mayúsculas y eliminar caracteres no permitidos
                this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 2);

                if (this.value.length === 2) {
                    const regex = /^[A-Z0-9]{2}$/;
                    if (regex.test(this.value)) {
                        this.classList.remove('form-error');
                        this.setCustomValidity('');
                        fechaAperturaInput.disabled = false; // Habilitar fecha de apertura
                        generarCURP(); // Generar CURP cuando el formato es correcto
                    } else {
                        this.classList.add('form-error');
                        this.setCustomValidity(
                            'Formato incorrecto. Usa una letra y un número o un número y una letra.');
                        fechaAperturaInput.disabled = true;
                        curpInput.value = '';
                    }
                } else {
                    fechaAperturaInput.disabled = true;
                    curpInput.value = '';
                }
            });

            // Modifica la función generarCURP para incluir validaciones más robustas:
            function generarCURP() {
                // Validar que todos los campos requeridos estén presentes
                const primerApellido = primerApellidoInput.value.trim().toUpperCase();
                const segundoApellido = (segundoApellidoInput.value || 'X').trim().toUpperCase();
                const primerNombre = primerNombreInput.value.trim().toUpperCase();
                const fechaNacimiento = fechaNacimientoInput.value;
                const sexo = Array.from(sexoInputs).find(radio => radio.checked)?.value;
                const estadoNacimiento = estadoNacimientoSelect.value;
                const curpLast2 = curpLast2Input.value.trim().toUpperCase();

                if (!primerApellido || !primerNombre || !fechaNacimiento || !sexo || !estadoNacimiento || curpLast2
                    .length !== 2) {
                    console.warn("Faltan datos requeridos para generar la CURP");
                    curpInput.value = '';
                    return;
                }

                try {
                    // Extracción de letras iniciales
                    const primeraLetraApellido = primerApellido.charAt(0);
                    const primeraVocalInternaApellido = primerApellido.slice(1).match(/[AEIOU]/)?.[0] || 'X';
                    const primeraLetraSegundoApellido = segundoApellido.charAt(0);
                    const primeraLetraNombre = primerNombre.charAt(0);

                    // Fecha de nacimiento en formato AAMMDD
                    const [anio, mes, dia] = fechaNacimiento.split('-');
                    const fechaFormato = anio.slice(2) + (mes.padStart(2, '0')) + (dia.padStart(2, '0'));

                    // Consonantes internas
                    const consonanteInternaApellido = primerApellido.slice(1).match(/[BCDFGHJKLMNÑPQRSTVWXYZ]/)?.[
                        0] || 'X';
                    const consonanteInternaSegundoApellido = segundoApellido.slice(1).match(
                        /[BCDFGHJKLMNÑPQRSTVWXYZ]/)?.[0] || 'X';
                    const consonanteInternaNombre = primerNombre.slice(1).match(/[BCDFGHJKLMNÑPQRSTVWXYZ]/)?.[0] ||
                        'X';

                    // Construcción de la CURP
                    const curpBase =
                        `${primeraLetraApellido}${primeraVocalInternaApellido}${primeraLetraSegundoApellido}${primeraLetraNombre}${fechaFormato}${sexo}${estadoNacimiento}${consonanteInternaApellido}${consonanteInternaSegundoApellido}${consonanteInternaNombre}`;

                    // Agregar los últimos 2 dígitos
                    const curpCompleta = curpBase + curpLast2;

                    // Asignar el valor
                    curpInput.value = curpCompleta;
                    console.log("CURP generada exitosamente:", curpCompleta);
                } catch (error) {
                    console.error("Error al generar la CURP:", error);
                    curpInput.value = '';
                }
            }

            // Asegúrate de que todos los campos relevantes llamen a generarCURP cuando cambian
            [primerNombreInput, segundoNombreInput, primerApellidoInput, segundoApellidoInput,
                fechaNacimientoInput, estadoNacimientoSelect
            ].forEach(elemento => {
                elemento.addEventListener('change', generarCURP);
            });

            // Para los radio buttons de sexo
            sexoInputs.forEach(radio => {
                radio.addEventListener('change', generarCURP);
            });


            // Inicialización: Habilitar el Primer Nombre
            primerNombreInput.disabled = false;

            // Función para permitir solo letras y restringir múltiples palabras
            function soloUnaPalabra(event) {
                const regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/;
                const value = event.target.value;

                // Evitar que se ingrese un espacio o caracteres especiales
                if (event.key === ' ' || !regex.test(event.key)) {
                    event.preventDefault();
                }

                // Evitar agregar más caracteres si ya se ingresó una palabra
                if (value.includes(' ')) {
                    event.preventDefault();
                }
            }


            primerNombreInput.addEventListener('keypress', soloUnaPalabra);
            segundoNombreInput.addEventListener('keypress', soloUnaPalabra);
            primerApellidoInput.addEventListener('keypress', soloUnaPalabra);
            segundoApellidoInput.addEventListener('keypress', soloUnaPalabra);

        });

        function showModal() {
            document.getElementById("successModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("successModal").style.display = "none";
        }
    </script>
@endsection
