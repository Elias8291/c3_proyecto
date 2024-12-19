
<style>

:root {
    --primary: #b10c43;
    --text-primary: #2d3748;
    --bg-hover: rgba(177, 12, 67, 0.05);
    --border-color: rgba(0, 0, 0, 0.08);
    --transition: cubic-bezier(0.4, 0, 0.2, 1);
}

.notification-icon {
    position: relative;
    padding: 0.75em 1.25em;
    color: white;
    transition: all 0.2s var(--transition);
    cursor: pointer;
}

.notification-icon:hover {
    transform: translateY(-2px);
}

.notification-bell {
    font-size: 1.5rem;
    color: white;
}

.notification-badge {
    position: absolute;
    top: 6px;
    right: 12px;
    background-color: var(--primary);
    color: white;
    border-radius: 6px;
    min-width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0 6px;
}

.notifications-dropdown {
    width: 400px;
    border: 1px solid var(--border-color);
    background: white;
    box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
    margin-top: 15px;
    border-radius: 4px;
    overflow: hidden;
}

.dropdown-header {
    background: var(--primary);
    color: white;
    font-weight: 500;
    padding: 16px 24px;
    font-size: 1.1rem;
    letter-spacing: 0.3px;
}

.notifications-list {
    max-height: 480px;
    overflow-y: auto;
}

.notifications-list::-webkit-scrollbar {
    width: 4px;
}

.notifications-list::-webkit-scrollbar-thumb {
    background-color: rgba(177, 12, 67, 0.2);
    border-radius: 2px;
}

.notifications-list .dropdown-item {
    padding: 16px 24px;
    border-bottom: 1px solid var(--border-color);
    color: var(--text-primary);
    transition: all 0.2s var(--transition);
    display: flex;
    flex-direction: column;
    gap: 6px;
    text-decoration: none;
}

.notifications-list .dropdown-item:hover {
    background-color: var(--bg-hover);
}

.notifications-list .dropdown-item i {
    font-size: 1.1rem;
    margin-right: 12px;
    color: var(--primary);
}

.notifications-list .dropdown-item small {
    color: #666;
    font-size: 0.85rem;
    display: block;
    margin-top: 4px;
}

.notifications-list .dropdown-item.unread {
    background-color: var(--bg-hover);
    border-left: 3px solid var(--primary);
}

.notifications-list .dropdown-item .notification-content {
    font-size: 0.95rem;
    line-height: 1.5;
    color: var(--text-primary);
}

.dropdown-footer {
    padding: 16px 24px;
    background: #f8f9fa;
    border-top: 1px solid var(--border-color);
    text-align: center;
}

.dropdown-footer a {
    color: var(--primary);
    font-size: 0.95rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s var(--transition);
    padding: 6px 12px;
    border-radius: 4px;
}

.dropdown-footer a:hover {
    background-color: var(--bg-hover);
    color: var(--primary);
}

@keyframes notificationPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.notification-badge.new {
    animation: notificationPulse 2s infinite;
}

.notifications-list .text-center {
    padding: 24px;
    color: #666;
    font-size: 0.95rem;
}
</style>

<form class="form-inline mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        <li>
            <a href="#" id="menu-toggle" data-toggle="sidebar" class="nav-link nav-link-lg toggle-sidebar">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>    
</form>

<!-- Barra de navegación -->
<ul class="navbar-nav navbar-right">
    @if (auth()->check())
    <li class="nav-item dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle notification-icon">
            <i class="fas fa-bell notification-bell"></i>
            @if ($notificacionesNoLeidas > 0)
                <span class="notification-badge new">{{ $notificacionesNoLeidas }}</span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right notifications-dropdown">
            <h6 class="dropdown-header">Notificaciones</h6>
            <div class="notifications-list">
                @forelse ($notificaciones as $notificacion)
                    <a href="#" class="dropdown-item {{ $notificacion->leida ? '' : 'unread' }}">
                        <i class="fas fa-envelope"></i>
                        {{ $notificacion->mensaje }}
                        <small class="text-muted d-block">{{ $notificacion->created_at->diffForHumans() }}</small>
                    </a>
                @empty
                    <p class="dropdown-item text-center">No tienes notificaciones</p>
                @endforelse
            </div>
            <div class="dropdown-footer text-center">
                <a href="{{ route('notificaciones.index') }}">Ver todas las notificaciones</a>
            </div>
        </div>
    </li>
@endif

    <!-- Menú de Usuario -->
    <li class="nav-item dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-user">
            <div class="d-sm-none d-lg-inline-block">
                ¡Hola!, {{ \Illuminate\Support\Facades\Auth::user()->name }} 
              
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">
                Bienvenido, {{ \Illuminate\Support\Facades\Auth::user()->name }}
            </div>
          
            <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); localStorage.clear(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                {{ csrf_field() }}
            </form>
        </div>
    </li>
  
    
</ul>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.querySelector('#menu-toggle'); // Botón de las tres barras
        const sideMenu = document.querySelector('.side-menu'); // Contenedor de la barra lateral

        toggleButton.addEventListener('click', function (e) {
            e.preventDefault(); // Evita el comportamiento predeterminado del enlace
            sideMenu.classList.toggle('side-menu-icon-only');
        });
    });
</script>