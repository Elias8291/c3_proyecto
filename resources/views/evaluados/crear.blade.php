@extends('layouts.app')

@section('content')
<section class="section" style="min-height: 100vh; display: flex; align-items: center; ">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 rounded-lg bg-transparent;">
                    <!-- Cabecera de la Tarjeta -->
                    <div class="card-header d-flex align-items-center justify-content-between bg-maroon">
                        <a href="{{ url()->previous() }}" class="btn btn-back text-black">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                        <h3 class="page__heading text-center flex-grow-1 m-0 text-balck" >
                            <i class="fas fa-user-plus mr-2"></i> Crear Evaluado
                        </h3>
                        <div style="width: 50px;"></div>
                    </div>

                    <!-- Cuerpo de la Tarjeta -->
                    <div class="card-body p-5">
                        <!-- Mensajes de Error -->
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <!-- Formulario -->
                        <form action="{{ route('evaluados.store') }}" method="POST" class="my-4" id="evaluado-form">
                            @csrf

                            <div class="row">
                                <!-- Sección Información Personal -->
                                <div class="col-md-6 mb-4">
                                    <div class="card border-0 shadow-sm bg-light">
                                        <div class="card-body p-4">
                                            <h5 class="card-title text-maroon mb-3"><i class="fas fa-user mr-2"></i> Información Personal</h5>

                                            <!-- Primer Nombre -->
                                            <div class="form-group">
                                                <label for="primer_nombre" class="form-label">Primer Nombre</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                                    <input type="text" name="primer_nombre" class="form-control @error('primer_nombre') is-invalid @enderror" id="primer_nombre" required value="{{ old('primer_nombre') }}" placeholder="Ej: JUAN" style="text-transform: uppercase;">
                                                    @error('primer_nombre')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Segundo Nombre -->
                                            <div class="form-group">
                                                <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                                    <input type="text" name="segundo_nombre" class="form-control @error('segundo_nombre') is-invalid @enderror" id="segundo_nombre" value="{{ old('segundo_nombre') }}" placeholder="Opcional" style="text-transform: uppercase;">
                                                    @error('segundo_nombre')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Primer Apellido -->
                                            <div class="form-group">
                                                <label for="primer_apellido" class="form-label">Primer Apellido</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    <input type="text" name="primer_apellido" class="form-control @error('primer_apellido') is-invalid @enderror" id="primer_apellido" required value="{{ old('primer_apellido') }}" placeholder="Ej: PÉREZ" style="text-transform: uppercase;">
                                                    @error('primer_apellido')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Segundo Apellido -->
                                            <div class="form-group">
                                                <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    <input type="text" name="segundo_apellido" class="form-control @error('segundo_apellido') is-invalid @enderror" id="segundo_apellido" value="{{ old('segundo_apellido') }}" placeholder="Opcional" style="text-transform: uppercase;">
                                                    @error('segundo_apellido')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Sexo -->
                                            <div class="form-group">
                                                <label for="sexo" class="form-label">Sexo</label>
                                                <select name="sexo" class="form-control @error('sexo') is-invalid @enderror" id="sexo" required>
                                                    <option value="" disabled selected>Seleccione</option>
                                                    <option value="H" {{ old('sexo')=='H' ? 'selected' : '' }}>Hombre</option>
                                                    <option value="M" {{ old('sexo')=='M' ? 'selected' : '' }}>Mujer</option>
                                                </select>
                                                @error('sexo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- Fecha de Nacimiento -->
                                            <div class="form-group">
                                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                                <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" required value="{{ old('fecha_nacimiento') }}" id="fecha_nacimiento">
                                                <small class="form-text text-muted">Debe ser mayor de edad</small>
                                                @error('fecha_nacimiento')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- Estado de Nacimiento -->
                                            <div class="form-group">
                                                <label for="estado_nacimiento" class="form-label">Estado de Nacimiento</label>
                                                <select name="estado_nacimiento" class="form-control @error('estado_nacimiento') is-invalid @enderror" id="estado_nacimiento" required>
                                                    <option value="" disabled selected>Seleccione el estado</option>
                                                    <option value="AS" {{ old('estado_nacimiento')=='AS' ? 'selected' : '' }}>Aguascalientes</option>
                                                    <!-- Añade las demás opciones aquí -->
                                                </select>
                                                <small class="form-text text-muted">Ejemplo: Baja California (BC)</small>
                                                @error('estado_nacimiento')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- Fecha de Apertura -->
                                            <div class="form-group">
                                                <label for="fecha_apertura" class="form-label">Fecha de Apertura</label>
                                                <input type="date" name="fecha_apertura" class="form-control @error('fecha_apertura') is-invalid @enderror" required value="{{ old('fecha_apertura') }}" id="fecha_apertura">
                                                @error('fecha_apertura')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sección de Identificación -->
                                <div class="col-md-6 mb-4">
                                    <div class="card border-0 shadow-sm bg-light">
                                        <div class="card-body p-4">
                                            <h5 class="card-title text-maroon mb-3"><i class="fas fa-id-card mr-2"></i> Identificación</h5>

                                            <!-- CURP -->
                                            <div class="form-group">
                                                <label for="CURP" class="form-label">CURP</label>
                                                <input type="text" name="CURP" class="form-control @error('CURP') is-invalid @enderror" id="CURP" value="{{ old('CURP') }}" readonly>
                                                <small class="form-text text-muted">Ejemplo: ABCD123456HDFABC01</small>
                                                @error('CURP')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- CURP Faltante -->
                                            <div class="form-group">
                                                <label for="CURP_faltante" class="form-label">CURP Faltante (Últimos 2 dígitos)</label>
                                                <input type="text" name="CURP_faltante" class="form-control @error('CURP_faltante') is-invalid @enderror" id="CURP_faltante" pattern="\d{2}" maxlength="2" inputmode="numeric" placeholder="Ej: 12" value="{{ old('CURP_faltante') }}">
                                                <small id="CURP_faltante_counter" class="form-text text-muted">0/2 caracteres</small>
                                                @error('CURP_faltante')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- RFC -->
                                            <div class="form-group">
                                                <label for="RFC" class="form-label">RFC</label>
                                                <input type="text" name="RFC" class="form-control @error('RFC') is-invalid @enderror" id="RFC" value="{{ old('RFC') }}" readonly>
                                                <small class="form-text text-muted">Ejemplo: ABCD900115XX</small>
                                                @error('RFC')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- RFC Faltante -->
                                            <div class="form-group">
                                                <label for="RFC_faltante" class="form-label">RFC Faltante (Últimos 2 dígitos)</label>
                                                <input type="text" name="RFC_faltante" class="form-control @error('RFC_faltante') is-invalid @enderror" id="RFC_faltante" pattern="\d{2}" maxlength="2" inputmode="numeric" placeholder="Ej: 34" value="{{ old('RFC_faltante') }}">
                                                <small id="RFC_faltante_counter" class="form-text text-muted">0/2 caracteres</small>
                                                @error('RFC_faltante')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- Resultado de Evaluación -->
                                            <div class="form-group">
                                                <label for="resultado_evaluacion" class="form-label">Resultado de Evaluación</label>
                                                <select name="resultado_evaluacion" class="form-control @error('resultado_evaluacion') is-invalid @enderror" id="resultado_evaluacion" required>
                                                    <option value="" disabled selected>Seleccione el resultado</option>
                                                    <option value="1" {{ old('resultado_evaluacion')=='1' ? 'selected' : '' }}>Aprobado</option>
                                                    <option value="0" {{ old('resultado_evaluacion')=='0' ? 'selected' : '' }}>No Aprobado</option>
                                                </select>
                                                <small class="form-text text-muted">Seleccione Aprobado o No Aprobado</small>
                                                @error('resultado_evaluacion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- IFE -->
                                            <div class="form-group">
                                                <label for="IFE" class="form-label">IFE</label>
                                                <input type="text" name="IFE" class="form-control @error('IFE') is-invalid @enderror" id="IFE" value="{{ old('IFE') }}" placeholder="13 caracteres alfanuméricos" style="text-transform: uppercase;">
                                                <small id="IFE_counter" class="form-text text-muted">0/13 caracteres</small>
                                                @error('IFE')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- SMN -->
                                            <div class="form-group">
                                                <label for="SMN" class="form-label">SMN (Servicio Militar Nacional)</label>
                                                <input type="text" name="SMN" class="form-control @error('SMN') is-invalid @enderror" id="SMN" value="{{ old('SMN') }}" pattern="^[A-Z0-9]{10,12}$" placeholder="Entre 10 y 12 caracteres" title="El SMN debe tener entre 10 y 12 caracteres alfanuméricos." style="text-transform: uppercase;">
                                                <small id="SMN_counter" class="form-text text-muted">0/12 caracteres</small>
                                                @error('SMN')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <!-- CUIP -->
                                            <div class="form-group">
                                                <label for="CUIP" class="form-label">CUIP</label>
                                                <input type="text" name="CUIP" class="form-control @error('CUIP') is-invalid @enderror" id="CUIP" value="{{ old('CUIP') }}" placeholder="Debe contener 13 caracteres" style="text-transform: uppercase;">
                                                <small id="CUIP_counter" class="form-text text-muted">0/13 caracteres</small>
                                                @error('CUIP')
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
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



@section('scripts')
<script>
    $(document).ready(function() {
        // Función para forzar mayúsculas en todos los campos de texto y prevenir espacios en los nombres
        $('input[type="text"], select').on('input change', function() {
            // Forzar mayúsculas
            this.value = this.value.toUpperCase();

            // Validar campos de nombre para que no contengan espacios
            if ($(this).attr('name') === 'primer_nombre' ||
                $(this).attr('name') === 'segundo_nombre' ||
                $(this).attr('name') === 'primer_apellido' ||
                $(this).attr('name') === 'segundo_apellido') {
                // Eliminar espacios
                this.value = this.value.replace(/\s/g, '');
            }
        });

        // Funciones auxiliares para obtener la primera vocal y consonante interna
        function obtenerPrimeraVocal(apellido) {
            var vocales = apellido.match(/[AEIOU]/i);
            return vocales ? vocales[0].toUpperCase() : 'X';
        }

        function obtenerPrimeraConsonante(nombre) {
            var consonantes = nombre.slice(1).match(/[BCDFGHJKLMNÑPQRSTVWXYZ]/i);
            return consonantes ? consonantes[0].toUpperCase() : 'X';
        }

        // Función para generar la CURP
        function generarCURP() {
            var primer_nombre = $('#primer_nombre').val().trim().toUpperCase();
            var primer_apellido = $('#primer_apellido').val().trim().toUpperCase();
            var segundo_apellido = $('#segundo_apellido').val().trim().toUpperCase();
            var sexo = $('#sexo').val();
            var fecha_nacimiento = $('#fecha_nacimiento').val();
            var estado_nacimiento = $('#estado_nacimiento').val().toUpperCase();

            // Verificar que todos los campos necesarios estén llenos
            if (primer_nombre && primer_apellido && sexo && fecha_nacimiento && estado_nacimiento) {
                // Extraer datos de la fecha de nacimiento usando split para evitar problemas de timezone
                var partes_fecha = fecha_nacimiento.split('-');
                var año = partes_fecha[0].slice(-2);
                var mes = partes_fecha[1];
                var dia = partes_fecha[2];

                // Construir la CURP
                var curp = primer_apellido.charAt(0); // Primera letra del primer apellido
                curp += obtenerPrimeraVocal(primer_apellido); // Primera vocal interna del primer apellido
                curp += (segundo_apellido.charAt(0) || 'X'); // Primera letra del segundo apellido (si no hay, usar 'X')
                curp += (primer_nombre.charAt(0) || 'X'); // Primera letra del primer nombre
                curp += año + mes + dia; // Año, mes y día de nacimiento
                curp += sexo; // Sexo (H o M)
                curp += estado_nacimiento; // Estado de nacimiento
                curp += (obtenerPrimeraConsonante(primer_apellido) || 'X'); // Primera consonante interna del primer apellido
                curp += (obtenerPrimeraConsonante(segundo_apellido) || 'X'); // Primera consonante interna del segundo apellido (si no hay, 'X')
                curp += (obtenerPrimeraConsonante(primer_nombre) || 'X'); // Primera consonante interna del primer nombre

                // Obtener los últimos dos dígitos de CURP_faltante
                var curp_faltante = $('#CURP_faltante').val();

                // Verificar si el sexo es masculino y se han ingresado los dígitos faltantes
                if (sexo === 'H' && curp_faltante.length === 2) {
                    curp += curp_faltante;
                } else if (sexo === 'M') { // Femenino
                    curp += '00'; // Asignar '00' o cualquier otro valor por defecto
                } else {
                    // Si no se han ingresado los dígitos faltantes, no completar la CURP
                    curp = '';
                }

                // Asignar la CURP completa al campo CURP
                $('#CURP').val(curp);
                console.log(`CURP completa: ${curp}`);
            } else {
                // Si no se cumplen los requisitos, limpiar el campo CURP
                $('#CURP').val('');
                console.log('CURP deshabilitada y limpiada por falta de campos');
            }
        }

        // Función para generar el RFC
        // Función para generar el RFC
        function generarRFC() {
            var primer_nombre = $('#primer_nombre').val().trim().toUpperCase();
            var primer_apellido = $('#primer_apellido').val().trim().toUpperCase();
            var segundo_apellido = $('#segundo_apellido').val().trim().toUpperCase();
            var fecha_nacimiento = $('#fecha_nacimiento').val();
            var rfc_faltante = $('#RFC_faltante').val();

            // Verificar que todos los campos necesarios estén llenos y que el rfc_faltante tenga 2 dígitos
            if (primer_nombre && primer_apellido && fecha_nacimiento && rfc_faltante.length === 2) {
                // Construir el RFC
                var partes_fecha = fecha_nacimiento.split('-');
                var año = partes_fecha[0].slice(-2);
                var mes = partes_fecha[1];
                var dia = partes_fecha[2];

                var rfc = primer_apellido.charAt(0); // Primera letra del primer apellido
                rfc += obtenerPrimeraVocal(primer_apellido); // Primera vocal interna del primer apellido
                rfc += (segundo_apellido.charAt(0) || 'X'); // Primera letra del segundo apellido (si no existe, 'X')
                rfc += (primer_nombre.charAt(0) || 'X'); // Primera letra del primer nombre
                rfc += año + mes + dia; // Fecha de nacimiento (año, mes, día)
                rfc += rfc_faltante; // Últimos dos dígitos del RFC faltante

                // Asignar el RFC generado al campo RFC
                $('#RFC').val(rfc);
                $('#RFC').prop('disabled', false); // Habilitar el campo si está deshabilitado
                console.log(`RFC generado: ${rfc}`);
            } else {
                // Si no se cumplen los requisitos, limpiar el campo RFC
                $('#RFC').val('');
                $('#RFC').prop('disabled', true); // Deshabilitar el campo
                console.log('RFC deshabilitado y limpiado por falta de campos o rfc_faltante incorrecto');
            }
        }
        // Validación del campo CUIP (13 caracteres alfanuméricos)
        function validarCUIP() {
            var cuip = $('#CUIP').val().toUpperCase();
            var cuipPattern = /^[A-Z0-9]{13}$/; // Patrón para validar la CUIP (13 caracteres alfanuméricos)

            if (cuipPattern.test(cuip)) {
                console.log('CUIP válida: ' + cuip);
                return true;
            } else {
                alert('La CUIP debe contener exactamente 13 caracteres alfanuméricos.');
                return false;
            }
        }

        // Función para actualizar el contador de caracteres
        $('#CUIP').on('input', function() {
            actualizarContador('CUIP', 13);
        });

        // Asignar la validación del formulario al evento de envío
        $('#evaluado-form').on('submit', function(e) {
            if (!validarCUIP()) {
                e.preventDefault(); // Evita el envío si la CUIP no es válida
            }
        });


        // Validación del campo IFE (13 caracteres alfanuméricos)
        function validarIFE() {
            var ife = $('#IFE').val().toUpperCase();
            var ifePattern = /^[A-Z0-9]{13}$/; // Patrón para validar el IFE

            if (ifePattern.test(ife)) {
                console.log('IFE válido: ' + ife);
                return true;
            } else {
                alert('El IFE debe tener 13 caracteres alfanuméricos.');
                return false;
            }
        }

        // Función para generar el IFE
        function generarIFE() {
            var primer_nombre = $('#primer_nombre').val().trim().toUpperCase();
            var primer_apellido = $('#primer_apellido').val().trim().toUpperCase();
            var segundo_apellido = $('#segundo_apellido').val().trim().toUpperCase();
            var fecha_nacimiento = $('#fecha_nacimiento').val();

            // Verificar que todos los campos necesarios estén llenos
            if (primer_nombre && primer_apellido && fecha_nacimiento) {
                // Extraer datos de la fecha de nacimiento
                var partes_fecha = fecha_nacimiento.split('-');
                var año = partes_fecha[0].slice(-2); // Últimos dos dígitos del año
                var mes = partes_fecha[1];
                var dia = partes_fecha[2];

                // Construir el IFE utilizando las primeras letras y la fecha
                var ife = primer_apellido.charAt(0); // Primera letra del primer apellido
                ife += (primer_nombre.charAt(0) || 'X'); // Primera letra del primer nombre
                ife += año + mes + dia; // Fecha de nacimiento (año, mes, día)

                // Asignar el IFE generado al campo correspondiente
                $('#IFE').val(ife);
                console.log(`IFE generado: ${ife}`);
            } else {
                // Si faltan campos, limpiar el IFE
                $('#IFE').val('');
                console.log('IFE deshabilitado y limpiado por falta de campos');
            }
        }

        // Validación del campo SMN (si está habilitado)
        function validarSMN() {
            var smn = $('#SMN').val().toUpperCase();
            var smnPattern = /^[A-Z0-9]{10,12}$/; // Patrón para validar el SMN

            if ($('#SMN').prop('disabled')) {
                return true; // Si está deshabilitado, no se valida
            }

            if (smnPattern.test(smn)) {
                console.log('SMN válido: ' + smn);
                return true;
            } else {
                alert('El SMN debe tener entre 10 y 12 caracteres alfanuméricos.');
                return false;
            }
        }

        // Función para manejar la habilitación/deshabilitación del campo SMN
        function manejarSMN() {
            var sexo = $('#sexo').val();
            if (sexo === 'H') { // Masculino
                $('#SMN').prop('disabled', false).attr('required', true);
                console.log('SMN habilitado y requerido por sexo masculino');
            } else if (sexo === 'M') { // Femenino
                $('#SMN').val('').prop('disabled', true).removeAttr('required');
                console.log('SMN deshabilitado y seteado como null por sexo femenino');
            } else {
                $('#SMN').val('').prop('disabled', true).removeAttr('required');
                console.log('SMN deshabilitado y limpiado por falta de selección de sexo');
            }
        }
        $('#sexo').on('change', function() {
            manejarSMN(); // Habilitar o deshabilitar el campo SMN basado en el sexo seleccionado
        });

        function actualizarContador(id, maxLength) {
            var input = document.getElementById(id);
            var contador = document.getElementById(id + '_counter');
            var length = input.value.length;
            contador.textContent = length + '/' + maxLength + ' caracteres';
        }

        // Asignar eventos para contar los caracteres al cambiar el valor en CURP_faltante, RFC_faltante, IFE y SMN
        $('#CURP_faltante').on('input', function() {
            actualizarContador('CURP_faltante', 2);
        });

        $('#RFC_faltante').on('input', function() {
            actualizarContador('RFC_faltante', 2);
        });

        $('#IFE').on('input', function() {
            actualizarContador('IFE', 13);
        });

        $('#SMN').on('input', function() {
            actualizarContador('SMN', 12);
        });

        // Inicialización de los contadores cuando se carga la página
        actualizarContador('CURP_faltante', 2);
        actualizarContador('RFC_faltante', 2);
        actualizarContador('IFE', 13);
        actualizarContador('SMN', 12);
        // Función para calcular la edad
        function calcularEdad(fecha_nacimiento) {
            var hoy = new Date();
            var partes_fecha = fecha_nacimiento.split('-');
            var año = parseInt(partes_fecha[0], 10);
            var mes = parseInt(partes_fecha[1], 10) - 1; // Mes en JS va de 0 a 11
            var dia = parseInt(partes_fecha[2], 10);
            var fecha = new Date(año, mes, dia);
            var edad = hoy.getFullYear() - fecha.getFullYear();
            var m = hoy.getMonth() - fecha.getMonth();
            if (m < 0 || (m === 0 && hoy.getDate() < fecha.getDate())) {
                edad--;
            }
            return edad;
        }

        // Validación antes de enviar el formulario
        $('#evaluado-form').on('submit', function(e) {
            var sexo = $('#sexo').val();
            var curp_faltante = $('#CURP_faltante').val();
            var fecha_nacimiento = $('#fecha_nacimiento').val();

            // Validación de CURP Faltante para masculino
            if (sexo === 'H') {
                if (!curp_faltante || !/^\d{2}$/.test(curp_faltante)) {
                    e.preventDefault();
                    alert('Por favor, ingrese los últimos 2 dígitos numéricos de la CURP.');
                    return;
                }
            }

            // Validación de Edad
            if (fecha_nacimiento) {
                var edad = calcularEdad(fecha_nacimiento);
                if (edad < 18) {
                    e.preventDefault();
                    alert('El evaluado debe ser mayor de edad (18 años o más).');
                    return;
                }
            }

            // Validar IFE y SMN
            if (!validarIFE() || !validarSMN()) {
                e.preventDefault(); // Evita el envío si IFE o SMN no son válidos
                return;
            }
        });

        // Asignar eventos para generar la CURP cuando se llenen los campos requeridos
        $('[data-required-for-curp]').on('input change', function() {
            generarCURP();
        });

        // Asignar evento para manejar el campo SMN cuando cambia el sexo
        $('#sexo').on('change', function() {
            manejarSMN();
            generarCURP(); // Generar la CURP en caso de que el sexo afecte la CURP
        });

        // Asignar evento para actualizar la CURP Completa cuando cambia CURP_faltante
        $('#CURP_faltante').on('input change', function() {
            generarCURP();
        });

        // Asignar eventos para generar el RFC cuando se llenen los campos requeridos
        $('[data-required-for-curp], #RFC_faltante').on('input change', function() {
            generarRFC();
        });

        // Asignar eventos para generar el IFE automáticamente cuando se completen los datos
        $('[data-required-for-curp]').on('input change', function() {
            generarIFE();
        });

        // Generar el IFE al cargar la página si ya hay datos
        generarIFE();

        // Inicializar el estado del campo SMN y CURP al cargar la página
        manejarSMN();
        generarCURP();
    });

</script>
@endsection
