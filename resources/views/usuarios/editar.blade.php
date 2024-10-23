@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

<main class="profile-page">
    <section class="relative block h-500-px">
        <!-- SVG de fondo -->
        <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
            style="transform: translateZ(0px)">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </section>

    <section class="relative py-16">
        <div class="container mx-auto px-4">
            <!-- Contenedor Principal con Margen Negativo -->
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg"
                style="margin-top: -28rem;">

                <div class="px-2">
                    <div class="flex flex-wrap justify-center">
                        <!-- Imagen de Perfil -->
                        <div class="w-full flex justify-center mb-4">
                            <div class="relative w-32 h-32">
                                @if ($usuario->image)
                                    <img alt="Imagen de perfil" src="{{ asset('storage/'.$usuario->image) }}"
                                         class="object-cover w-full h-full rounded-full shadow-xl border-none">
                                @else
                                    <img alt="Imagen no disponible" src="https://via.placeholder.com/150"
                                         class="object-cover w-full h-full rounded-full shadow-xl border-none">
                                @endif
                            </div>
                        </div>

                        <!-- Información del Usuario -->
                        <div class="w-full lg:w-4/12 px-4 lg:order-1">
                            <div class="text-center py-4 lg:pt-4 pt-8">
                                <!-- Biografía del Usuario -->
                                @if($usuario->bio)
                                    <p class="text-lg text-blueGray-600">{{ $usuario->bio }}</p>
                                @endif

                                <!-- Ubicación del Usuario -->
                                @if($usuario->location)
                                    <p class="mt-2 text-blueGray-400">
                                        <i class="fas fa-map-marker-alt mr-2"></i> {{ $usuario->location }}
                                    </p>
                                @endif

                                <!-- Sitio Web del Usuario -->
                                @if($usuario->website)
                                    <a href="{{ $usuario->website }}" class="mt-2 text-blue-500 hover:underline"
                                        target="_blank">
                                        <i class="fas fa-globe mr-2"></i> Visitar Sitio Web
                                    </a>
                                @endif

                                <!-- Redes Sociales del Usuario (Opcional) -->
                                <div class="mt-4 flex justify-center space-x-4">
                                    @if($usuario->twitter)
                                        <a href="{{ $usuario->twitter }}" class="text-blue-400 hover:text-blue-600"
                                            target="_blank">
                                            <i class="fab fa-twitter fa-lg"></i>
                                        </a>
                                    @endif
                                    @if($usuario->facebook)
                                        <a href="{{ $usuario->facebook }}" class="text-blue-600 hover:text-blue-800"
                                            target="_blank">
                                            <i class="fab fa-facebook fa-lg"></i>
                                        </a>
                                    @endif
                                    @if($usuario->linkedin)
                                        <a href="{{ $usuario->linkedin }}" class="text-blue-700 hover:text-blue-900"
                                            target="_blank">
                                            <i class="fab fa-linkedin fa-lg"></i>
                                        </a>
                                    @endif
                                    <!-- Añade más redes sociales según sea necesario -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de Edición del Usuario -->
                    <div class="text-center mt-12">
                        <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700">
                        {{ $usuario->name }} {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }}
                        </h3>
                        <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                            <i class="fas fa-envelope mr-2 text-lg text-blueGray-400"></i>
                            {{ $usuario->email }}
                        </div>
                    </div>

                    <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-9/12 px-4">
                                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Nombre -->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                            Nombre
                                        </label>
                                        <input name="name" value="{{ old('name', $usuario->name) }}"
                                            class="shadow appearance-none border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            type="text" required>
                                        @error('name')
                                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Apellido Paterno -->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2"
                                            for="apellido_paterno">
                                            Apellido Paterno
                                        </label>
                                        <input name="apellido_paterno"
                                            value="{{ old('apellido_paterno', $usuario->apellido_paterno) }}"
                                            class="shadow appearance-none border {{ $errors->has('apellido_paterno') ? 'border-red-500' : 'border-gray-300' }} rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            type="text" required>
                                        @error('apellido_paterno')
                                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Apellido Materno -->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2"
                                            for="apellido_materno">
                                            Apellido Materno
                                        </label>
                                        <input name="apellido_materno"
                                            value="{{ old('apellido_materno', $usuario->apellido_materno) }}"
                                            class="shadow appearance-none border {{ $errors->has('apellido_materno') ? 'border-red-500' : 'border-gray-300' }} rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            type="text">
                                        @error('apellido_materno')
                                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Teléfono -->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telefono">
                                            Teléfono
                                        </label>
                                        <input name="telefono" value="{{ old('telefono', $usuario->telefono) }}"
                                            class="shadow appearance-none border {{ $errors->has('telefono') ? 'border-red-500' : 'border-gray-300' }} rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            type="text">
                                        @error('telefono')
                                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                            Email
                                        </label>
                                        <input name="email" type="email" value="{{ old('email', $usuario->email) }}"
                                            class="shadow appearance-none border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            required>
                                        @error('email')
                                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Roles -->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="rol">Rol</label>
                                        <select name="rol" class="form-control" required>
                                            @foreach($roles as $rol)
                                            <option value="{{ $rol->name }}" {{ $usuario->roles->first()->name == $rol->name ? 'selected' : '' }}>
                                                {{ $rol->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Área -->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="id_area">
                                            Área
                                        </label>
                                        <select name="id_area"
                                            class="shadow appearance-none border {{ $errors->has('id_area') ? 'border-red-500' : 'border-gray-300' }} rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            required>
                                            <option value="">Seleccione un Área</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" {{ old('id_area', $usuario->id_area) == $area->id ? 'selected' : '' }}>
                                                    {{ $area->nombre_area }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_area')
                                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Imagen de Perfil -->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                                            Imagen de Perfil
                                        </label>
                                        <input name="image" type="file" accept="image/*" 
                                            class="shadow appearance-none border {{ $errors->has('image') ? 'border-red-500' : 'border-gray-300' }} rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('image')
                                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                
                                    <!-- Botón de guardar cambios -->
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                                        Guardar Cambios
                                    </button>

                                </form>
                            </div>
                        </div>

                        <!-- Mensajes de Éxito y Error Debajo del Formulario -->
                        <div class="mt-6">
                            <!-- Mensaje de Éxito -->
                            @if(session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                    role="alert" aria-live="assertive">
                                    <strong class="font-bold">¡Éxito!</strong>
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                        <svg class="fill-current h-6 w-6 text-green-500" role="button"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <title>Close</title>
                                            <path
                                                d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                                        </svg>
                                    </span>
                                </div>
                            @endif

                            <!-- Mensajes de Error de Validación -->
                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                    role="alert" aria-live="assertive">
                                    <strong class="font-bold">¡Error!</strong>
                                    <span class="block sm:inline">Por favor, revisa los siguientes campos:</span>
                                    <ul class="mt-2 list-disc list-inside text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                        <svg class="fill-current h-6 w-6 text-red-500" role="button"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <title>Close</title>
                                            <path
                                                d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                                        </svg>
                                    </span>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script>
    $(document).ready(function() {
        // Opcional: Mostrar mensaje de éxito con SweetAlert2
        /*
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'Por favor, revisa los campos destacados.',
                showConfirmButton: true,
                confirmButtonText: 'Cerrar'
            });
        @endif
        */

        // Manejar el cierre de alertas estáticas
        const closeButtons = document.querySelectorAll('[role="button"]');

        closeButtons.forEach(button => {
            button.addEventListener('click', function () {
                this.parentElement.style.display = 'none';
            });
        });

        // Validaciones personalizadas o scripts adicionales
        $('input[type="text"]').focus(function() {
            $(this).parent().addClass('active');
        }).blur(function() {
            if ($(this).val() === '') {
                $(this).parent().removeClass('active');
            }
        });

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
    .bg-primary {
        background-color: #4b479c;
    }

    .form-label {
        font-weight: bold;
        color: #4b479c;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .form-control {
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 100%;
        box-sizing: border-box;
        transition: all 0.2s ease;
        font-size: 16px;
        background-color: #f9f9f9;
    }

    .form-control:focus {
        border-color: #4b479c;
        box-shadow: 0 0 8px rgba(75, 71, 156, 0.3);
        background-color: #fff;
    }

    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        padding: 20px;
        background-color: #4b479c;
        border-bottom: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .btn-back {
        /* Otros estilos */
        background-color: #ffffff;
        /* Fondo blanco */
        color: #800000;
        /* Texto rojo oscuro */
    }

    .btn-back:hover {
        background-color: #f0f0f0;
        color: #660000;
        /* Texto rojo más oscuro al pasar el mouse */
    }

    .card-header .btn-back:hover {
        background-color: rgba(255, 255, 255, 0.2);
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

    .btn-submit {
        transition: all 0.3s ease;
        background-color: #4b479c;
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
        background-color: #3a2c70;
    }

    .btn-submit:focus {
        outline: none;
        box-shadow: 0 0 10px rgba(75, 71, 156, 0.3);
    }

    .section {
        padding: 60px 0;
        background-color: #e0e0eb;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .custom-container {
        max-width: 800px;
        margin: auto;
        border: 3px solid #4b479c;
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

    @media (max-width: 768px) {
        .custom-container {
            padding: 0 20px;
        }
    }
</style>
@endsection
