@extends('layouts.app')

@section('content')
<section class="section" style="min-height: 100vh; display: flex; align-items: center; background-color: #f8f9fa;">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 rounded-lg bg-white">
                    <!-- Cabecera de la Tarjeta -->
                    <div class="card-header d-flex align-items-center justify-content-between bg-maroon text-white">
                        <a href="{{ url()->previous() }}" class="btn btn-back text-white">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                        <h3 class="page__heading text-center flex-grow-1 m-0 text-white">
                            <i class="fas fa-user-plus mr-2"></i> Crear Evaluado
                        </h3>
                        <div style="width: 50px;"></div>
                    </div>

                    <!-- Cuerpo de la Tarjeta -->
                    <div class="card-body p-5 bg-light">
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
                                    <div class="card border-0 shadow-sm bg-white rounded-lg">
                                        <div class="card-body p-4">
                                            <h5 class="card-title text-maroon mb-3">
                                                <i class="fas fa-user mr-2"></i> Información Personal
                                            </h5>

                                            <!-- Primer Nombre -->
                                            <div class="form-group">
                                                <label for="primer_nombre" class="form-label">Primer Nombre</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-maroon text-white">
                                                        <i class="fas fa-font"></i>
                                                    </span>
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
                                                    <span class="input-group-text bg-maroon text-white">
                                                        <i class="fas fa-font"></i>
                                                    </span>
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
                                                    <span class="input-group-text bg-maroon text-white">
                                                        <i class="fas fa-user"></i>
                                                    </span>
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
                                                    <span class="input-group-text bg-maroon text-white">
                                                        <i class="fas fa-user"></i>
                                                    </span>
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
                                                    <!-- Opciones de estado aquí... -->
                                                </select>
                                                @error('estado_nacimiento')
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
                                    <div class="card border-0 shadow-sm bg-white rounded-lg">
                                        <div class="card-body p-4">
                                            <h5 class="card-title text-maroon mb-3">
                                                <i class="fas fa-id-card mr-2"></i> Identificación
                                            </h5>

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

                                            <!-- Resultado de Evaluación -->
                                            <div class="form-group">
                                                <label for="resultado_evaluacion" class="form-label">Resultado de Evaluación</label>
                                                <select name="resultado_evaluacion" class="form-control @error('resultado_evaluacion') is-invalid @enderror" id="resultado_evaluacion" required>
                                                    <option value="" disabled selected>Seleccione el resultado</option>
                                                    <option value="1" {{ old('resultado_evaluacion')=='1' ? 'selected' : '' }}>Aprobado</option>
                                                    <option value="0" {{ old('resultado_evaluacion')=='0' ? 'selected' : '' }}>No Aprobado</option>
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
                                <button type="submit" class="btn btn-maroon btn-lg btn-block shadow">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
