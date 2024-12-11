
<style>
    :root {
        --primary-color: #000000;
        --secondary-color: #b10c43;
        --hover-color: rgba(255, 255, 255, 0.05);
        --text-color: #000000;
        --shadow-color: rgba(0, 0, 0, 0.15);
        --menu-width: 280px;
        --transition-timing: cubic-bezier(0.4, 0, 0.2, 1);
    }
    

    .side-menu {
        padding: 0.5rem;
        list-style-type: none;
        max-width: var(--menu-width);
        margin: 20px auto;
        border-radius: 20px;
        background: transparent;
    }

    .side-menu-item {
        margin: 8px 0;
        perspective: 2000px;
        transform-style: preserve-3d;
    }

    .side-menu-link {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        border-radius: 12px;
        background: transparent;
        transition: all 0.3s var(--transition-timing);
        text-decoration: none;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.08);
    }

    .side-menu-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, 
            rgba(177, 12, 67, 0.1) 0%,
            rgba(177, 12, 67, 0.05) 100%);
        opacity: 0;
        transition: opacity 0.3s var(--transition-timing);
        z-index: 1;
    }

    .side-menu-link:hover::before,
    .side-menu-link.active::before {
        opacity: 1;
    }

    .side-menu-link:hover,
    .side-menu-link.active {
        background: var(--hover-color);
        transform: translateY(-2px);
        box-shadow: 
            0 8px 20px rgba(177, 12, 67, 0.1),
            0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .side-menu-icon {
        color: var(--text-color);
        margin-right: 16px;
        font-size: 20px;
        transition: all 0.3s var(--transition-timing);
        position: relative;
        z-index: 2;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .side-menu-text {
        font-weight: 600;
        color: var(--text-color);
        letter-spacing: 0.3px;
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        font-size: 15px;
        transition: all 0.3s var(--transition-timing);
        position: relative;
        z-index: 2;
    }

    .side-menu-link:hover .side-menu-icon,
    .side-menu-link.active .side-menu-icon {
        color: var(--secondary-color);
        transform: scale(1.1);
    }

    .side-menu-link:hover .side-menu-text,
    .side-menu-link.active .side-menu-text {
        color: var(--secondary-color);
        transform: translateX(4px);
    }

    /* Subtle slide-in animation for menu items */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-10px);
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

    /* Active indicator */
    .side-menu-link.active::after {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 60%;
        background: var(--secondary-color);
        border-radius: 0 4px 4px 0;
        z-index: 2;
    }

    /* Hover effect for icons */
    @keyframes iconPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.15); }
        100% { transform: scale(1); }
    }

    .side-menu-link:hover .side-menu-icon {
        animation: iconPulse 0.4s var(--transition-timing);
    }

    /* Subtle hover effect */
    .side-menu-link:hover {
        box-shadow: 
            0 0 15px rgba(177, 12, 67, 0.1),
            0 0 30px rgba(177, 12, 67, 0.05);
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

    @can('ver-logs')
    <li class="side-menu-item" style="--item-index: 7">
        <a href="/logs" class="side-menu-link {{ Request::is('logs*') ? 'active' : '' }}">
            <i class="fas fa-history side-menu-icon"></i>
            <span class="side-menu-text">Logs</span>
        </a>
    </li>
    @endcan

  
    <li class="side-menu-item" style="--item-index: 6">
        <a href="/prestamos" class="side-menu-link {{ Request::is('prestamos*') ? 'active' : '' }}">
            <i class="fas fa-box side-menu-icon"></i>
            <span class="side-menu-text">Prestamos</span>
        </a>
    </li>

    

</ul>

