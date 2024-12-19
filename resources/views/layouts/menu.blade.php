
<style>
  :root {
    --primary-color: #000000;
    --secondary-color: #b10c43;
    --hover-color: rgba(177, 12, 67, 0.05);
    --text-color: #2d3748;
    --shadow-color: rgba(0, 0, 0, 0.1);
    --menu-width: 280px;
    --transition-timing: cubic-bezier(0.4, 0, 0.2, 1);
}

.side-menu {
    padding: 0.75rem;
    list-style-type: none;
    max-width: var(--menu-width);
    margin: 20px auto;
    background: transparent;
    border-right: 1px solid rgba(0, 0, 0, 0.05);
}

.side-menu-item {
    margin: 6px 0;
    transform-style: preserve-3d;
}

.side-menu-link {
    display: flex;
    align-items: center;
    padding: 14px 18px;
    background: transparent;
    transition: all 0.2s var(--transition-timing);
    text-decoration: none;
    position: relative;
    border-left: 3px solid transparent;
}

.side-menu-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        to right,
        var(--hover-color),
        transparent
    );
    opacity: 0;
    transition: opacity 0.2s var(--transition-timing);
}

.side-menu-link:hover::before,
.side-menu-link.active::before {
    opacity: 1;
}

.side-menu-link:hover,
.side-menu-link.active {
    border-left: 3px solid var(--secondary-color);
    background: var(--hover-color);
}

.side-menu-icon {
    color: var(--text-color);
    margin-right: 18px;
    font-size: 20px;
    transition: all 0.2s var(--transition-timing);
    position: relative;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.side-menu-text {
    font-weight: 500;
    color: var(--text-color);
    letter-spacing: 0.2px;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    font-size: 16px;
    transition: all 0.2s var(--transition-timing);
    line-height: 1.4;
}

.side-menu-link:hover .side-menu-icon,
.side-menu-link.active .side-menu-icon {
    color: var(--secondary-color);
    transform: translateX(2px);
}

.side-menu-link:hover .side-menu-text,
.side-menu-link.active .side-menu-text {
    color: var(--secondary-color);
    transform: translateX(2px);
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-8px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.side-menu-item {
    animation: slideIn 0.3s var(--transition-timing) forwards;
    animation-delay: calc(var(--item-index) * 0.05s);
    opacity: 0;
}

.side-menu-link.active {
    background: var(--hover-color);
    font-weight: 600;
}

.side-menu-icon-only .side-menu {
    max-width: 64px;
    padding: 0.75rem 0.5rem;
}

.side-menu-icon-only .side-menu-text {
    display: none;
}

.side-menu-icon-only .side-menu-link {
    justify-content: center;
    padding: 14px;
}

.side-menu-icon-only .side-menu-icon {
    margin-right: 0;
    font-size: 22px;
}

</style>

<ul class="side-menu" style="background: transparent">
    <li style="height: 20px; background-color: transparent;"></li>

    @can('ver-dashboard')
    <li class="side-menu-item" style="--item-index: 1">
        <a href="/home" class="side-menu-link {{ Request::is('home*') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt side-menu-icon"></i>
            <span class="side-menu-text">Dashboard</span>
        </a>
    </li>
    @endcan
    
    <li class="side-menu-item" style="--item-index: 9">
        <a href="{{ route('usuarios.profile') }}" class="side-menu-link {{ Request::is('profile*') ? 'active' : '' }}">
            <i class="fas fa-user side-menu-icon"></i>
            <span class="side-menu-text">Mi perfil</span>
        </a>
    </li>

    @can('ver-usuarios')
    <li class="side-menu-item" style="--item-index: 2">
        <a href="/usuarios" class="side-menu-link {{ Request::is('usuarios*') ? 'active' : '' }}">
            <i class="fas fa-users side-menu-icon"></i>
            <span class="side-menu-text">Usuarios</span>
        </a>
    </li>
    @endcan
    
    @can('ver-roles')
    <li class="side-menu-item" style="--item-index: 3">
        <a href="/roles" class="side-menu-link {{ Request::is('roles*') ? 'active' : '' }}">
            <i class="fas fa-user-shield side-menu-icon"></i>
            <span class="side-menu-text">Roles</span>
        </a>
    </li>
    @endcan
    
    @can('ver-evaluados')
    <li class="side-menu-item" style="--item-index: 4">
        <a href="/evaluados" class="side-menu-link {{ Request::is('evaluados*') ? 'active' : '' }}">
            <i class="fas fa-clipboard-check side-menu-icon"></i>
            <span class="side-menu-text">Evaluados</span>
        </a>
    </li>
    @endcan

    @can('ver-carpetas')
    <li class="side-menu-item" style="--item-index: 5">
        <a href="/carpetas" class="side-menu-link {{ Request::is('carpetas*') ? 'active' : '' }}">
            <i class="fas fa-folder side-menu-icon"></i>
            <span class="side-menu-text">Carpetas</span>
        </a>
    </li>
    @endcan
    
    @can('ver-cajas')
    <li class="side-menu-item" style="--item-index: 6">
        <a href="/cajas" class="side-menu-link {{ Request::is('cajas*') ? 'active' : '' }}">
            <i class="fas fa-box side-menu-icon"></i>
            <span class="side-menu-text">Cajas</span>
        </a>
    </li>
    @endcan

   
  
    <li class="side-menu-item" style="--item-index: 8">
        <a href="/prestamos" class="side-menu-link {{ Request::is('prestamos*') && !Request::is('mis-documentos*') ? 'active' : '' }}">
            <i class="fas fa-box side-menu-icon"></i>
            <span class="side-menu-text">Lista Préstamos</span>
        </a>
    </li>
    
    <li class="side-menu-item" style="--item-index: 9">
        <a href="/mis-documentos" class="side-menu-link {{ Request::is('mis-documentos*') ? 'active' : '' }}">
            <i class="fas fa-box side-menu-icon"></i>
            <span class="side-menu-text">Mis préstamos</span>
        </a>
    </li>

    @can('ver-logs')
    <li class="side-menu-item" style="--item-index: 7">
        <a href="/logs" class="side-menu-link {{ Request::is('logs*') ? 'active' : '' }}">
            <i class="fas fa-history side-menu-icon"></i>
            <span class="side-menu-text">Logs</span>
        </a>
    </li>
    @endcan

    <li class="side-menu-item" style="--item-index: 9">
        <a href="/notificaciones" class="side-menu-link {{ Request::is('notificaciones*') ? 'active' : '' }}">
            <i class="fas fa-box side-menu-icon"></i>
            <span class="side-menu-text">Mis notificaciones</span>
        </a>
    </li>

</ul>

