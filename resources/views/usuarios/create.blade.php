@extends('layouts.app')

@section('content')
<main class="profile-page">
    <section class="relative py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <!-- Contenedor Principal -->
            <div class="flex flex-wrap justify-center">
                <div class="w-full lg:w-8/12 px-4">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="px-6 py-4">
                            <!-- Título del Formulario -->
                            <div class="text-center mb-8">
                                <h3 class="text-3xl font-semibold text-gray-800">Crear Nuevo Usuario</h3>
                            </div>

                            <!-- Formulario de Creación de Usuario -->
                            <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Nombre -->
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2" for="name">Nombre</label>
                                    <input name="name" value="{{ old('name') }}" 
                                           class="form-control @error('name') border-red-500 @enderror block w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                           type="text" required>
                                    @error('name')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Apellido Paterno -->
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2" for="apellido_paterno">Apellido Paterno</label>
                                    <input name="apellido_paterno" value="{{ old('apellido_paterno') }}" 
                                           class="form-control @error('apellido_paterno') border-red-500 @enderror block w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                           type="text" required>
                                    @error('apellido_paterno')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Apellido Materno -->
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2" for="apellido_materno">Apellido Materno</label>
                                    <input name="apellido_materno" value="{{ old('apellido_materno') }}" 
                                           class="form-control @error('apellido_materno') border-red-500 @enderror block w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                           type="text">
                                    @error('apellido_materno')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2" for="email">Email</label>
                                    <input name="email" type="email" value="{{ old('email') }}" 
                                           class="form-control @error('email') border-red-500 @enderror block w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                           required>
                                    @error('email')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Contraseña -->
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2" for="password">Contraseña</label>
                                    <input name="password" type="password" 
                                           class="form-control @error('password') border-red-500 @enderror block w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                           required>
                                    @error('password')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirmación de Contraseña -->
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2" for="password_confirmation">Confirmar Contraseña</label>
                                    <input name="password_confirmation" type="password" 
                                           class="form-control block w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                           required>
                                </div>

                                <!-- Teléfono -->
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2" for="telefono">Teléfono</label>
                                    <input name="telefono" value="{{ old('telefono') }}" 
                                           class="form-control @error('telefono') border-red-500 @enderror block w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                           type="text">
                                    @error('telefono')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Área -->
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2" for="id_area">Área</label>
                                    <select name="id_area" 
                                            class="form-control @error('id_area') border-red-500 @enderror block w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                            required>
                                        <option value="">Seleccione un Área</option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->id }}" {{ old('id_area') == $area->id ? 'selected' : '' }}>{{ $area->nombre_area }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_area')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Rol -->
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2" for="rol">Rol</label>
                                    <select name="rol" 
                                            class="form-control @error('rol') border-red-500 @enderror block w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                            required>
                                        <option value="">Seleccione un Rol</option>
                                        @foreach($roles as $rol)
                                            <option value="{{ $rol->name }}" {{ old('rol') == $rol->name ? 'selected' : '' }}>{{ ucfirst($rol->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('rol')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Imagen de Perfil -->
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2" for="image">Imagen de Perfil</label>
                                    <input name="image" type="file" accept="image/*" 
                                           class="form-control @error('image') border-red-500 @enderror block w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    @error('image')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Botón de Guardar Cambios -->
                                <div class="text-center">
                                    <button type="submit" 
                                            class="bg-indigo-600 text-white font-bold py-3 px-6 rounded-lg shadow hover:bg-indigo-700 transition-all focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
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
