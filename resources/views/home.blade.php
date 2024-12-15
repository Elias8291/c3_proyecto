@extends('layouts.app')

<style>
:root {
    --header-color: #9B2847;
    --background: #E8E8E8;
    --card-bg: #ffffff;
    --text-dark: #2C3E50;
    --shadow-color: rgba(155, 40, 71, 0.1);
    --gradient-start: #9B2847;
    --gradient-end: #7B1F38;
    --icon-bg: rgba(155, 40, 71, 0.9);
    --accent-light: rgba(155, 40, 71, 0.05);
}

body {
    background-color: var(--background);
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
    background-image: 
        linear-gradient(45deg, var(--accent-light) 25%, transparent 25%),
        linear-gradient(-45deg, var(--accent-light) 25%, transparent 25%),
        linear-gradient(45deg, transparent 75%, var(--accent-light) 75%),
        linear-gradient(-45deg, transparent 75%, var(--accent-light) 75%);
    background-size: 20px 20px;
    background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
}

.dashboard-container {
    padding: 2.5rem;
    max-width: 1600px;
    margin: 0 auto;
}

/* Header Elegante Mejorado */
.page__heading {
    color: var(--header-color);
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 2.5rem;
    position: relative;
    padding-bottom: 1rem;
    letter-spacing: -0.5px;
    text-shadow: 2px 2px 4px rgba(155, 40, 71, 0.1);
}

.page__heading::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100px;
    height: 6px;
    background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
    border-radius: 3px;
    box-shadow: 0 2px 4px rgba(155, 40, 71, 0.2);
}

/* Grid Refinado */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
    padding: 1.5rem;
    perspective: 1000px;
}

/* Cards Elegantes */
.stat-card {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 2rem;
    position: relative;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(155, 40, 71, 0.08);
    overflow: hidden;
    box-shadow: 
        0 10px 30px -10px var(--shadow-color),
        0 5px 10px rgba(0, 0, 0, 0.04);
    backdrop-filter: blur(5px);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-8px) rotateX(2deg);
    box-shadow: 
        0 20px 40px -15px var(--shadow-color),
        0 10px 20px -10px rgba(0, 0, 0, 0.06);
}

.stat-card:hover::before {
    opacity: 1;
}

/* Header de Card Mejorado */
.stat-header {
    display: flex;
    align-items: center;
    gap: 2rem;
    position: relative;
}

