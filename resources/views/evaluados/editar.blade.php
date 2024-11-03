@extends('layouts.app')

@section('title', 'Editar Evaluado')

@section('css')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Estilos Personalizados -->
<style>
    /* Gradiente Principal con los nuevos colores */
    .bg-gradient-primary {
        background: linear-gradient(45deg, #800020 0%, #b30000 100%);
    }

    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #e3e6f0;
        padding: 0.75rem 1rem;
        transition: all 0.2s;
    }

    .form-control:focus {
        border-color: #800020;
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 32, 0.25);
    }

    .btn {
        border-radius: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        transition: all 0.2s;
    }

    .card {
        border-radius: 1rem;
        transition: all 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .form-group label {
        color: #800020;
        margin-bottom: 0.5rem;
    }

    .alert {
        border-radius: 1rem;
    }

    .input-group-text {
        background-color: #800020;
        color: white;
        border: none;
        border-radius: 0.5rem 0 0 0.5rem;
    }

    .btn-primary {
        background-color: #800020;
        border-color: #b30000;
    }

    .btn-primary:hover {
        background-color: #b30000;
        border-color: #800020;
    }
</style>
@endsection

@section('content')
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<section class="section py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Card Principal -->
                <div class="card shadow-lg border-0 rounded-lg">
                    <!-- Encabezado -->
                    <div
                        class="card-header bg-gradient-primary text-white p-4 d-flex align-items-center justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h3 class="m-0 text-center flex-grow-1">
                            <i class="fas fa-user-edit"></i> Editar Evaluado
                        </h3>
                        <div style="width: 40px;"></div>
                    </div>

                    <!-- Cuerpo -->
                    <div class="card-body p-4">
                        <!-- Alertas de Error -->
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <h5 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Errores Detectados
                            </h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                        @endif

                        <form action="{{ route('evaluados.update', $evaluado->id) }}" method="POST" id="evaluado-form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Columna Izquierda: Información Personal -->
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title text-maroon border-bottom pb-3 mb-4">
                                                <i class="fas fa-user-circle"></i> Información Personal
                                            </h5>
                                            <!-- Primer Nombre -->
                                            <div class="form-group">
                                                <label class="font-weight-bold"><i class="fas fa-user"></i> Primer
                                                    Nombre *</label>
                                                <input type="text" name="primer_nombre"
                                                    class="form-control form-control-lg @error('primer_nombre') is-invalid @enderror"
                                                    value="{{ old('primer_nombre', $evaluado->primer_nombre) }}" required>
                                                @error('primer_nombre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- Segundo Nombre -->
                                            <div class="form-group">
                                                <label class="font-weight-bold"><i class="fas fa-user"></i> Segundo
                                                    Nombre</label>
                                                <input type="text" name="segundo_nombre"
                                                    class="form-control form-control-lg @error('segundo_nombre') is-invalid @enderror"
                                                    value="{{ old('segundo_nombre', $evaluado->segundo_nombre) }}">
                                                @error('segundo_nombre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- Primer Apellido -->
                                            <div class="form-group">
                                                <label class="font-weight-bold"><i class="fas fa-user"></i> Primer
                                                    Apellido *</label>
                                                <input type="text" name="primer_apellido"
                                                    class="form-control form-control-lg @error('primer_apellido') is-invalid @enderror"
                                                    value="{{ old('primer_apellido', $evaluado->primer_apellido) }}" required>
                                                @error('primer_apellido')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- Segundo Apellido -->
                                            <div class="form-group">
                                                <label class="font-weight-bold"><i class="fas fa-user"></i> Segundo
                                                    Apellido</label>
                                                <input type="text" name="segundo_apellido"
                                                    class="form-control form-control-lg @error('segundo_apellido') is-invalid @enderror"
                                                    value="{{ old('segundo_apellido', $evaluado->segundo_apellido) }}">
                                                @error('segundo_apellido')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- Sexo -->
                                            <div class="form-group">
                                                <label class="font-weight-bold"><i class="fas fa-venus-mars"></i> Sexo
                                                    *</label>
                                                <select name="sexo"
                                                    class="form-control form-control-lg @error('sexo') is-invalid @enderror"
                                                    required>
                                                    <option value="" disabled selected>Seleccione el sexo</option>
                                                    <option value="H" {{ old('sexo', $evaluado->sexo)=='H' ? 'selected' : '' }}>Hombre
                                                    </option>
                                                    <option value="M" {{ old('sexo', $evaluado->sexo)=='M' ? 'selected' : '' }}>Mujer
                                                    </option>
                                                </select>
                                                @error('sexo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- Fecha de Nacimiento -->
                                            <div class="form-group">
                                                <label class="font-weight-bold"><i class="fas fa-calendar-alt"></i>
                                                    Fecha de Nacimiento *</label>
                                                <input type="text" name="fecha_nacimiento" id="fecha_nacimiento"
                                                    class="form-control form-control-lg @error('fecha_nacimiento') is-invalid @enderror"
                                                    value="{{ old('fecha_nacimiento', $evaluado->fecha_nacimiento) }}" required>
                                                @error('fecha_nacimiento')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="estado_nacimiento"
                                                    class="block text-red-900 font-medium mb-2">Estado de Nacimiento
                                                    *</label>
                                                <select name="estado_nacimiento" id="estado_nacimiento"
                                                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-red-800 focus:border-red-800 @error('estado_nacimiento') border-red-500 @enderror"
                                                    required>
                                                    <option value="">Seleccione...</option>
                                                    <option value="AG" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='AG' ? 'selected'
                                                        : '' }}>Aguascalientes</option>
                                                    <option value="BC" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='BC' ? 'selected'
                                                        : '' }}>Baja California</option>
                                                    <option value="BS" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='BS' ? 'selected'
                                                        : '' }}>Baja California Sur</option>
                                                    <option value="CM" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='CM' ? 'selected'
                                                        : '' }}>Campeche</option>
                                                    <option value="CS" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='CS' ? 'selected'
                                                        : '' }}>Chiapas</option>
                                                    <option value="CH" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='CH' ? 'selected'
                                                        : '' }}>Chihuahua</option>
                                                    <option value="CO" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='CO' ? 'selected'
                                                        : '' }}>Coahuila</option>
                                                    <option value="CL" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='CL' ? 'selected'
                                                        : '' }}>Colima</option>
                                                    <option value="DG" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='DG' ? 'selected'
                                                        : '' }}>Durango</option>
                                                    <option value="GT" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='GT' ? 'selected'
                                                        : '' }}>Guanajuato</option>
                                                    <option value="GR" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='GR' ? 'selected'
                                                        : '' }}>Guerrero</option>
                                                    <option value="HG" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='HG' ? 'selected'
                                                        : '' }}>Hidalgo</option>
                                                    <option value="JA" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='JA' ? 'selected'
                                                        : '' }}>Jalisco</option>
                                                    <option value="MX" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='MX' ? 'selected'
                                                        : '' }}>Estado de México</option>
                                                    <option value="MI" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='MI' ? 'selected'
                                                        : '' }}>Michoacán</option>
                                                    <option value="MO" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='MO' ? 'selected'
                                                        : '' }}>Morelos</option>
                                                    <option value="NA" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='NA' ? 'selected'
                                                        : '' }}>Nayarit</option>
                                                    <option value="NL" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='NL' ? 'selected'
                                                        : '' }}>Nuevo León</option>
                                                    <option value="OA" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='OA' ? 'selected'
                                                        : '' }}>Oaxaca</option>
                                                    <option value="PU" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='PU' ? 'selected'
                                                        : '' }}>Puebla</option>
                                                    <option value="QE" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='QE' ? 'selected'
                                                        : '' }}>Querétaro</option>
                                                    <option value="QR" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='QR' ? 'selected'
                                                        : '' }}>Quintana Roo</option>
                                                    <option value="SL" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='SL' ? 'selected'
                                                        : '' }}>San Luis Potosí</option>
                                                    <option value="SI" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='SI' ? 'selected'
                                                        : '' }}>Sinaloa</option>
                                                    <option value="SO" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='SO' ? 'selected'
                                                        : '' }}>Sonora</option>
                                                    <option value="TB" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='TB' ? 'selected'
                                                        : '' }}>Tabasco</option>
                                                    <option value="TM" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='TM' ? 'selected'
                                                        : '' }}>Tamaulipas</option>
                                                    <option value="TL" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='TL' ? 'selected'
                                                        : '' }}>Tlaxcala</option>
                                                    <option value="VE" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='VE' ? 'selected'
                                                        : '' }}>Veracruz</option>
                                                    <option value="YU" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='YU' ? 'selected'
                                                        : '' }}>Yucatán</option>
                                                    <option value="ZA" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='ZA' ? 'selected'
                                                        : '' }}>Zacatecas</option>
                                                    <option value="DF" {{ old('estado_nacimiento', $evaluado->estado_nacimiento)=='DF' ? 'selected'
                                                        : '' }}>Ciudad de México</option>
                                                </select>
                                                @error('estado_nacimiento')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Columna Central: Documentación -->
                                    <div class="col-md-4">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title text-maroon border-bottom pb-3 mb-4">
                                                    <i class="fas fa-id-card"></i> Documentación
                                                </h5>

                                                <!-- CURP Faltante (Últimos 2 dígitos) -->
                                                <div class="form-group">
                                                    <label for="CURP_faltante" class="form-label">CURP Faltante (Últimos 2
                                                        dígitos)</label>
                                                    <input type="text" name="CURP_faltante" id="CURP_faltante"
                                                        class="form-control @error('CURP_faltante') is-invalid @enderror"
                                                        pattern="[A-Z0-9]{2}" maxlength="2" placeholder="Ej:12"
                                                        value="{{ old('CURP_faltante', $evaluado->CURP_faltante) }}">
                                                    @error('CURP_faltante')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <!-- CURP -->
                                                <div class="form-group">
                                                    <label class="font-weight-bold"><i class="fas fa-fingerprint"></i> CURP
                                                        *</label>
                                                    <input type="text" name="CURP" id="CURP"
                                                        class="form-control form-control-lg @error('CURP') is-invalid @enderror"
                                                        value="{{ old('CURP', $evaluado->CURP) }}" required maxlength="18" readonly>
                                                    @error('CURP')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <!-- RFC Faltante -->
                                                <div class="form-group">
                                                    <label for="RFC_faltante" class="form-label">RFC Faltante (Últimos 2
                                                        dígitos)</label>
                                                    <input type="text" name="RFC_faltante" id="RFC_faltante"
                                                        class="form-control @error('RFC_faltante') is-invalid @enderror"
                                                        pattern="\d{2}" maxlength="2" placeholder="Ej: 34"
                                                        value="{{ old('RFC_faltante', $evaluado->RFC_faltante) }}">
                                                    @error('RFC_faltante')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <!-- RFC -->
                                                <div class="form-group">
                                                    <label class="font-weight-bold"><i class="fas fa-file-alt"></i>
                                                        RFC</label>
                                                    <input type="text" name="RFC" id="RFC"
                                                        class="form-control form-control-lg @error('RFC') is-invalid @enderror"
                                                        value="{{ old('RFC', $evaluado->RFC) }}" maxlength="13" readonly>
                                                    @error('RFC')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <!-- IFE Faltante (Últimos 3 dígitos) -->
                                                <div class="form-group">
                                                    <label for="IFE_faltante" class="form-label">IFE Faltante (Últimos 3 dígitos)</label>
                                                    <input type="text" name="IFE_faltante" id="IFE_faltante"
                                                        class="form-control @error('IFE_faltante') is-invalid @enderror"
                                                        pattern="\d{3}" maxlength="3" placeholder="Ej: 123"
                                                        value="{{ old('IFE_faltante', $evaluado->IFE_faltante) }}">
                                                    @error('IFE_faltante')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <!-- IFE -->
                                                <div class="form-group">
                                                    <label class="font-weight-bold"><i class="fas fa-id-card"></i> IFE
                                                        *</label>
                                                    <input type="text" name="IFE" id="IFE"
                                                        class="form-control form-control-lg @error('IFE') is-invalid @enderror"
                                                        value="{{ old('IFE', $evaluado->IFE) }}" required maxlength="13"
                                                        pattern="[A-Z0-9]{13}" readonly>
                                                    @error('IFE')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <small class="form-text text-muted">Debe tener 13 caracteres
                                                        alfanuméricos.</small>
                                                </div>

                                                <!-- SMN -->
                                                <div class="form-group">
                                                    <label class="font-weight-bold"><i class="fas fa-id-card"></i>
                                                        SMN</label>
                                                    <input type="text" name="SMN" id="SMN"
                                                        class="form-control form-control-lg @error('SMN') is-invalid @enderror"
                                                        value="{{ old('SMN', $evaluado->SMN) }}" pattern="[A-Z0-9]{3}-\d{2}-[A-Z0-9]{6}"
                                                        placeholder="ABC-12-123ABC" maxlength="13" required>
                                                    <small class="form-text text-muted">Formato: ABC-12-123ABC</small>
                                                    @error('SMN')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Columna Derecha: Información Adicional -->
                                    <div class="col-md-4">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title text-maroon border-bottom pb-3 mb-4">
                                                    <i class="fas fa-calendar-alt"></i> Información Adicional
                                                </h5>

                                                <!-- Fecha de Apertura -->
                                                <div class="form-group">
                                                    <label class="font-weight-bold"><i class="fas fa-calendar-alt"></i>
                                                        Fecha de Apertura *</label>
                                                    <input type="date" name="fecha_apertura" id="fecha_apertura"
                                                        class="form-control form-control-lg @error('fecha_apertura') is-invalid @enderror"
                                                        value="{{ old('fecha_apertura', $evaluado->fecha_apertura) }}" required>
                                                    @error('fecha_apertura')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <!-- Resultado de Evaluación -->
                                                <div class="form-group">
                                                    <label for="resultado_evaluacion" class="font-weight-bold">Resultado de
                                                        Evaluación *</label>
                                                    <select name="resultado_evaluacion"
                                                        class="form-control form-control-lg @error('resultado_evaluacion') is-invalid @enderror"
                                                        id="resultado_evaluacion" required>
                                                        <option value="" disabled selected>Seleccione el resultado</option>
                                                        <option value="1" {{ old('resultado_evaluacion', $evaluado->resultado_evaluacion)=='1' ? 'selected'
                                                            : '' }}>Aprobado</option>
                                                        <option value="0" {{ old('resultado_evaluacion', $evaluado->resultado_evaluacion)=='0' ? 'selected'
                                                            : '' }}>No Aprobado</option>
                                                    </select>
                                                    @error('resultado_evaluacion')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botón de Envío -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-3">
                                        <i class="fas fa-save mr-2"></i> Actualizar Registro
                                    </button>
                                    <a href="{{ route('evaluados.index') }}" class="btn btn-light btn-lg px-5 py-3 ml-2">
                                        Cancelar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar Flatpickr en el campo de fecha de nacimiento
        flatpickr("#fecha_nacimiento", {
            dateFormat: "Y-m-d",
            allowInput: true,
            altInput: true,
            altFormat: "F j, Y",
            maxDate: "today",
            locale: "es"
        });

        // Funciones para generar CURP, RFC e IFE
        function generarCURP() {
            var primerNombre = document.querySelector('input[name="primer_nombre"]').value.trim().toUpperCase();
            var primerApellido = document.querySelector('input[name="primer_apellido"]').value.trim().toUpperCase();
            var segundoApellido = document.querySelector('input[name="segundo_apellido"]').value.trim().toUpperCase();
            var sexo = document.querySelector('select[name="sexo"]').value;
            var fechaNacimiento = document.querySelector('input[name="fecha_nacimiento"]').value;
            var estadoNacimiento = document.querySelector('select[name="estado_nacimiento"]').value;
            var curpFaltante = document.getElementById('CURP_faltante') ? document.getElementById('CURP_faltante').value.trim().toUpperCase() : '';

            if (primerNombre && primerApellido && segundoApellido && sexo && fechaNacimiento && estadoNacimiento && curpFaltante.length === 2) {
                var curp = primerApellido.charAt(0) + primerApellido.charAt(1) + 
                           segundoApellido.charAt(0) + 
                           primerNombre.charAt(0) +
                           fechaNacimiento.substring(2, 4) + 
                           fechaNacimiento.substring(5, 7) + 
                           fechaNacimiento.substring(8, 10) +
                           sexo +
                           estadoNacimiento +
                           curpFaltante;
                document.getElementById('CURP').value = curp.toUpperCase();
            } else {
                document.getElementById('CURP').value = '';
            }
        }

        function generarRFC() {
            var primerNombre = document.querySelector('input[name="primer_nombre"]').value.trim().toUpperCase();
            var primerApellido = document.querySelector('input[name="primer_apellido"]').value.trim().toUpperCase();
            var segundoApellido = document.querySelector('input[name="segundo_apellido"]').value.trim().toUpperCase();
            var fechaNacimiento = document.querySelector('input[name="fecha_nacimiento"]').value;
            var rfcFaltante = document.getElementById('RFC_faltante') ? document.getElementById('RFC_faltante').value : '';

            if (primerNombre && primerApellido && segundoApellido && fechaNacimiento && rfcFaltante.length === 2) {
                var rfc = primerApellido.charAt(0) + primerApellido.charAt(1) + 
                          segundoApellido.charAt(0) + 
                          primerNombre.charAt(0) +
                          fechaNacimiento.substring(2, 4) + 
                          fechaNacimiento.substring(5, 7) + 
                          fechaNacimiento.substring(8, 10) +
                          rfcFaltante;
                document.getElementById('RFC').value = rfc.toUpperCase();
            } else {
                document.getElementById('RFC').value = '';
            }
        }

        function generarIFE() {
            var primerNombre = $('input[name="primer_nombre"]').val().trim().toUpperCase();
            var primerApellido = $('input[name="primer_apellido"]').val().trim().toUpperCase();
            var segundoApellido = $('input[name="segundo_apellido"]').val().trim().toUpperCase();
            var fechaNacimiento = $('input[name="fecha_nacimiento"]').val();
            var IFE_faltante = $('#IFE_faltante').val().trim();

            if (primerNombre && primerApellido && segundoApellido && fechaNacimiento && IFE_faltante.length === 3) {
                var IFE = primerApellido.substring(0, 2) + 
                          segundoApellido.charAt(0) + 
                          primerNombre.charAt(0) +
                          fechaNacimiento.substring(2, 4) + 
                          fechaNacimiento.substring(5, 7) + 
                          fechaNacimiento.substring(8, 10) + 
                          IFE_faltante;
                $('#IFE').val(IFE.toUpperCase());
            } else {
                $('#IFE').val('');
            }
        }

        // Función para formatear automáticamente el campo SMN
        document.querySelector('#SMN').addEventListener('input', function() {
            // Permitir solo letras y números, eliminar otros caracteres
            var smn = this.value.replace(/[^A-Z0-9]/gi, '').toUpperCase();
            
            // Insertar guiones después de los primeros 3 y 5 caracteres
            if (smn.length > 3) smn = smn.slice(0, 3) + '-' + smn.slice(3);
            if (smn.length > 5) smn = smn.slice(0, 6) + '-' + smn.slice(6);
            
            // Limitar a 13 caracteres (incluyendo los guiones)
            this.value = smn.slice(0, 13);
        });

        // Detectar cambios en campos clave y actualizar automáticamente CURP, RFC e IFE
        $('input[name="primer_nombre"], input[name="primer_apellido"], input[name="segundo_apellido"], input[name="fecha_nacimiento"], #CURP_faltante, #RFC_faltante, #IFE_faltante').on('input change', function() {
            generarCURP();
            generarRFC();
            generarIFE();
        });
    });
</script>
@endsection
