@extends('layouts.app')
<link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">

<style>
    /* Variables para el esquema de colores */
    :root {
        --primary-burgundy: #800020;
        --light-burgundy: #98304b;
        --pastel-pink: #ffd6e0;
        --pastel-blue: #d6e5ff;
        --pastel-purple: #e5d6ff;
        --hover-pink: #ffecf1;
        --gradient-start: #800020;
        --gradient-end: #b31b41;
        
        /* Colores para las tarjetas */
        --card-users: linear-gradient(135deg, #800020 0%, #98304b 100%);
        --card-evaluated: linear-gradient(135deg, #4B0082 0%, #663399 100%);
        --card-roles: linear-gradient(135deg, #2E0854 0%, #4B0082 100%);
        --card-logs: linear-gradient(135deg, #380036 0%, #4B0045 100%);
    }

    .section {
        padding: 2rem;
        background: linear-gradient(135deg, var(--pastel-pink) 0%, var(--pastel-purple) 100%);
        min-height: 100vh;
    }

    .section-header {
        margin-bottom: 2rem;
    }

    .page__heading {
        color: var(--primary-burgundy);
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
        text-align: center;
        animation: titleFadeIn 0.8s ease-out;
    }

    .card.shadow {
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        box-shadow: 0 8px 32px rgba(128, 0, 32, 0.1);
        padding: 1.5rem;
    }

    .card-custom {
        border-radius: 15px;
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        min-height: 150px; /* Reducido de 180px */
        position: relative;
        margin-bottom: 1.5rem;
    }

    /* Estilos específicos para cada tipo de tarjeta */
    .card-custom.bg-primary {
        background: var(--card-users);
    }

    .card-custom.bg-danger {
        background: var(--card-evaluated);
    }

    .card-custom.bg-success {
        background: var(--card-roles);
    }

    .card-custom.bg-info {
        background: var(--card-logs);
    }

    .card-custom:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    /* Reducir el padding de las tarjetas */
    .card-custom .card-body {
        padding: 1rem; /* Antes: 1.5rem */
    }

    /* Reducir el tamaño de las fuentes */
    .card-custom .card-title {
        font-size: 1.1rem; /* Antes: 1.25rem */
    }

    .card-custom h2 {
        font-size: 2rem; /* Antes: 2.5rem */
    }

    /* Ajustar el tamaño de los iconos */
    .card-custom .card-title i {
        font-size: 1.2rem; /* Antes: 1.5rem */
    }

    /* Ajustar los márgenes */
    .card-custom {
        min-height: 150px; /* Antes: 180px */
    }

    /* Ajustar el tamaño de los enlaces "Ver más" */
    .card-custom a.text-white {
        font-size: 0.9rem; /* Antes: 1rem aproximadamente */
        padding: 0.3rem 0; /* Antes: 0.5rem 0 */
    }

    /* Efectos decorativos para las tarjetas */
    .card-custom::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 80px; /* Reducido de 100px */
        height: 80px; /* Reducido de 100px */
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(20%, -20%); /* Ajustado */
    }

    .card-custom::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        transform: translate(-30%, 30%);
    }

    /* Sección de bienvenida */
    .welcome-section {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.8));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 3rem 2rem;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(128, 0, 32, 0.1);
        max-width: 800px;
        margin: 3rem auto;
        text-align: center;
    }

    .welcome-title {
        color: var(--primary-burgundy);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .welcome-message {
        color: #666;
        font-size: 1.2rem;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    /* Animaciones mejoradas */
    @keyframes titleFadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes cardFadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .row > div {
        animation: cardFadeIn 0.6s ease-out forwards;
    }

    .row > div:nth-child(1) { animation-delay: 0.1s; }
    .row > div:nth-child(2) { animation-delay: 0.2s; }
    .row > div:nth-child(3) { animation-delay: 0.3s; }
    .row > div:nth-child(4) { animation-delay: 0.4s; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-custom {
            margin-bottom: 1rem;
        }
        
        .welcome-title {
            font-size: 2rem;
        }
        
        .page__heading {
            font-size: 2rem;
        }
    }
</style>

@section('content')
@can('ver-dashboard')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Dashboard</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <!-- Usuarios -->
            <div class="col-md-3 col-xl-3">
                <div class="card card-custom bg-primary text-white shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-users"></i> Usuarios</h5>
                        @php
                        $cant_usuarios = \App\Models\User::count();
                        @endphp
                        <h2 class="text-right">
                            <span>{{$cant_usuarios}}</span>
                        </h2>
                        <p class="mb-0 text-right"><a href="/usuarios" class="text-white">Ver más</a></p>
                    </div>
                </div>
            </div>
            <!-- Evaluados -->
            <div class="col-md-3 col-xl-3">
                <div class="card card-custom bg-danger text-white shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-user-lock"></i> Evaluados</h5>
                        @php
                        $cant_evaluados = \App\Models\Evaluado::count();
                        @endphp
                        <h2 class="text-right">
                            <span>{{$cant_evaluados}}</span>
                        </h2>
                        <p class="mb-0 text-right"><a href="/evaluados" class="text-white">Ver más</a></p>
                    </div>
                </div>
            </div>
            <!-- Roles -->
            <div class="col-md-3 col-xl-3">
                <div class="card card-custom bg-success text-white shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-user-tag"></i> Roles</h5>
                        @php
                        $cant_roles = \Spatie\Permission\Models\Role::count();
                        @endphp
                        <h2 class="text-right">
                            <span>{{$cant_roles}}</span>
                        </h2>
                        <p class="mb-0 text-right"><a href="/roles" class="text-white">Ver más</a></p>
                    </div>
                </div>
            </div>
            <!-- Logs -->
            <div class="col-md-3 col-xl-3">
                <div class="card card-custom bg-info text-white shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-clipboard-list"></i> Logs</h5>
                        @php
                        $cant_logs = \App\Models\Log::count();
                        @endphp
                        <h2 class="text-right">
                            <span>{{ $cant_logs }}</span>
                        </h2>
                        <p class="mb-0 text-right"><a href="/logs" class="text-white">Ver más</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<div class="welcome-section">
    <h1 class="welcome-title">Bienvenido al Sistema de Gestión de Alumnos</h1>
    <p class="welcome-message">Comienza explorando nuestras funcionalidades y descubre cómo podemos mejorar tu experiencia de gestión académica.</p>
</div>
@endcan
@endsection
