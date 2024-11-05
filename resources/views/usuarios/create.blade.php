@extends('layouts.app')

@section('content')
<style>
    .side-menu {
        padding: 0;
        margin: 0;
    }

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

    input[type="text"],
    input[type="date"],
    select,
    textarea {
        font-size: 17px !important;
    }

    .password-requirements {
        margin-top: 10px;
        padding: 15px;
        border-radius: 8px;
        background-color: #f8f9fa;
        border: 1px solid #e2e8f0;
    }

    .requirement-item {
        display: flex;
        align-items: center;
        margin: 8px 0;
        font-size: 14px;
        color: #64748b;
        transition: all 0.3s ease;
    }

    .requirement-item i {
        margin-right: 8px;
        font-size: 16px;
    }

    .requirement-item.valid {
        color: #22c55e;
    }

    .requirement-item.invalid {
        color: #64748b;
    }

    .requirement-icon {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .requirement-icon.valid {
        background-color: #22c55e;
        color: white;
    }

    .requirement-icon.invalid {
        background-color: #e2e8f0;
        color: #64748b;
    }

    .password-strength {
        margin-top: 10px;
        height: 4px;
        background-color: #e2e8f0;
        border-radius: 2px;
        overflow: hidden;
    }

    .password-strength-bar {
        height: 100%;
        width: 0;
        transition: width 0.3s ease, background-color 0.3s ease;
    }

    .strength-text {
        font-size: 14px;
        margin-top: 5px;
        text-align: right;
    }

    .password-wrapper {
        position: relative;
        width: 100%;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        padding: 4px;
        cursor: pointer;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease;
    }

    .password-toggle:hover {
        color: #800020;
    }

    .password-toggle:focus {
        outline: none;
        color: #800020;
    }

    .form-control.with-toggle {
        padding-right: 40px;
    }

    /* Estilo para el ícono cuando la contraseña es visible */
    .password-toggle.visible {
        color: #800020;
    }

    /* Estilo hover para el contenedor de la contraseña */
    .password-wrapper:hover .password-toggle {
        opacity: 1;
    }

    .password-requirements {
        margin-top: 10px;
        padding: 15px;
        border-radius: 8px;
        background-color: #f8f9fa;
        border: 1px solid #e2e8f0;
    }

    .requirement-item {
        display: flex;
        align-items: center;
        margin: 8px 0;
        font-size: 14px;
        color: #64748b;
        transition: all 0.3s ease;
    }

    .requirement-item i {
        margin-right: 8px;
        font-size: 16px;
    }

    .requirement-item.valid {
        color: #22c55e;
    }

    .requirement-item.invalid {
        color: #64748b;
    }

    .requirement-icon {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .requirement-icon.valid {
        background-color: #22c55e;
        color: white;
    }

    .requirement-icon.invalid {
        background-color: #e2e8f0;
        color: #64748b;
    }

    .password-strength {
        margin-top: 10px;
        height: 4px;
        background-color: #e2e8f0;
        border-radius: 2px;
        overflow: hidden;
    }

    .password-strength-bar {
        height: 100%;
        width: 0;
        transition: width 0.3s ease, background-color 0.3s ease;
    }

    .strength-text {
        font-size: 14px;
        margin-top: 5px;
        text-align: right;
    }
    
</style>
<div class="container">
    <h2>Crear Usuario</h2>

    <!-- Mostrar mensajes de éxito o error -->
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
        <p class="mt-3"><span class="text-danger">*</span> Campos obligatorios</p>
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="name">Nombre <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            

            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno <span class="text-danger">*</span></label>
                <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" value="{{ old('apellido_paterno') }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" value="{{ old('apellido_materno') }}">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
                <!-- Contenedor para los requisitos del teléfono, inicialmente oculto -->
                <div class="phone-requirements" style="display: none;">
                    <div class="requirement-item" data-requirement="length">
                        <span class="requirement-icon">•</span>
                        Exactamente 10 dígitos
                    </div>
                    <div class="requirement-item" data-requirement="digits">
                        <span class="requirement-icon">•</span>
                        Solo números
                    </div>
                </div>
            </div>
            
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Correo Electrónico <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                <!-- Contenedor para los requisitos del correo, inicialmente oculto -->
                <div class="email-requirements" style="display: none;">
                    <div class="requirement-item" data-requirement="format">
                        <span class="requirement-icon">•</span>
                        Formato válido (por ejemplo: usuario@dominio.com)
                    </div>
                    <div class="requirement-item" data-requirement="domain">
                        <span class="requirement-icon">•</span>
                        Dominio válido (com, org, net, etc.)
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="id_area">Área <span class="text-danger">*</span></label>
                <select name="id_area" class="form-control @error('id_area') form-error @enderror" required>
                    <option value="">Seleccione un Área</option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ old('id_area')==$area->id ? 'selected' : '' }}>{{
                        $area->nombre_area }}</option>
                    @endforeach
                </select>
                @error('id_area')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="rol">Rol <span class="text-danger">*</span></label>
                <select name="rol" class="form-control" required>
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                    <option value="{{ $rol->name }}" {{ old('rol')==$rol->name ? 'selected' : '' }}>{{ $rol->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="password">Contraseña <span class="text-danger">*</span></label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password" class="form-control with-toggle" required>
                    <button type="button" class="password-toggle" data-target="password"
                        title="Mostrar/Ocultar contraseña">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="eye-icon-show" viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="eye-icon-hide" viewBox="0 0 16 16" style="display: none;">
                            <path
                                d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" />
                            <path
                                d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z" />
                            <path
                                d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z" />
                        </svg>
                    </button>
                </div>
                <!-- Contenedor para los requisitos de la contraseña -->
                <div class="password-requirements" style="display: none;">
                    <div class="requirement-item" data-requirement="length">
                        <span class="requirement-icon">✓</span>
                        Mínimo 8 caracteres
                    </div>
                    <div class="requirement-item" data-requirement="lowercase">
                        <span class="requirement-icon">✓</span>
                        Una letra minúscula
                    </div>
                    <div class="requirement-item" data-requirement="uppercase">
                        <span class="requirement-icon">✓</span>
                        Una letra mayúscula
                    </div>
                    <div class="requirement-item" data-requirement="number">
                        <span class="requirement-icon">✓</span>
                        Un número
                    </div>
                    <div class="requirement-item" data-requirement="special">
                        <span class="requirement-icon">✓</span>
                        Un carácter especial
                    </div>

                    <!-- Barra de fortaleza de la contraseña -->
                    <div class="password-strength">
                        <div class="password-strength-bar"></div>
                    </div>
                    <div class="strength-text">Fortaleza de la contraseña: <span id="strength-value">Débil</span></div>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña <span class="text-danger">*</span></label>
                <div class="password-wrapper">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control with-toggle" required>
                    <button type="button" class="password-toggle" data-target="password_confirmation"
                        title="Mostrar/Ocultar contraseña">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="eye-icon-show" viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="eye-icon-hide" viewBox="0 0 16 16" style="display: none;">
                            <path
                                d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" />
                            <path
                                d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z" />
                            <path
                                d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z" />
                        </svg>
                    </button>
                </div>
                <div id="password-match-message" class="mt-2" style="display: none;"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="image">Imagen de Perfil</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-submit">Crear Usuario</button>
    </form>


</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('telefono');
    const requirementsBox = document.querySelector('.password-requirements');
    const emailRequirementsBox = document.querySelector('.email-requirements');
    const phoneRequirementsBox = document.querySelector('.phone-requirements');
    const strengthBar = document.querySelector('.password-strength-bar');
    const strengthText = document.getElementById('strength-value');
    const matchMessage = document.getElementById('password-match-message');
    const nameInput = document.getElementById('name');
    const apellidoPaternoInput = document.getElementById('apellido_paterno');
    const apellidoMaternoInput = document.getElementById('apellido_materno');

    function restrictToLettersOnly(input) {
        input.addEventListener('input', function() {
            // Elimina cualquier carácter que no sea una letra o contiene espacios
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ]+/g, '');
        });
    }

    restrictToLettersOnly(nameInput);
    restrictToLettersOnly(apellidoPaternoInput);
    restrictToLettersOnly(apellidoMaternoInput);
    const phoneRequirements = {
        length: str => str.length === 10,
        digits: str => /^\d+$/.test(str)
    };

    const emailRequirements = {
        format: str => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str), // Formato básico de correo
        domain: str => /\.(com|org|net|edu|gov|mx)$/.test(str) // Dominio comúnmente válido
    }; 
    const requirements = {
        length: str => str.length >= 8,
        lowercase: str => /[a-z]/.test(str),
        uppercase: str => /[A-Z]/.test(str),
        number: str => /[0-9]/.test(str),
        special: str => /[@$!%*#?&]/.test(str)
    };

    function updateRequirements(password) {
        let validCount = 0;

        // Verificar cada requisito
        for (const [requirement, validateFn] of Object.entries(requirements)) {
            const element = document.querySelector(`[data-requirement="${requirement}"]`);
            const isValid = validateFn(password);

            element.classList.toggle('valid', isValid);
            element.classList.toggle('invalid', !isValid);

            const icon = element.querySelector('.requirement-icon');
            icon.textContent = isValid ? '✓' : '•';
            icon.classList.toggle('valid', isValid);
            icon.classList.toggle('invalid', !isValid);

            if (isValid) validCount++;
        }

        // Actualizar la barra de fortaleza
        const strength = (validCount / Object.keys(requirements).length) * 100;
        strengthBar.style.width = `${strength}%`;

        // Actualizar el color de la barra según la fortaleza
        if (strength <= 25) {
            strengthBar.style.backgroundColor = '#ef4444';
            strengthText.textContent = 'Débil';
        } else if (strength <= 50) {
            strengthBar.style.backgroundColor = '#f97316';
            strengthText.textContent = 'Regular';
        } else if (strength <= 75) {
            strengthBar.style.backgroundColor = '#eab308';
            strengthText.textContent = 'Buena';
        } else {
            strengthBar.style.backgroundColor = '#22c55e';
            strengthText.textContent = 'Fuerte';
        }
    }
    function updatePhoneRequirements(phone) {
        for (const [requirement, validateFn] of Object.entries(phoneRequirements)) {
            const element = document.querySelector(`[data-requirement="${requirement}"]`);
            const isValid = validateFn(phone);

            element.classList.toggle('valid', isValid);
            element.classList.toggle('invalid', !isValid);

            const icon = element.querySelector('.requirement-icon');
            icon.textContent = isValid ? '✓' : '•';
            icon.classList.toggle('valid', isValid);
            icon.classList.toggle('invalid', !isValid);
        }
    }

    phoneInput.addEventListener('input', function() {
        if (this.value.length > 0) {
            phoneRequirementsBox.style.display = 'block';
        } else {
            phoneRequirementsBox.style.display = 'none';
        }

        updatePhoneRequirements(this.value);
    });

    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (confirmPassword) {
            matchMessage.style.display = 'block';
            if (password === confirmPassword) {
                matchMessage.textContent = 'Las contraseñas coinciden';
                matchMessage.style.color = '#22c55e';
            } else {
                matchMessage.textContent = 'Las contraseñas no coinciden';
                matchMessage.style.color = '#ef4444';
            }
        } else {
            matchMessage.style.display = 'none';
        }
    }

    passwordInput.addEventListener('input', function() {
        // Mostrar el cuadro de validación al empezar a escribir y ocultarlo si está vacío
        if (this.value.length > 0) {
            requirementsBox.style.display = 'block';
        } else {
            requirementsBox.style.display = 'none';
        }

        updateRequirements(this.value);
        checkPasswordMatch();
    });

    confirmPasswordInput.addEventListener('input', checkPasswordMatch);


    function updateEmailRequirements(email) {
        let validCount = 0;

        for (const [requirement, validateFn] of Object.entries(emailRequirements)) {
            const element = document.querySelector(`[data-requirement="${requirement}"]`);
            const isValid = validateFn(email);

            element.classList.toggle('valid', isValid);
            element.classList.toggle('invalid', !isValid);

            const icon = element.querySelector('.requirement-icon');
            icon.textContent = isValid ? '✓' : '•';
            icon.classList.toggle('valid', isValid);
            icon.classList.toggle('invalid', !isValid);

            if (isValid) validCount++;
        }
    }

    passwordInput.addEventListener('input', function() {
        if (this.value.length > 0) {
            requirementsBox.style.display = 'block';
        } else {
            requirementsBox.style.display = 'none';
        }

        updateRequirements(this.value);
        checkPasswordMatch();
    });

    confirmPasswordInput.addEventListener('input', checkPasswordMatch);

    emailInput.addEventListener('input', function() {
        if (this.value.length > 0) {
            emailRequirementsBox.style.display = 'block';
        } else {
            emailRequirementsBox.style.display = 'none';
        }

        updateEmailRequirements(this.value);
    });
});

    document.querySelectorAll('.password-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const showIcon = this.querySelector('.eye-icon-show');
            const hideIcon = this.querySelector('.eye-icon-hide');

            if (input.type === 'password') {
                input.type = 'text';
                showIcon.style.display = 'none';
                hideIcon.style.display = 'block';
                this.classList.add('visible');
            } else {
                input.type = 'password';
                showIcon.style.display = 'block';
                hideIcon.style.display = 'none';
                this.classList.remove('visible');
            }
        });
    });

</script>
@endsection