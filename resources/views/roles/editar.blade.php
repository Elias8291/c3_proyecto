@extends('layouts.app')

@section('title', 'Editar Rol')

@section('css')
<!-- Agrega los mismos estilos del formulario de crear rol -->
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
            linear-gradient(45deg, rgba(0, 48, 73, 0.03) 25%, transparent 25%, transparent 75%, rgba(0, 48, 73, 0.03) 75%),
            linear-gradient(-45deg, rgba(0, 48, 73, 0.03) 25%, transparent 25%, transparent 75%, rgba(0, 48, 73, 0.03) 75%),
            radial-gradient(circle at 50% 50%, rgba(0, 48, 73, 0.02) 0%, rgba(0, 48, 73, 0.02) 50%, transparent 50.1%);
        background-size: 60px 60px, 60px 60px, 120px 120px;
        background-position: 0 0, 30px 30px, 0 0;
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
            radial-gradient(circle at 15% 15%, rgba(0, 48, 73, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 85% 85%, rgba(0, 48, 73, 0.08) 0%, transparent 50%);
        pointer-events: none;
        z-index: -1;
    }

    .form-label {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 10px;
        font-size: 17px !important;
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
                <a href="{{ route('roles.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
            <div class="text-center mb-4">
                <h3 class="card-title">Editar Rol</h3>
            </div>

            <!-- Formulario -->
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <!-- Nombre del Rol -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="name">Nombre del Rol</label>
                        <input name="name" value="{{ old('name', $role->name) }}"
                            class="form-control @error('name') form-error @enderror" type="text" required>
                        @error('name')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción del Rol -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="description">Descripción del Rol</label>
                        <textarea name="description" class="form-control @error('description') form-error @enderror"
                            rows="4" required>{{ old('description', $role->description) }}</textarea>
                        @error('description')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Permisos para este Rol -->
                    <div class="form-group mb-4" style="flex: 2;">
                        <label class="form-label">Permisos para este Rol</label>
                        <div class="form-control" style="height: auto; padding: 10px;">
                            @foreach($permission as $permiso)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permission[]"
                                    value="{{ $permiso->id }}" id="permiso_{{ $permiso->id }}" {{ in_array($permiso->id,
                                $rolePermissions) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permiso_{{ $permiso->id }}">
                                    {{ $permiso->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @error('permission')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Estado del Rol -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="status">Estado del Rol</label>
                        <select name="status" class="form-control @error('status') form-error @enderror" required>
                            <option value="activo" {{ old('status', $role->status) == 'activo' ? 'selected' : ''
                                }}>Activo</option>
                            <option value="inactivo" {{ old('status', $role->status) == 'inactivo' ? 'selected' : ''
                                }}>Inactivo</option>
                        </select>
                        @error('status')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botón de Guardar Cambios -->
                <button type="submit" class="btn-submit">Actualizar Rol</button>
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
    $(document).ready(function () {
        // Validaciones en tiempo real para Nombre del Rol y Descripción
        function validarTextoSoloLetras(input) {
            let valor = $(input).val();
            valor = valor.replace(/[^A-Za-zÀ-ÿ\s]/g, ''); // Permitir solo letras y espacios
            $(input).val(valor); // Asignar el valor filtrado al campo
            if (valor === '') {
                $(input).addClass('form-error');
            } else {
                $(input).removeClass('form-error');
            }
        }

        // Validar el campo de descripción
        function validarDescripcion(input) {
            let valor = $(input).val();
            if (valor === '' || valor.length > 255) {
                $(input).addClass('form-error');
            } else {
                $(input).removeClass('form-error');
            }
        }

        // Validar los permisos
        function validarPermisos() {
            if ($('input[name="permission[]"]:checked').length == 0) {
                $('.form-control').addClass('form-error');
                return false;
            } else {
                $('.form-control').removeClass('form-error');
                return true;
            }
        }

        // Validar en tiempo real nombre y descripción
        $('input[name="name"]').on('input', function () {
            validarTextoSoloLetras(this);
        });

        $('textarea[name="description"]').on('input', function () {
            validarDescripcion(this);
        });

        // Validar permisos
        $('input[name="permission[]"]').on('change', function () {
            validarPermisos();
        });

        // Validar todos los campos al enviar
        $('form').on('submit', function (e) {
            let isValid = true;
            let camposConErrores = [];

            validarTextoSoloLetras($('input[name="name"]'));
            validarDescripcion($('textarea[name="description"]'));

            if ($('input[name="name"]').hasClass('form-error')) {
                isValid = false;
                camposConErrores.push('Nombre del Rol');
            }

            if ($('textarea[name="description"]').hasClass('form-error')) {
                isValid = false;
                camposConErrores.push('Descripción del Rol');
            }

            if (!validarPermisos()) {
                isValid = false;
                camposConErrores.push('Permisos');
            }

            if (!isValid) {
                e.preventDefault();
                alert('Por favor, corrige los siguientes campos: ' + camposConErrores.join(', '));
            }
        });

        @if ($errors->any())
        alert('Existen errores en el formulario. Por favor, revisa los campos marcados.');
        @endif
    });
</script>
@endsection