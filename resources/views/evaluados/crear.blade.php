@extends('layouts.app')

@section('content')
<section class="section" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header d-flex align-items-center justify-content-between bg-maroon">
                        <a href="{{ url()->previous() }}" class="btn btn-back text-black">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                        <h3 class="page__heading text-center flex-grow-1 m-0">
                            <i class="fas fa-user-plus mr-2"></i> Crear Evaluado
                        </h3>
                        <!-- Espacio para mantener la alineación -->
                        <div style="width: 50px;"></div>
                    </div>
                    <div class="card-body p-4 bg-white">
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

                        <form action="{{ route('evaluados.store') }}" method="POST" class="my-4">
                            @csrf
                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-6">
                                    <!-- Campo Nombre -->
                                    <div class="form-group floating-label">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre"
                                            class="form-control @error('nombre') is-invalid @enderror" id="nombre" required
                                            value="{{ old('nombre') }}">
                                        <small class="form-text text-muted">Formato: Solo letras y espacios</small>
                                        @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Campo Apellido Paterno -->
                                    <div class="form-group floating-label">
                                        <label for="AP">Apellido Paterno (AP)</label>
                                        <input type="text" name="AP" class="form-control @error('AP') is-invalid @enderror"
                                            id="AP" required value="{{ old('AP') }}">
                                        <small class="form-text text-muted">Formato: Solo letras</small>
                                        @error('AP')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Campo CURP -->
                                    <div class="form-group floating-label">
                                        <label for="CURP">CURP (Clave Única de Registro de Población)</label>
                                        <input type="text" name="CURP" class="form-control @error('CURP') is-invalid @enderror"
                                            id="CURP" pattern="[A-Z0-9]{18}"
                                            title="La CURP debe tener 18 caracteres alfanuméricos" required
                                            value="{{ old('CURP') }}">
                                        <small class="form-text text-muted">Formato: 18 caracteres alfanuméricos</small>
                                        @error('CURP')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Campo CUIP -->
                                    <div class="form-group floating-label">
                                        <label for="CUIP">CUIP (Clave Única de Identificación Policial)</label>
                                        <input type="text" name="CUIP" class="form-control @error('CUIP') is-invalid @enderror"
                                            id="CUIP" value="{{ old('CUIP') }}">
                                        <small class="form-text text-muted">Formato: 10 caracteres alfanuméricos</small>
                                        @error('CUIP')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Campo SMN -->
                                    <div class="form-group floating-label">
                                        <label for="SMN">SMN (Salario Mínimo Nacional)</label>
                                        <input type="number" name="SMN" class="form-control @error('SMN') is-invalid @enderror"
                                            id="SMN" min="0" step="0.01" required value="{{ old('SMN') }}">
                                        <small class="form-text text-muted">Formato: Número decimal</small>
                                        @error('SMN')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                    <!-- Campo Apellido Materno -->
                                    <div class="form-group floating-label">
                                        <label for="AM">Apellido Materno (AM)</label>
                                        <input type="text" name="AM" class="form-control @error('AM') is-invalid @enderror"
                                            id="AM" value="{{ old('AM') }}">
                                        <small class="form-text text-muted">Formato: Solo letras</small>
                                        @error('AM')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Campo RFC -->
                                    <div class="form-group floating-label">
                                        <label for="RFC">RFC (Registro Federal de Contribuyentes)</label>
                                        <input type="text" name="RFC" class="form-control @error('RFC') is-invalid @enderror"
                                            id="RFC" pattern="[A-Z0-9]{12,13}"
                                            title="El RFC debe tener entre 12 y 13 caracteres alfanuméricos" required
                                            value="{{ old('RFC') }}">
                                        <small class="form-text text-muted">Formato: Entre 12 y 13 caracteres alfanuméricos</small>
                                        @error('RFC')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Campo IFE -->
                                    <div class="form-group floating-label">
                                        <label for="IFE">IFE (Instituto Federal Electoral)</label>
                                        <input type="text" name="IFE" class="form-control @error('IFE') is-invalid @enderror"
                                            id="IFE" value="{{ old('IFE') }}">
                                        <small class="form-text text-muted">Formato: Debe cumplir con el estándar</small>
                                        @error('IFE')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Campo Fecha de Apertura -->
                                    <div class="form-group floating-label">
                                        <label for="fecha_apertura">Fecha de Apertura</label>
                                        <input type="date" name="fecha_apertura"
                                            class="form-control @error('fecha_apertura') is-invalid @enderror" required
                                            value="{{ old('fecha_apertura') }}">
                                        @error('fecha_apertura')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Campo Sexo -->
                                    <div class="form-group floating-label">
                                        <label for="sexo">Sexo</label>
                                        <select name="sexo" class="form-control @error('sexo') is-invalid @enderror select2"
                                            required>
                                            <option value="" disabled selected>Seleccione el sexo</option>
                                            <option value="M" {{ old('sexo')=='M' ? 'selected' : '' }}>Masculino
                                            </option>
                                            <option value="F" {{ old('sexo')=='F' ? 'selected' : '' }}>Femenino</option>
                                        </select>
                                        @error('sexo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Botón de Envío -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block btn-submit">Guardar</button>
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
        $('.select2').select2();

        $('input, select').focus(function() {
            $(this).parent().addClass('active');
        }).blur(function() {
            if ($(this).val() === '') {
                $(this).parent().removeClass('active');
            }
        });

        // Validación en tiempo real para "CURP" y "RFC"
        $('#CURP').on('input', function(event) {
            var regex = /[^A-Z0-9]/g;
            var newValue = $(this).val().replace(regex, '').toUpperCase();
            if (newValue.length > 18) {
                newValue = newValue.substring(0, 18);
            }
            $(this).val(newValue);
        });

        $('#RFC').on('input', function(event) {
            var regex = /[^A-Z0-9]/g;
            var newValue = $(this).val().replace(regex, '').toUpperCase();
            if (newValue.length > 13) {
                newValue = newValue.substring(0, 13);
            }
            $(this).val(newValue);
        });
    });