/* Icono Elegante */
.stat-icon {
    background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    width: 75px;
    height: 75px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    box-shadow: 
        0 8px 20px -8px rgba(155, 40, 71, 0.5),
        inset 0 -2px 0 rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.stat-icon::after {
    content: '';
    position: absolute;
    inset: 2px;
    background: linear-gradient(135deg, 
        rgba(255, 255, 255, 0.3),
        transparent 60%,
        rgba(0, 0, 0, 0.1)
    );
    border-radius: 16px;
    opacity: 0.8;
}

.stat-card:hover .stat-icon {
    transform: scale(1.08) translateY(-2px);
    box-shadow: 
        0 15px 25px -8px rgba(155, 40, 71, 0.6),
        inset 0 -2px 0 rgba(0, 0, 0, 0.15);
}

.stat-icon i {
    color: #ffffff;
    font-size: 2rem;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    transition: transform 0.3s ease;
}

.stat-card:hover .stat-icon i {
    transform: scale(1.1);
}

/* Información Refinada */
.stat-info {
    flex: 1;
}

.stat-info h3 {
    font-size: 2.6rem;
    font-weight: 800;
    color: var(--header-color);
    margin: 0;
    line-height: 1;
    letter-spacing: -0.5px;
    transition: all 0.3s ease;
    text-shadow: 0 2px 4px rgba(155, 40, 71, 0.1);
}

.stat-info p {
    color: var(--text-dark);
    font-size: 1.1rem;
    margin: 0.5rem 0 0;
    font-weight: 500;
    opacity: 0.8;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
}

.stat-card:hover .stat-info h3 {
    transform: scale(1.02);
    color: var(--gradient-start);
}

.stat-card:hover .stat-info p {
    opacity: 1;
    transform: translateX(5px);
}

/* Efectos Decorativos */
.stat-card::after {
    content: '';
    position: absolute;
    top: -100%;
    right: -100%;
    width: 200%;
    height: 200%;
    background: radial-gradient(
        circle,
        rgba(155, 40, 71, 0.03) 0%,
        transparent 70%
    );
    opacity: 0;
    transition: opacity 0.6s ease;
    transform: rotate(30deg);
}

.stat-card:hover::after {
    opacity: 1;
}

/* Animación de Entrada */
@keyframes cardAppear {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-card {
    animation: cardAppear 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    animation-delay: calc(var(--card-index, 0) * 0.1s);
}

/* Responsive Mejorado */
@media (max-width: 1200px) {
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 1.5rem;
    }
    
    .page__heading {
        font-size: 2.2rem;
    }
    
    .stat-info h3 {
        font-size: 2.2rem;
    }
    
    .stat-icon {
        width: 65px;
        height: 65px;
    }
}
.main-footer {
    background-color: var(--card-bg); /* Usa la misma variable de color que las tarjetas */
    padding: 1rem;
    border-top: 1px solid rgba(155, 40, 71, 0.08); /* Usa el mismo color del borde de las tarjetas */
    position: relative;
    z-index: 10;
    box-shadow: 0 -5px 15px var(--shadow-color);
    color: var(--text-dark);
}
</style>

@section('content')
@can('ver-dashboard')
<div class="dashboard-container">
    <div class="d-flex align-items-cente">
        <h3 class="page__heading">Dashboard</h3>
    </div>

    <div class="stats-grid" >
        <!-- Tarjeta de Usuarios -->
        <div class="stat-card" style="background: #f0f0f0">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    @php
                        $cant_usuarios = \App\Models\User::count();
                    @endphp
                    <h3>{{ number_format($cant_usuarios) }}</h3>
                    <p>Usuarios Registrados</p>
                </div>
            </div>
        
        </div>

        <div class="stat-card" style="background: #f0f0f0">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-user-shield"></i>

                </div>
                <div class="stat-info">
                    @php
                    $cant_roles = \Spatie\Permission\Models\Role::count();
                    @endphp
                    <h3>{{ number_format($cant_roles) }}</h3>
                    <p>Roles Registrados</p>
                </div>
            </div>
        
        </div>

        <!-- Tarjeta de Evaluados -->
        <div class="stat-card" style="background: #f0f0f0">
            <div class="stat-header" >
                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-info">
                    @php
                        $cant_evaluados = \App\Models\Evaluado::count();
                    @endphp
                    <h3>{{ number_format($cant_evaluados) }}</h3>
                    <p>Evaluados Totales</p>
                </div>
            </div>
        
        </div>

        <div class="stat-card" style="background: #f0f0f0">
            <div class="stat-header" >
                <div class="stat-icon">
                    <i class="fas fa-folder"></i>
                </div>
                <div class="stat-info">
                    @php
                        $cant_carpetas = \App\Models\Carpeta::count();
                    @endphp
                    <h3>{{ number_format($cant_carpetas) }}</h3>
                    <p>Carpetas Totales</p>
                </div>
            </div>
          
        </div>

        <div class="stat-card" style="background: #f0f0f0">
            <div class="stat-header" >
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-info">
                    @php
                        $cant_cajas = \App\Models\Caja::count();
                    @endphp
                    <h3>{{ number_format($cant_cajas) }}</h3>
                    <p>Cajas Totales</p>
                </div>
            </div>
          
        </div>
  
    </div>

   
</div>
@else
<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Bienvenido al Sistema</h2>
        <p>Para acceder al panel de administración, por favor contacta con tu administrador para obtener los permisos necesarios.</p>
    </div>
</div>
@endcan
@endsection
