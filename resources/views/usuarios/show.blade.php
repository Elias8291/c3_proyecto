@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('css')
<style>
   .container {
    max-width: 900px;
    margin: 20px auto; /* Cambiado de -50px auto a 20px auto */
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

    .profile-header {
        text-align: center;
        margin-bottom: 40px;
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
    }

    .card-title {
    font-size: 32px;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
}

.container {
    max-width: 900px;
    margin: 20px auto;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}

.page-background {
    background: transparent;
    padding-top: 30px;
}

    .profile-role {
        color: #800020;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 30px;
    }

    .info-section {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .info-title {
        font-size: 20px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
    }

    .info-row {
        margin-bottom: 20px;
    }

    .info-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 5px;
    }

    .info-value {
        color: #2d3748;
        font-size: 16px;
    }

    .btn-edit {
        background: linear-gradient(135deg, #800020 0%, #b30000 100%);
        color: #fff;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(128, 0, 32, 0.2);
        color: #fff;
    }

    .btn-back {
        color: #800020;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .btn-back i {
        margin-right: 8px;
    }

    .btn-back:hover {
        color: #b30000;
    }

    .alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
    font-size: 16px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}
.role-info {
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #800020;
}

.role-badge {
    display: inline-block;
    padding: 6px 12px;
    background: linear-gradient(135deg, #800020, #b30000);
    color: white;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-left: 10px;
    box-shadow: 0 2px 4px rgba(128, 0, 32, 0.2);
}

.info-label {
    font-weight: 600;
    color: #4a5568;
    font-size: 1rem;
}
</style>
@endsection

@section('content')
<main class="profile-page">
    <section class="page-background" style="background: transparent">
        <div class="container">
            <div style="margin-bottom: 30px;">
                <h3 class="card-title">Mi Perfil</h3>
                <div style="text-align: center;">
                    <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #800020, #b30000); margin: 0 auto;"></div>
                </div>
            </div>
            <div class="profile-header">
                <!-- Imagen de Perfil -->
                <div class="fixed-container">
                    @if ($usuario->image)
                        <img src="{{ asset('storage/'.$usuario->image) }}" alt="Foto de perfil" class="fixed-image">
                    @else
                        <img src="https://via.placeholder.com/180" alt="Foto de perfil por defecto" class="fixed-image">
                    @endif
                </div>

                <!-- Nombre y Rol -->
                <h1 class="card-title">{{ $usuario->name }} {{ $usuario->apellido_paterno }}</h1>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="role-info">
                            <label class="info-label">Rol Actual:</label>
                            <span class="role-badge">{{ $usuario->roles->first()->name ?? 'Sin rol asignado' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de Edición -->
            <form action="{{ route('usuarios.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Información Personal -->
                <div class="info-section">
                    <h2 class="info-title">Editar Información Personal</h2>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $usuario->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido_paterno">Apellido Paterno</label>
                                <input type="text" name="apellido_paterno" class="form-control" value="{{ old('apellido_paterno', $usuario->apellido_paterno) }}" required>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido_materno">Apellido Materno</label>
                                <input type="text" name="apellido_materno" class="form-control" value="{{ old('apellido_materno', $usuario->apellido_materno) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $usuario->telefono) }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Imagen de Perfil</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>

              <!-- Cambiar Contraseña -->
<div class="info-section">
    <h2 class="info-title">Cambiar Contraseña</h2>

    <div class="form-group">
        <label for="current_password">Contraseña Actual (solo si deseas cambiarla)</label>
        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
        @error('current_password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    

    <div class="form-group">
        <label for="password">Nueva Contraseña</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirmar Nueva Contraseña</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
</div>


                <!-- Botón Guardar Cambios -->
                <button type="submit" class="
                btn btn-primary btn-edit">Guardar Cambios</button>
            </form>

            @if(session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </section>
</main>
@endsection