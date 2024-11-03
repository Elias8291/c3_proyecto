@extends('layouts.app')
<link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">

<style>
   /* Variables para el esquema de colores */
:root {
    --primary-burgundy: #800020;
    --secondary-navy: #1f2937;
    --accent-gold: #d4b483;
    --accent-cream: #f5ebe0;
    --neutral-gray: #f3f4f6;
    --deep-blue: #334155;
    --soft-white: #ffffff;
    --text-primary: #1f2937;
    --text-secondary: #4b5563;
    
    /* Gradientes suaves para las tarjetas */
    --card-1: linear-gradient(145deg, #800020 0%, #9a1b3c 100%);
    --card-2: linear-gradient(145deg, #1f2937 0%, #374151 100%);
    --card-3: linear-gradient(145deg, #334155 0%, #475569 100%);
    --card-4: linear-gradient(145deg, #292524 0%, #44403c 100%);
}

.section {
    padding: 2rem;
    background: var(--neutral-gray);
    background-image: 
        radial-gradient(circle at 10% 20%, rgba(128, 0, 32, 0.03) 0%, transparent 20%),
        radial-gradient(circle at 90% 80%, rgba(31, 41, 55, 0.03) 0%, transparent 20%);
    min-height: 100vh;
}

.section-header {
    margin-bottom: 3rem;
    position: relative;
    text-align: center;
}

.page__heading {
    color: var(--secondary-navy);
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    position: relative;
    display: inline-block;
}

.page__heading::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: var(--accent-gold);
}

.card-container {
    background: var(--soft-white);
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
    margin-bottom: 2rem;
}

.card-custom {
    border-radius: 12px;
    border: none;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    min-height: 160px;
    position: relative;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

/* Estilos de tarjetas específicos */
.card-custom.bg-primary { background: var(--card-1); }
.card-custom.bg-danger { background: var(--card-2); }
.card-custom.bg-success { background: var(--card-3); }
.card-custom.bg-info { background: var(--card-4); }

.card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.card-custom .card-body {
    padding: 1.5rem;
    position: relative;
    z-index: 2;
}

.card-custom .card-title {
    color: var(--soft-white);
    font-size: 1rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.card-custom .card-title i {
    font-size: 1.2rem;
    opacity: 0.9;
}

.card-custom h2 {
    color: var(--soft-white);
    font-size: 2rem;
    font-weight: 600;
    margin: 0.5rem 0 1rem;
}

.card-custom a.text-white {
    color: var(--soft-white);
    font-size: 0.875rem;
    text-decoration: none;
    opacity: 0.9;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.card-custom a.text-white:hover {
    opacity: 1;
    gap: 0.75rem;
}

/* Decoración de tarjetas moderna */
.card-custom::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(30%, -30%);
}

.card-custom::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 120px;
    height: 120px;
    background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-30%, 30%);
}

/* Sección de bienvenida modernizada */
.welcome-section {
    background: var(--soft-white);
    border-radius: 16px;
    padding: 3rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    max-width: 800px;
    margin: 3rem auto;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.welcome-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(to right, 
        var(--primary-burgundy),
        var(--accent-gold),
        var(--secondary-navy)
    );
}

.welcome-title {
    color: var(--text-primary);
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    line-height: 1.3;
}

.welcome-message {
    color: var(--text-secondary);
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 2rem;
}

/* Animaciones refinadas */
@keyframes fadeInUp {
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
    animation: fadeInUp 0.5s ease-out forwards;
    animation-delay: calc(var(--animation-order) * 0.1s);
}

/* Mejoras responsivas */
@media (max-width: 768px) {
    .section {
        padding: 1.5rem;
    }
    
    .card-container {
        padding: 1.5rem;
    }
    
    .welcome-section {
        padding: 2rem;
        margin: 2rem auto;
    }
    
    .welcome-title {
        font-size: 1.75rem;
    }
    
    .page__heading {
        font-size: 1.75rem;
    }
}

@media (max-width: 576px) {
    .section {
        padding: 1rem;
    }
    
    .card-container {
        padding: 1rem;
    }
    
    .card-custom .card-body {
        padding: 1.25rem;
    }
    
    .welcome-section {
        padding: 1.5rem;
    }
}

/* Estilos para destacar información importante */
.highlight-text {
    color: var(--primary-burgundy);
    font-weight: 500;
}

.stat-trend {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #10b981;
    margin-top: 0.5rem;
}

.stat-trend.negative {
    color: #ef4444;
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
