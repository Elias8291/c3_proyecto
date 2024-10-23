@extends('layouts.app')

@section('content')
<section class="section" style="background-color: #f5f5f5; min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center" style="background: #086dd1">
                        <a href=" /inscripciones " class="btn btn-back text-white">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                        @if(isset($grupo))
                        <h3 class="page__heading m-0 text-center flex-grow-1">
                            <i class="fas fa-book mr-2"></i> Crear Inscripción
                            <br>
                            <span class="d-block mt-2" style="font-size: 0.8em;">{{ $grupo->materia->nombre }} ({{ $grupo->clave }})</span>
                        </h3>
                        @else
                        <h3 class="page__heading m-0 text-center flex-grow-1">
                            <i class="fas fa-book mr-2"></i> Crear Inscripción
                        </h3>
                        @endif
                    </div>
                    <div class="card-body p-4">
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

                        <form id="registerForm" action="{{ route('inscripciones.store') }}" method="POST" class="form-floating-labels">
                            @if(isset($grupo))
                            <div class="mb-4">
                                <p><strong>Horario:</strong> {{ $grupo->horario->hora_in }} a {{ $grupo->horario->hora_fn }}</p>
                                <p><strong>Rango de Alumnos:</strong> {{ $grupo->rangoAlumno->min_alumnos }} - {{ $grupo->rangoAlumno->max_alumnos }}</p>
                                <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                            </div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="control_number_search">Buscar por Número de Control:</label>
                                <input type="text" class="form-control" id="control_number_search" placeholder="Ingrese el número de control" oninput="filterStudents()" maxlength="8">
                            </div>

                            <div class="form-group">
                                <label for="estudiante_id">Estudiante:</label>
                                <select class="form-control select2 @error('estudiante_id') is-invalid @enderror" name="estudiante_id" id="estudiante_id" required>
                                    <option value="">Seleccione un estudiante</option>
                                    @foreach ($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}" data-control-number="{{ $estudiante->numeroDeControl }}" {{ old('estudiante_id') == $estudiante->id ? 'selected' : '' }}>
                                        {{ $estudiante->numeroDeControl }} - {{ $estudiante->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('estudiante_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-block btn-submit">Crear Inscripción</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 mt-4 mt-md-0">
                <div class="card shadow border-0">
                    <div class="card-body p-4">
                        <h5 class="m-0 bg-warning text-white p-3">Grupos Activos del Estudiante</h5>
                        <div class="container">
                            <table class="table table-bordered" id="grupos-estudiante-table">
                                <thead>
                                    <tr>
                                        <th>Clave</th>
                                        <th>Nombre del Grupo</th>
                                        <th>Materia</th>
                                        <th>Horario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Grupos del estudiante se cargarán aquí -->
                                </tbody>
                            </table>
                        </div>
                        <h5 class="m-0 bg-danger text-white p-3">Grupos Inactivos del Estudiante</h5>
                        <div class="container">
                            <table class="table table-bordered" id="grupos-estudiante-inactivos-table">
                                <thead>
                                    <tr>
                                        <th>Clave</th>
                                        <th>Nombre del Grupo</th>
                                        <th>Materia</th>
                                        <th>Horario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Grupos inactivos del estudiante se cargarán aquí -->
                                </tbody>
                            </table>
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
    $(document).ready(function() {
        $('.select2').select2();

        $('#estudiante_id').on('change', function() {
            const estudianteId = $(this).val();
            if (estudianteId) {
                fetchGruposEstudiante(estudianteId);
            } else {
                $('#grupos-estudiante-table tbody').html('');
                $('#grupos-estudiante-card').hide();
            }
        });
    });

    document.getElementById('registerForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        fetch('{{ route('inscripciones.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                // Aquí más cabeceras si es necesario
            }
        }).then(response => {
            if (response.ok) {
                exito();
                // Si el registro es exitoso, puedes redirigir al usuario o mostrar un mensaje de éxito
                window.location.reload(); // Esto recargará la página
            } else {
                response.json().then(data => {
                    if (data.errors) {
                        var errorMessage = '';
                        for (const [key, value] of Object.entries(data.errors)) {
                            errorMessage += value + '\n';
                        }
                        showRegisterErrorModal(errorMessage.trim()); // Mostrar los mensajes de error
                    } else {
                        showRegisterErrorModal(data.message); // Mostrar el mensaje de error devuelto por el servidor
                    }
                });
            }
        }).catch(error => {
            console.error('Error al registrar:', error);
            showRegisterErrorModal('Hubo un error al intentar registrarte. Por favor, intenta de nuevo más tarde.'); // Mensaje genérico en caso de error de conexión
        });
    });

    function exito() {
        Swal.fire({
            title: "Alumno Registrado!",
            text: "El Alumno ha sido registrado!",
            icon: "success",
            timer: 5000, // Duración de la alerta en milisegundos
            showConfirmButton: false
        });
    }

    function showRegisterErrorModal(message) {
        Swal.fire({
            title: "Error al Registrar",
            text: message,
            icon: "error",
            timer: 5000, // Duración de la alerta en milisegundos
            showConfirmButton: false
        });
    }

    function filterStudents() {
        const searchValue = document.getElementById('control_number_search').value.toLowerCase();
        const studentSelect = document.getElementById('estudiante_id');
        const options = studentSelect.options;

        for (let i = 0; i < options.length; i++) {
            const option = options[i];
            const controlNumber = option.getAttribute('data-control-number').toLowerCase();
            if (controlNumber.includes(searchValue)) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        }

        $(studentSelect).select2();
    }

    $('#control_number_search').on('input', function() {
        const searchValue = this.value;
        if (searchValue.length === 8) {
            const studentSelect = document.getElementById('estudiante_id');
            const options = studentSelect.options;
            let selectedOption = null;

            for (let i = 0; i < options.length; i++) {
                const option = options[i];
                const controlNumber = option.getAttribute('data-control-number');
                if (controlNumber === searchValue) {
                    selectedOption = option;
                    break;
                }
            }

            if (selectedOption) {
                selectedOption.selected = true;
                $(studentSelect).val(selectedOption.value).trigger('change');
            }
        } else {
            $('#estudiante_id').val(null).trigger('change');
            $('#grupos-estudiante-table tbody').html('');
            $('#grupos-estudiante-card').hide();
        }
    });
    
    function fetchGruposEstudiante(estudianteId) {
    $.get(`/inscripciones/grupos/${estudianteId}`, function(data) {
        let gruposActivosHtml = '';
        let gruposInactivosHtml = '';

        data.forEach(grupo => {
            const horarioGrupo = grupo.hora_in + ' - ' + grupo.hora_fn;
            const isOverlap = horarioGrupo === @json(isset($grupo) ? $grupo->horario->hora_in . ' - ' . $grupo->horario->hora_fn : null);

            if (grupo.grupo_activo === 'Activo') {
                gruposActivosHtml += `<tr>
                    <td>${grupo.clave}</td>
                    <td>${grupo.grupo_nombre}</td>
                    <td>${grupo.materia_nombre}</td>
                    <td ${isOverlap ? 'style="background-color: #f8d7da;"' : ''}>${grupo.hora_in} - ${grupo.hora_fn}</td>
                </tr>`;
            } else {
                gruposInactivosHtml += `<tr>
                    <td>${grupo.clave}</td>
                    <td>${grupo.grupo_nombre}</td>
                    <td>${grupo.materia_nombre}</td>
                    <td ${isOverlap ? 'style="background-color: ;"' : ''}>${grupo.hora_in} - ${grupo.hora_fn}</td>
                </tr>`;
            }
        });

        $('#grupos-estudiante-table tbody').html(gruposActivosHtml);
        $('#grupos-estudiante-inactivos-table tbody').html(gruposInactivosHtml);

        if (gruposActivosHtml) {
            $('#grupos-estudiante-card').show();
        } else {
            $('#grupos-estudiante-card').hide();
        }

        if (gruposInactivosHtml) {
            $('#grupos-estudiante-inactivos-card').show();
        } else {
            $('#grupos-estudiante-inactivos-card').hide();
        }
    });
}

</script>
@endsection

@section('styles')
<style>
    .bg-primary {
        background-color: #343a40 !important;
    }

    .form-label {
        font-weight: bold;
        color: #343a40;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .form-control {
        padding: 12px 15px;
        border: 1px solid #ced4da;
        border-radius: 8px;
        width: 100%;
        box-sizing: border-box;
        transition: all 0.2s ease;
        font-size: 16px;
        background-color: #f8f9fa;
    }

    .form-control:focus {
        border-color: #343a40;
        box-shadow: 0 0 8px rgba(29, 139, 248, 0.3);
        background-color: #fff;
    }

    .input-group-text {
        cursor: pointer;
    }

    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }

    .card-header {
        padding: 20px;
        background-color: #086dd1;
        border-bottom: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-header .btn-back {
        display: flex;
        align-items: center;
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 8px;
        background-color: rgba(22, 91, 180, 0.1);
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .card-header .btn-back:hover {
        background-color: #fff;
        color: #343a40;
    }

    .card-header .btn-back:hover .fa-arrow-left {
        color: #343a40;
    }

    .card-header .page__heading {
        color: #ffffff;
    }

    .card-body {
        padding: 30px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .alert {
        margin-bottom: 20px;
    }

    .btn-submit {
        transition: all 0.3s ease;
        background-color: #086dd1;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        background-color: #065ba1;
    }

    .btn-submit:focus {
        outline: none;
        box-shadow: 0 0 10px rgba(52, 58, 64, 0.3);
    }

    .card-body p {
        margin: 0;
        padding: 0;
    }

    .section {
        padding: 60px 0;
        background-color: #f5f5f5;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .container {
        max-width: 900px;
        margin: auto;
        border: 3px solid #343a40;
        border-radius: 10px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .container:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }
    }

    .select2-container .select2-selection--single {
        height: 45px;
        border-radius: 8px;
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ced4da;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 45px;
        padding-left: 10px;
        color: #333;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 45px;
    }

    .select2-dropdown {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #ced4da;
    }

    .select2-results__option {
        padding: 8px 10px;
    }

    .select2-results__option--highlighted {
        background-color: #343a40;
        color: #fff;
    }
</style>
@endsection
