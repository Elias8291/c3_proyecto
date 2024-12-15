
<style>
:root {
    --primary: #9B6B8F;
    --text-primary: #2C272E;
    --bg-hover: #F7F4F8;
    --border-color: #E8E5EA;
}

.notification-icon {
    position: relative;
    padding: 0.75em 1.25em;
    color: var(--primary);
    transition: transform 0.2s ease;
    cursor: pointer;
}

.notification-icon:hover {
    transform: translateY(-2px);
}

.notification-bell {
    font-size: 1.75rem;
}

.notification-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    background-color: var(--primary);
    color: white;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 600;
}

.notifications-dropdown {
    width: 550px; /* Aumentado de 400px */
    border: 1px solid var(--border-color);
    border-radius: 12px;
    background: white;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin-top: 15px;
}

.dropdown-header {
    background: white;
    color: var(--text-primary);
    font-weight: 600;
    padding: 22px 30px; /* Aumentado el padding */
    border-bottom: 1px solid var(--border-color);
    font-size: 1.1rem;
}

.notifications-list {
    max-height: 520px; /* Aumentada la altura máxima */
    overflow-y: auto;
}

.notifications-list::-webkit-scrollbar {
    width: 6px;
}

.notifications-list::-webkit-scrollbar-thumb {
    background-color: var(--border-color);
    border-radius: 3px;
}

.notifications-list .dropdown-item {
    padding: 20px 30px; /* Aumentado el padding */
    border-bottom: 1px solid var(--border-color);
    color: var(--text-primary);
    transition: background-color 0.2s ease;
    display: flex;
    flex-direction: column;
    gap: 8px; /* Aumentado el espacio entre elementos */
}

.notifications-list .dropdown-item:hover {
    background-color: var(--bg-hover);
}

.notifications-list .dropdown-item i {
    font-size: 1.2rem;
    margin-right: 15px;
    color: var(--primary);
}

.notifications-list .dropdown-item small {
    color: #777;
    font-size: 0.9rem; /* Aumentado ligeramente */
}

.notifications-list .dropdown-item.unread {
    background-color: var(--bg-hover);
    border-left: 3px solid var(--primary);
}

.notifications-list .dropdown-item .notification-content {
    font-size: 1rem; /* Tamaño de fuente explícito para el contenido */
    line-height: 1.5;
}

.dropdown-footer {
    padding: 20px 30px; /* Aumentado el padding */
    background: white;
    border-top: 1px solid var(--border-color);
    text-align: center;
}

.dropdown-footer a {
    color: var(--primary);
    font-size: 1rem;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.2s ease;
    padding: 8px 16px; /* Añadido padding para área de clic más grande */
}

.dropdown-footer a:hover {
    color: var(--text-primary);
}
</style>

<form class="form-inline mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        
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
            <a class="dropdown-item has-icon edit-profile" data-toggle="modal" data-target="#EditProfileModal" href="#" data-id="{{ \Auth::id() }}">
                <i class="fa fa-user"></i> Editar Perfil de Usuario
            </a>
            <a class="dropdown-item has-icon" data-toggle="modal" data-target="#changePasswordModal" href="#" data-id="{{ \Auth::id() }}">
                <i class="fa fa-lock"></i> Cambiar Password
            </a>
            <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); localStorage.clear(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                {{ csrf_field() }}
            </form>
        </div>
    </li>
  
    
</ul>
