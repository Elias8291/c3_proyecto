<style>
<style>
.navbar-nav {
    display: flex;
    align-items: center;
    list-style: none;
}

.navbar-nav .nav-link:hover,
.navbar-nav .dropdown-item:hover {
    background-color: #ffffff !important;
    color: #000000 !important;
}
.notification-icon {
    position: relative;
    padding: 0.5em 1em;
    color: #ffffff;
    transition: transform 0.3s ease, color 0.3s ease;
    cursor: pointer;
}

/* Efecto hover para la notificación con borde */
.notification-icon:hover {
    transform: translateY(-3px);
    color: #ffd700; /* Color dorado al pasar el cursor */
    border: 2px solid #A52A2A; /* Borde color guinda */
    border-radius: 5px; /* Opcional: redondear esquinas del borde */
}

.notification-bell {
    font-size: 1.5rem;
    animation: bell-swing 1.5s infinite;
    transform-origin: top;
}

.notification-badge {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: #e74c3c;
    color: #ffffff;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    font-weight: bold;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.notification-badge.new {
    background-color: #c0392b;
    transform: scale(1.1);
}

/* Agregar borde al cuadro de notificaciones */
.notifications-dropdown {
    width: 320px;
    padding: 0;
    border: 2px solid #A52A2A; /* Borde color guinda */
    border-radius: 8px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
    margin-top: 15px;
}

/* Opcional: Cambiar el borde al pasar el cursor sobre el ícono de notificaciones */
.notification-icon:hover + .dropdown-menu {
    border-color: #800000; /* Color guinda más oscuro al hacer hover */
}


.notifications-dropdown::before {
    content: '';
    position: absolute;
    top: -8px;
    right: 20px;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-bottom: 8px solid white;
}

.dropdown-header {
    background: #f8f9fa;
    color: #2d3748;
    font-weight: 600;
    padding: 15px 20px;
    border-bottom: 1px solid #edf2f7;
    border-radius: 8px 8px 0 0;
}

.notifications-list {
    max-height: 360px;
    overflow-y: auto;
}

.notifications-list::-webkit-scrollbar {
    width: 6px;
}

.notifications-list::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.notifications-list::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 3px;
}

.notifications-list .dropdown-item {
    padding: 12px 20px;
    border-bottom: 1px solid #edf2f7;
    color: #4a5568;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
}

.notifications-list .dropdown-item:last-child {
    border-bottom: none;
}

.notifications-list .dropdown-item:hover {
    background-color: #f7fafc;
    color: #2d3748;
}

.notifications-list .dropdown-item i {
    font-size: 1rem;
    margin-right: 12px;
    color: #000407;
    width: 20px;
    text-align: center;
}

.dropdown-footer {
    padding: 12px;
    background: #f8f9fa;
    border-top: 1px solid #edf2f7;
    border-radius: 0 0 8px 8px;
}

.dropdown-footer a {
    color: #4299e1;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.2s ease;
}

.dropdown-footer a:hover {
    color: #2b6cb0;
    text-decoration: underline;
}

/* Estilos para notificaciones no leídas */
.notifications-list .dropdown-item.unread {
    background-color: #ebf8ff;
}

.notifications-list .dropdown-item.unread:hover {
    background-color: #e6f6ff;
}

/* Animación de entrada para el dropdown */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.notifications-dropdown.show {
    animation: slideIn 0.2s ease-out forwards;
}

@keyframes bell-swing {
    0% { transform: rotate(0deg); }
    25% { transform: rotate(15deg); }
    50% { transform: rotate(-15deg); }
    75% { transform: rotate(10deg); }
    100% { transform: rotate(0deg); }
}
</style>

</style>
<form class="form-inline mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        
    </ul>
</form>

<!-- Barra de navegación -->
<ul class="navbar-nav navbar-right">
 
    <li class="nav-item dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle notification-icon">
           
        </a>
        <div class="dropdown-menu dropdown-menu-right notifications-dropdown">
            <h6 class="dropdown-header">Notificaciones</h6>
           
            <div class="dropdown-footer text-center">
                <a href="{{ route('notificaciones.index') }}">Ver todas las notificaciones</a>
            </div>
        </div>
    </li>
    
    
    

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
