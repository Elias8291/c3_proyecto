@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('css')
<style>
    .container {
        max-width: 900px;
        margin: -80px auto;
        /* Margen superior negativo */
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
        animation: slideIn 0.8s ease-out;
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

    .validation-tooltip {
        position: absolute;
        background: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        color: #991b1b;
        border: 1px solid #991b1b;
        display: none;
        width: max-content;
        max-width: 250px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 100;
        right: 0;
        top: 100%;
        margin-top: 5px;
    }

    .form-group {
        position: relative;
    }

    .password-requirements {
        display: none;
        position: absolute;
        background: white;
        padding: 12px;
        border-radius: 6px;
        font-size: 14px;
        border: 1px solid #e2e8f0;
        width: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 100;
        top: 100%;
        margin-top: 5px;
    }

    .requirement {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 4px;
        color: #64748b;
    }

    .requirement.valid {
        color: #22c55e;
    }

    .requirement i {
        font-size: 12px;
    }

    .password-requirements,
    .email-requirements {
        display: none;
        position: absolute;
        background: white;
        padding: 12px;
        border-radius: 6px;
        font-size: 14px;
        border: 1px solid #e2e8f0;
        width: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 100;
        top: 100%;
        margin-top: 5px;
    }

    .email-requirements {
        width: 250px;
        /* Puedes ajustar este valor según tus necesidades */
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

    /* Movimiento al cargar la página */
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
        animation: slideIn 0.8s ease-out;
        /* Añadimos la animación */
    }

    @keyframes slideIn {
        0% {
            transform: translateY(50px);
            /* Empieza 50px abajo */
            opacity: 0;
            /* Empieza transparente */
        }

        100% {
            transform: translateY(0);
            /* Llega a su posición original */
            opacity: 1;
            /* Opacidad completa */
        }
    }
</style>
@endsection

@section('content')
<main class="profile-page">
    <section class="page-background">
        <div class="container">
            <div class="text-left mb-4">
                <a href="javascript:history.back()" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
            <div class="text-center mb-4">
                <h3 class="card-title">Crear Nuevo Usuario</h3>
            </div>

            <!-- Formulario -->
            <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <!-- Nombre -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="name">Nombre</label>
                        <input name="name" value="{{ old('name') }}"
                            class="form-control @error('name') form-error @enderror" type="text" required>
                        @error('name')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Apellido Paterno -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="apellido_paterno">Apellido Paterno</label>
                        <input name="apellido_paterno" value="{{ old('apellido_paterno') }}"
                            class="form-control @error('apellido_paterno') form-error @enderror" type="text" required>
                        @error('apellido_paterno')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Apellido Materno -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="apellido_materno">Apellido Materno</label>
                        <input name="apellido_materno" value="{{ old('apellido_materno') }}"
                            class="form-control @error('apellido_materno') form-error @enderror" type="text">
                        @error('apellido_materno')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="telefono">Teléfono</label>
                        <input name="telefono" value="{{ old('telefono') }}"
                            class="form-control @error('telefono') form-error @enderror" type="text">
                        @error('telefono')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Email -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input name="email" type="email" value="{{ old('email') }}"
                            class="form-control @error('email') form-error @enderror" required>
                        @error('email')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="password">Contraseña</label>
                        <input name="password" type="password"
                            class="form-control @error('password') form-error @enderror" required>
                        @error('password')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Confirmar Contraseña -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                        <input name="password_confirmation" type="password" class="form-control" required>
                    </div>

                    <!-- Rol -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="rol">Rol</label>
                        <select name="rol" class="form-control" required>
                            <option value="">Seleccione un Rol</option>
                            @foreach($roles as $rol)
                            <option value="{{ $rol->name }}" {{ old('rol')==$rol->name ? 'selected' : '' }}>
                                {{ $rol->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Área -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="id_area">Área</label>
                        <select name="id_area" class="form-control @error('id_area') form-error @enderror" required>
                            <option value="">Seleccione un Área</option>
                            @foreach($areas as $area)
                            <option value="{{ $area->id }}" {{ old('id_area')==$area->id ? 'selected' : '' }}>
                                {{ $area->nombre_area }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_area')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Imagen de Perfil -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="image">Imagen de Perfil</label>
                        <input name="image" type="file" accept="image/*"
                            class="form-control @error('image') form-error @enderror">
                        @error('image')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botón de Guardar Cambios -->
                <button type="submit" class="btn-submit">Crear Usuario</button>
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
        // Validaciones en tiempo real
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

        // Validar el campo de teléfono
        function validarTelefono(input) {
            let valor = $(input).val();
            valor = valor.replace(/[^0-9]/g, ''); // Permitir solo números
            $(input).val(valor);
            if (valor.length !== 10) {
                $(input).addClass('form-error');
            } else {
                $(input).removeClass('form-error');
            }
        }

        // Validar en tiempo real nombre, apellidos y teléfono
        $('input[name="name"], input[name="apellido_paterno"], input[name="apellido_materno"]').on('input', function () {
            validarTextoSoloLetras(this);
        });
        $('input[name="telefono"]').on('input', function () {
            validarTelefono(this);
        });

        // Validar todos los campos al enviar
        $('form').on('submit', function (e) {
            let isValid = true;
            let camposConErrores = [];

            $('input[name="name"], input[name="apellido_paterno"], input[name="apellido_materno"]').each(function () {
                validarTextoSoloLetras(this);
                if ($(this).hasClass('form-error')) {
                    isValid = false;
                    camposConErrores.push($(this).prev('label').text());
                }
            });

            validarTelefono($('input[name="telefono"]'));
            if ($('input[name="telefono"]').hasClass('form-error')) {
                isValid = false;
                camposConErrores.push('Teléfono');
            }

            if (!isValid && camposConErrores.length > 0) {
                e.preventDefault();
                alert('Por favor, corrige los siguientes campos: ' + camposConErrores.join(', '));
            }
        });

        @if ($errors->any())
        alert('Existen errores en el formulario. Por favor, revisa los campos marcados.');
        @endif

        const passwordInput = $('input[name="password"]');
    const requirementsBox = $(`
        <div class="password-requirements">
            <div class="requirement length">
                <i class="fas fa-times-circle"></i>
                Mínimo 8 caracteres
            </div>
            <div class="requirement uppercase">
                <i class="fas fa-times-circle"></i>
                Al menos una mayúscula
            </div>
            <div class="requirement lowercase">
                <i class="fas fa-times-circle"></i>
                Al menos una minúscula
            </div>
            <div class="requirement number">
                <i class="fas fa-times-circle"></i>
                Al menos un número
            </div>
            <div class="requirement special">
                <i class="fas fa-times-circle"></i>
                Al menos un carácter especial
            </div>
        </div>
    `);
    
    passwordInput.parent().append(requirementsBox);

    passwordInput.on('focus', function() {
        requirementsBox.show();
    });

    passwordInput.on('blur', function() {
        requirementsBox.hide();
    });

    passwordInput.on('input', function() {
        const password = $(this).val();
        let isValid = true;

        // Validar longitud
        if (password.length >= 8) {
            requirementsBox.find('.length').addClass('valid').find('i').removeClass('fa-times-circle').addClass('fa-check-circle');
        } else {
            isValid = false;
            requirementsBox.find('.length').removeClass('valid').find('i').addClass('fa-times-circle').removeClass('fa-check-circle');
        }

        // Validar mayúscula
        if (/[A-Z]/.test(password)) {
            requirementsBox.find('.uppercase').addClass('valid').find('i').removeClass('fa-times-circle').addClass('fa-check-circle');
        } else {
            isValid = false;
            requirementsBox.find('.uppercase').removeClass('valid').find('i').addClass('fa-times-circle').removeClass('fa-check-circle');
        }

        // Validar minúscula
        if (/[a-z]/.test(password)) {
            requirementsBox.find('.lowercase').addClass('valid').find('i').removeClass('fa-times-circle').addClass('fa-check-circle');
        } else {
            isValid = false;
            requirementsBox.find('.lowercase').removeClass('valid').find('i').addClass('fa-times-circle').removeClass('fa-check-circle');
        }

        // Validar número
        if (/[0-9]/.test(password)) {
            requirementsBox.find('.number').addClass('valid').find('i').removeClass('fa-times-circle').addClass('fa-check-circle');
        } else {
            isValid = false;
            requirementsBox.find('.number').removeClass('valid').find('i').addClass('fa-times-circle').removeClass('fa-check-circle');
        }

        // Validar carácter especial
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            requirementsBox.find('.special').addClass('valid').find('i').removeClass('fa-times-circle').addClass('fa-check-circle');
        } else {
            isValid = false;
            requirementsBox.find('.special').removeClass('valid').find('i').addClass('fa-times-circle').removeClass('fa-check-circle');
        }

        if (!isValid && password.length > 0) {
            $(this).addClass('form-error');
        } else {
            $(this).removeClass('form-error');
        }
    });

  

   
    });
</script>
@endsection