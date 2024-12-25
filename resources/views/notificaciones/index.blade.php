@extends('layouts.app')

@section('content')
    <div class="notifications-container">
        <div class="notifications-header">
            <h1>
                <i class="fas fa-bell"></i>
                Mis Notificaciones
            </h1>
            <div class="notifications-actions">
                @if ($notificaciones->count() > 0)
                    <form action="{{ route('notificaciones.marcarTodasComoLeidas') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="mark-read-btn">
                            <i class="fas fa-check-double"></i>
                            Marcar todas como leídas
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="notifications-content">
            @forelse ($notificaciones as $notificacion)
            <div class="notification-card {{ $notificacion->leida ? '' : 'unread' }}" 
                data-notification-id="{{ $notificacion->id }}">
               <div class="notification-icon">
                   <i class="fas fa-bell"></i>
               </div>
               <div class="notification-body">
                   <div class="notification-message">
                       {{ $notificacion->mensaje }}
                   </div>
                   <div class="notification-meta">
                       <span class="notification-time">
                           <i class="fas fa-clock"></i>
                           {{ $notificacion->created_at->diffForHumans() }}
                       </span>
                       <div class="notification-actions">
                           @can('ver-notificacion-prestamo')
                               @php
                                   $estado = '';
                                   // Detectar el estado basado en el mensaje de la notificación
                                   if (str_contains(strtolower($notificacion->mensaje), 'nueva solicitud')) {
                                       $estado = 'Pendiente';
                                   } elseif (str_contains(strtolower($notificacion->mensaje), 'aprobada')) {
                                       $estado = 'Aprobado';
                                   } elseif (str_contains(strtolower($notificacion->mensaje), 'cancelada')) {
                                       $estado = 'Rechazado';
                                   } elseif (str_contains(strtolower($notificacion->mensaje), 'devuelto')) {
                                       $estado = 'Devuelto';
                                   }
                               @endphp
                               <a href="{{ route('prestamos.index', ['estado' => $estado]) }}" class="view-btn">
                                   <i class="fas fa-eye"></i>
                                   Ver préstamo
                               </a>
                           @endcan
                           @if(!$notificacion->leida)
                               <form action="{{ route('notificaciones.marcarComoLeida', $notificacion->id) }}" method="POST" class="d-inline">
                                   @csrf
                                   <button type="submit" class="mark-read-btn">
                                       <i class="fas fa-check"></i>
                                       Marcar como leída
                                   </button>
                               </form>
                           @endif
                       </div>
                   </div>
               </div>
           </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-bell-slash"></i>
                    <p>¡No tienes notificaciones pendientes!</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
<style>
    :root {
        --primary: #b10c43;
        --primary-dark: #900935;
        --primary-light: rgba(177, 12, 67, 0.05);
        --primary-lighter: rgba(177, 12, 67, 0.02);
        --text-primary: #2d3748;
        --text-secondary: #666;
        --border-color: rgba(0, 0, 0, 0.08);
        --white: #ffffff;
        --transition: cubic-bezier(0.4, 0, 0.2, 1);
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
        --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    /* Navbar Notification Styles */
    .notification-icon {
        position: relative;
        padding: 0.75em 1.25em;
        color: var(--white);
        transition: all 0.3s var(--transition);
        cursor: pointer;
    }



    .notification-bell {
        font-size: 1.5rem;
        color: var(--white);
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .notification-badge {
        position: absolute;
        top: 6px;
        right: 12px;
        background: linear-gradient(45deg, var(--primary), var(--primary-dark));
        color: var(--white);
        border-radius: 6px;
        min-width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0 6px;
        box-shadow: 0 2px 4px rgba(177, 12, 67, 0.2);
        border: 2px solid var(--white);
    }

    /* Dropdown Styles */
    .notifications-dropdown {
        width: 400px;
        border: 1px solid var(--border-color);
        background: var(--white);
        box-shadow: var(--shadow-lg);
        margin-top: 15px;
        border-radius: 8px;
        overflow: hidden;
        animation: dropdownSlide 0.3s var(--transition);
    }

    @keyframes dropdownSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Main Notifications Page Styles */
    .notifications-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }

    .notifications-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
    }

    .notifications-header h1 {
        color: var(--text-primary);
        font-size: 1.75rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .notifications-header h1 i {
        color: var(--primary);
        font-size: 1.5rem;
    }

    .notifications-content {
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }

    .notification-card {
        display: flex;
        padding: 1.5rem;
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s var(--transition);
        position: relative;
        overflow: hidden;
    }

    .notification-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: var(--primary);
        transform: scaleY(0);
        transition: transform 0.3s var(--transition);
    }

    .notification-card:hover::before {
        transform: scaleY(1);
    }

    .notification-card:hover {
        background-color: var(--primary-lighter);
        transform: translateX(4px);
    }

    .notification-card.unread {
        background: linear-gradient(to right, var(--primary-light), var(--white));
        border-left: 4px solid var(--primary);
    }


    .notification-card:hover .notification-icon {
        transform: scale(1.1) rotate(5deg);
    }



    .notification-body {
        flex-grow: 1;
    }

    .notification-message {
        color: var(--text-primary);
        font-size: 1.05rem;
        line-height: 1.6;
        margin-bottom: 0.75rem;
    }

    .unread .notification-message {
        font-weight: 600;
    }

    .notification-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.9rem;
    }

    .notification-time {
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
    }

    .notification-time i {
        color: var(--primary);
    }

    .mark-read-btn {
        background: linear-gradient(45deg, var(--primary), var(--primary-dark));
        color: var(--white);
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s var(--transition);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .mark-read-btn i {
        font-size: 0.8rem;
    }

    .mark-read-btn:hover {
        background: linear-gradient(45deg, var(--primary-dark), var(--primary));
        color: var(--white);
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(177, 12, 67, 0.3);
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem 2rem;
        color: var(--text-secondary);
        background: linear-gradient(135deg, var(--white), var(--primary-lighter));
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        color: var(--primary);
        opacity: 0.5;
    }

    .empty-state p {
        font-size: 1.2rem;
        margin: 0;
        text-align: center;
        max-width: 300px;
        line-height: 1.6;
    }

    /* Animaciones */
    @keyframes notificationPulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.05);
            opacity: 0.8;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .notification-badge.new {
        animation: notificationPulse 2s infinite;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .notifications-container {
            margin: 1rem auto;
            padding: 0 1rem;
        }

        .notification-card {
            padding: 1.25rem;
            flex-direction: column;
        }

        .notification-icon {
            margin-bottom: 1rem;
        }

        .notification-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .mark-read-btn {
            width: 100%;
            justify-content: center;
        }
    }

    /* Estilos para el botón de ver */
    .notification-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .view-btn {
        background-color: var(--text-primary);
        color: var(--white);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.2s var(--transition);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .view-btn i {
        font-size: 0.8rem;
    }

    .view-btn:hover {
        background-color: var(--text-secondary);
        color: var(--white);
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Ajuste del layout para los botones */
    .notification-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .notification-actions {
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }

        .view-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
