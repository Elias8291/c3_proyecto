@extends('layouts.app')

<style>
    :root {
        --primary: #800020;          /* Guinda base */
        --primary-light: #9a1134;    /* Guinda claro */
        --primary-dark: #590018;     /* Guinda oscuro */
        --gold: #050505;             /* Dorado para acentos */
        --white: #070707;            /* Blanco puro */
        --light-gray: #030303;       /* Gris claro para fondos secundarios */
        --gray: #cccccc;             /* Gris medio para bordes y sombras */
        --background: #020202;       /* Fondo ligeramente rosado */
        --text-primary: #1b1a1a;     /* Blanco para texto sobre guinda */
        --text-secondary: #0e0d0d;   /* Gris muy claro para textos secundarios */
        --success: #28a745;          /* Verde para indicadores positivos */
        --danger: #dc3545;           /* Rojo para indicadores negativos */
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--background);
        font-family: 'Poppins', sans-serif;
        color: var(--text-primary);
        min-height: 100vh;
    }

    .dashboard-container {
        padding: 2.5rem;
        max-width: 1500px;
        margin: 0 auto;
        background: linear-gradient(180deg, rgba(128,0,32,0.03) 0%, rgba(255,255,255,0) 100%);
        min-height: calc(100vh - 4rem);
    }

    /* Header mejorado */
    .dashboard-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 30px;
        padding: 3.5rem;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px -20px rgba(89,0,24,0.4);
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: repeating-linear-gradient(
            45deg,
            rgba(255,255,255,0.1) 0%,
            rgba(255,255,255,0.1) 10%,
            transparent 10%,
            transparent 20%
        );
        animation: shine 20s linear infinite;
    }

    @keyframes shine {
        0% {
            transform: translateX(-50%) translateY(-50%) rotate(0deg);
        }
        100% {
            transform: translateX(-50%) translateY(-50%) rotate(360deg);
        }
    }

    .dashboard-header h2 {
        color: var(--white);
        font-size: 2.75rem;
        font-weight: 800;
        margin-bottom: 1.25rem;
        position: relative;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        letter-spacing: -1px;
    }

    .dashboard-header p {
        color: rgba(3, 3, 3, 0.95);
        font-size: 1.2rem;
        max-width: 600px;
        line-height: 1.8;
        position: relative;
        font-weight: 300;
    }

    /* Grid mejorado */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 2.5rem;
        position: relative;
    }

    .stat-card {
        background: var(--primary); /* Guinda */
        border-radius: 24px;
        padding: 2.5rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        border: 1px solid var(--gray); /* Gris medio para borde */
        box-shadow: 
            0 10px 30px -15px rgba(89,0,24,0.3),
            0 1px 4px rgba(89,0,24,0.2);
        color: var(--white); /* Texto blanco */
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            135deg,
            rgba(128,0,32,0.05) 0%,
            transparent 50%,
            rgba(128,0,32,0.05) 100%
        );
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 
            0 20px 40px -20px rgba(89,0,24,0.5),
            0 1px 8px rgba(89,0,24,0.3);
    }

    .stat-card:hover::after {
        opacity: 1;
    }

    .stat-header {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        position: relative;
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-right: 1.5rem;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-dark) 100%);
        color: var(--white);
        box-shadow: 
            0 15px 25px -12px rgba(89,0,24,0.4),
            0 0 10px rgba(89,0,24,0.2);
        position: relative;
        overflow: hidden;
    }

    .stat-icon::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 60%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover .stat-icon::after {
        opacity: 1;
    }

    .stat-info h3 {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold) 100%); /* Dorado para destacar */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.75rem;
        letter-spacing: -1px;
    }

    .stat-info p {
        color: var(--light-gray); /* Texto secundario gris claro */
        font-size: 1.1rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .stat-footer {
        display: flex;
        align-items: center;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--gray); /* Gris medio para separador */
        position: relative;
    }

    .stat-trend {
        display: flex;
        align-items: center;
        font-size: 1rem;
        font-weight: 600;
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        color: var(--white); /* Texto blanco */
    }

    .stat-trend.up {
        color: var(--success);
        background: rgba(40,167,69,0.1); /* Verde suave */
    }

    .stat-trend.down {
        color: var(--danger);
        background: rgba(220,53,69,0.1); /* Rojo suave */
    }

    .stat-trend i {
        margin-right: 0.75rem;
        font-size: 0.875rem;
    }

    .stat-card:hover .stat-trend {
        transform: scale(1.05);
    }

    /* Botones y enlaces */
    .btn-primary {
        background-color: var(--gold);
        color: var(--primary);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        transition: background-color 0.3s ease, color 0.3s ease;
        cursor: pointer;
    }

    .page__heading {
        color: #ffffff;
        font-weight: 800;
        font-size: 2.5rem;
        margin: 0 0 1.8rem;
        position: relative;
        display: inline-block;
        padding-bottom: 1rem;
    }

    .page__heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, var(--pastel-pink), var(--primary-burgundy));
        border-radius: 3px;
    }

    .btn-primary:hover {
        background-color: var(--primary);
        color: var(--gold);
        border: 1px solid var(--gold);
    }

    /* Enlaces */
    a {
        color: var(--gold);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    a:hover {
        color: var(--primary-light);
    }

    /* Añadir más estilos según sea necesario */

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1.5rem;
        }

        .dashboard-header {
            padding: 2.5rem 2rem;
            text-align: center;
        }

        .dashboard-header h2 {
            font-size: 2rem;
        }

        .dashboard-header p {
            font-size: 1rem;
            margin: 0 auto;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .stat-card {
            padding: 2rem;
        }

        .stat-info h3 {
            font-size: 2.5rem;
        }
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
        <!-- Puedes añadir más tarjetas aquí siguiendo el mismo esquema -->
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