</script>
@endsection

@section('styles')
<style>
    .floating-label {
        position: relative;
        margin-bottom: 20px;
    }

    .floating-label label {
        position: absolute;
        top: 12px;
        left: 12px;
        pointer-events: none;
        transition: all 0.2s ease;
        color: #999;
        background-color: #ffffff;
        padding: 0 5px;
    }

    .floating-label input:focus~label,
    .floating-label input:not(:placeholder-shown)~label,
    .floating-label select:focus~label,
    .floating-label select:not([value=""])~label {
        top: -10px;
        left: 8px;
        font-size: 12px;
        color: #333;
    }

    .form-text.text-muted {
        margin-top: 5px;
        font-size: 12px;
        color: #6c757d;
    }

    .btn-submit {
        transition: all 0.3s ease;
        background-color: #fc8600;
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
        background-color: #ff5722;
    }

    .btn-submit:focus {
        outline: none;
        box-shadow: 0 0 10px rgba(255, 87, 34, 0.5);
    }

    .section {
        padding: 60px 0;
        background-color: #f8e1e1;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .custom-container {
        max-width: 900px;
        margin: auto;
        border: 3px solid #06740f;
        border-radius: 15px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .custom-container:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
    }

    .bg-maroon {
        background-color: #800000;
    }

    .card-header {
        padding: 20px;
        background-color: #804d00;
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
        background-color: rgba(255, 255, 255, 0.1);
        transition: background-color 0.2s ease, color 0.2s ease;
        color: #ffffff;
    }

    .card-header .btn-back:hover {
        background-color: #fff;
        color: #f10a0a;
    }

    .card-header .btn-back:hover .fa-arrow-left {
        color: #ff2929;
    }

    .card-header .page__heading {
        color: #ffffff;
    }

    .card-body {
        padding: 30px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .alert {
        margin-bottom: 20px;
    }

    .select2-container .select2-selection--single {
        height: 45px;
        border-radius: 8px;
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
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
        border: 1px solid #ccc;
    }

    .select2-results__option {
        padding: 8px 10px;
    }

    .select2-results__option--highlighted {
        background-color: #574d4d;
        color: #fff;
    }

    /* Ajustes Responsivos */
    @media (max-width: 768px) {
        .custom-container {
            padding: 15px;
        }

        .card-header .page__heading {
            font-size: 18px;
        }

        .btn-submit {
            font-size: 16px;
            padding: 10px 18px;
        }
    }
</style>
@endsection
