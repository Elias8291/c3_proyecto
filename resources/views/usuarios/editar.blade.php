@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('css')
<style>
    .container {
        max-width: 900px;
        margin: -50px auto;
        /* Margen negativo aún mayor */
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

    .fixed-container {
        width: 180px;
        height: 180px;
        margin: 0 auto 30px;
        position: relative;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 5px;
        background: linear-gradient(135deg, #800020, #b30000);
    }

    .fixed-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        transition: transform 0.3s ease;
    }

    .fixed-container:hover .fixed-image {
        transform: scale(1.05);
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
    input[type="email"] ,
    select,
    textarea {
        font-size: 17px !important;
    }
   
</style>
@endsection

@section('content')
<main class="profile-page">
    <section class="page-background" style="background: transparent">
        <div class="container">
            <div class="text-left mb-4">
                <a href="javascript:history.back()" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
            <div class="text-center mb-4">
                <h3 class="card-title">Editar Usuario</h3>
            </div>

            <!-- Imagen de Perfil -->
            <div class="fixed-container mb-4">
                @if ($usuario->image)
                <img alt="Imagen de perfil" src="{{ asset('storage/'.$usuario->image) }}" class="fixed-image">
                @else
                <img alt="Imagen no disponible" src="https://via.placeholder.com/150" class="fixed-image">
                @endif
            </div>

            <!-- Formulario -->
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <!-- Nombre -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="name">Nombre</label>
                        <input name="name" value="{{ old('name', $usuario->name) }}"
                            class="form-control @error('name') form-error @enderror" type="text" required>
                        @error('name')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Apellido Paterno -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="apellido_paterno">Apellido Paterno</label>
                        <input name="apellido_paterno" value="{{ old('apellido_paterno', $usuario->apellido_paterno) }}"
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
                        <input name="apellido_materno" value="{{ old('apellido_materno', $usuario->apellido_materno) }}"
                            class="form-control @error('apellido_materno') form-error @enderror" type="text">
                        @error('apellido_materno')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="telefono">Teléfono</label>
                        <input name="telefono" value="{{ old('telefono', $usuario->telefono) }}"
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
                        <input name="email" type="email" value="{{ old('email', $usuario->email) }}"
                            class="form-control @error('email') form-error @enderror" required>
                        @error('email')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Roles -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="rol">Rol</label>
                        <select name="rol" class="form-control" required>
                            @foreach($roles as $rol)
                            <option value="{{ $rol->name }}" {{ $usuario->roles->first()->name == $rol->name ?
                                'selected' : '' }}>
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
                            <option value="{{ $area->id }}" {{ old('id_area', $usuario->id_area) == $area->id ?
                                'selected' : '' }}>
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
    let camposConErrores = []; // Array para almacenar los nombres de los campos con errores

    // Validar nombre y apellidos
    $('input[name="name"], input[name="apellido_paterno"], input[name="apellido_materno"]').each(function () {
        validarTextoSoloLetras(this);
        if ($(this).hasClass('form-error')) {
            isValid = false;
            camposConErrores.push($(this).prev('label').text()); // Agregar el nombre del campo con error
            console.log('Campo con error:', $(this).prev('label').text()); // Mostrar el campo que tiene error
        } else {
            console.log('Campo sin error:', $(this).prev('label').text()); // Mostrar el campo sin error
        }
    });

    // Validar teléfono
    $('form').on('submit', function (e) {
    let isValid = true;
    let camposConErrores = []; // Array para almacenar los nombres de los campos con errores

    // Validar nombre y apellidos
    $('input[name="name"], input[name="apellido_paterno"], input[name="apellido_materno"]').each(function () {
        validarTextoSoloLetras(this);
        if ($(this).hasClass('form-error')) {
            isValid = false;
            camposConErrores.push($(this).prev('label').text()); // Agregar el nombre del campo con error
        }
    });

    // Validar teléfono
    validarTelefono($('input[name="telefono"]'));
    if ($('input[name="telefono"]').hasClass('form-error')) {
        isValid = false;
        camposConErrores.push('Teléfono');
    }

    // Si no hay campos con errores, permitir el envío
    if (!isValid && camposConErrores.length > 0) {
        e.preventDefault();
        alert('Por favor, corrige los siguientes campos: ' + camposConErrores.join(', '));
    }
});


        // Mostrar mensaje de errores del servidor
        @if ($errors->any())
        alert('Existen errores en el formulario. Por favor, revisa los campos marcados.');
        @endif
    });
</script>
@endsection