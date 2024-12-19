@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('css')
<style>
    .container {
        max-width: 900px;
        margin: -50px auto;
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

    .profile-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .profile-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 10px;
    }

    .profile-role {
        color: #800020;
        font-weight: 600;
        font-size: 18px;
    }

    .profile-image-container {
        width: 200px;
        height: 200px;
        margin: 0 auto 30px;
        position: relative;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 5px;
        background: linear-gradient(135deg, #800020, #b30000);
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        transition: transform 0.3s ease;
    }

    .profile-info {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .info-group {
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

    .edit-profile-btn {
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
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .edit-profile-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(128, 0, 32, 0.2);
        color: #fff;
    }
</style>
@endsection

@section('content')
<main class="profile-page">
    <section class="page-background">
        <div class="container">
            <div class="profile-header">
                <div class="profile-image-container">
                    @if (Auth::user()->image)
                        <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="Foto de perfil" class="profile-image">
                    @else
                        <img src="https://via.placeholder.com/200" alt="Foto de perfil por defecto" class="profile-image">
                    @endif
                </div>
                <h1 class="profile-title">{{ Auth::user()->name }} {{ Auth::user()->apellido_paterno }}</h1>
                <p class="profile-role">{{ Auth::user()->roles->first()->name ?? 'Usuario' }}</p>
            </div>

            <div class="profile-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-group">
                            <div class="info-label">Nombre Completo</div>
                            <div class="info-value">
                                {{ Auth::user()->name }} {{ Auth::user()->apellido_paterno }} {{ Auth::user()->apellido_materno }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-group">
                            <div class="info-label">Correo Electrónico</div>
                            <div class="info-value">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-group">
                            <div class="info-label">Teléfono</div>
                            <div class="info-value">{{ Auth::user()->telefono ?? 'No especificado' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-group">
                            <div class="info-label">Área</div>
                            <div class="info-value">{{ Auth::user()->area->nombre_area ?? 'No especificada' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="edit-profile-btn">
                <i class="fas fa-user-edit"></i> Editar Perfil
            </a>
        </div>
    </section>
</main>
@endsection