@extends('layouts.app')

@section('styles')
<style>
    /* Aquí van tus estilos CSS personalizados */
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

    .btn-submit {
        transition: all 0.3s ease;
        background-color: #4b479c; /* Color de fondo personalizado */
        color: #000; /* Texto negro */
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        background-color: #3a2c70; /* Color de fondo al pasar el mouse */
    }

    .btn-submit:focus {
        outline: none;
        box-shadow: 0 0 10px rgba(75, 71, 156, 0.3);
    }

    /* Estilos adicionales según tus necesidades */
</style>
@endsection

@section('content')
<main class="profile-page">
    <section class="relative py-16">
        <div class="container mx-auto px-4">
            <!-- Contenedor Principal -->
            <div class="flex flex-wrap justify-center">
                <div class="w-full lg:w-9/12 px-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- Título del Formulario -->
                            <div class="text-center mb-6">
                                <h3 class="text-4xl font-semibold">Crear Nuevo Usuario</h3>
                            </div>

                            <!-- Formulario de Creación de Usuario -->
                            <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Nombre -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                        Nombre
                                    </label>
                                    <input name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') border-red-500 @enderror"
                                        type="text" required>
                                    @error('name')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Apellido Paterno -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="apellido_paterno">
                                        Apellido Paterno
                                    </label>
                                    <input name="apellido_paterno" value="{{ old('apellido_paterno') }}"
                                        class="form-control @error('apellido_paterno') border-red-500 @enderror"
                                        type="text" required>
                                    @error('apellido_paterno')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Apellido Materno -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="apellido_materno">
                                        Apellido Materno
                                    </label>
                                    <input name="apellido_materno" value="{{ old('apellido_materno') }}"
                                        class="form-control @error('apellido_materno') border-red-500 @enderror"
                                        type="text">
                                    @error('apellido_materno')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                        Email
                                    </label>
                                    <input name="email" type="email" value="{{ old('email') }}"
                                        class="form-control @error('email') border-red-500 @enderror" required>
                                    @error('email')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Teléfono -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="telefono">
                                        Teléfono
                                    </label>
                                    <input name="telefono" value="{{ old('telefono') }}"
                                        class="form-control @error('telefono') border-red-500 @enderror" type="text">
                                    @error('telefono')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Área -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="id_area">
                                        Área
                                    </label>
                                    <select name="id_area"
                                        class="form-control @error('id_area') border-red-500 @enderror" required>
                                        <option value="">Seleccione un Área</option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->id }}" {{ old('id_area') == $area->id ? 'selected' : '' }}>
                                                {{ $area->nombre_area }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_area')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Rol -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="rol">
                                        Rol
                                    </label>
                                    <select name="rol"
                                        class="form-control @error('rol') border-red-500 @enderror" required>
                                        <option value="">Seleccione un Rol</option>
                                        @foreach($roles as $rol)
                                            <option value="{{ $rol->name }}" {{ old('rol') == $rol->name ? 'selected' : '' }}>
                                                {{ ucfirst($rol->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('rol')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Imagen de Perfil -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                                        Imagen de Perfil
                                    </label>
                                    <input name="image" type="file" accept="image/*" capture="environment"
                                        class="form-control @error('image') border-red-500 @enderror">
                                    @error('image')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Botón de Guardar Cambios -->
                                <div class="mb-4">
                                    <button
                                        class="btn-submit"
                                        type="submit">
                                        Guardar Cambios
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<!-- Scripts necesarios -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
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

        // Ejemplos de validaciones específicas
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
