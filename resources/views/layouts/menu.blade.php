@if(auth()->user()->canAny(['ver-rol', 'ver-usuario', 'ver-log']))
<style>
    :root {
        --primary-color: #000000;
        --secondary-color: #b10c43;
        --background-color: #f9f9f9;
        --hover-color: #ffffff;
        --text-color: #333333;
        --shadow-color: rgba(0, 0, 0, 0.1);
    }

    .side-menu {
        padding: 0;
        list-style-type: none;
        max-width: 300px;
        margin: 20px auto;
    }

    .side-menu-item {
        margin-bottom: 25px;
        perspective: 1000px;
    }

    .side-menu-link {
        display: flex;
        align-items: center;
        padding: 18px 25px;
        border-radius: 15px;
        background: var(--background-color);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 5px 15px var(--shadow-color);
        text-decoration: none;
        overflow: hidden;
        position: relative;
    }

    .side-menu-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 1;
    }

    .side-menu-link:hover::before,
    .side-menu-link.active::before {
        opacity: 0.1;
    }

    .side-menu-link:hover,
    .side-menu-link.active {
        background: var(--hover-color);
        transform: translateY(-5px) rotateX(5deg);
        box-shadow: 0 15px 30px var(--shadow-color);
    }

    .side-menu-icon {
        color: var(--primary-color);
        margin-right: 20px;
        font-size: 28px;
        transition: all 0.4s ease;
        position: relative;
        z-index: 2;
    }

    .side-menu-text {
        font-weight: 700;
        color: var(--text-color);
        letter-spacing: 0.5px;
        font-family: 'Lato', sans-serif;
        font-size: 18px;
        transition: all 0.4s ease;
        position: relative;
        z-index: 2;
    }

    .side-menu-link:hover .side-menu-icon,
    .side-menu-link.active .side-menu-icon {
        color: var(--secondary-color);
        transform: scale(1.2) rotate(5deg);
    }

    .side-menu-link:hover .side-menu-text,
    .side-menu-link.active .side-menu-text {
        color: var(--primary-color);
        transform: translateX(5px);
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .side-menu-link:hover,
    .side-menu-link.active {
        animation: pulse 2s infinite;
    }
</style>

<ul class="side-menu">
    <li style="height: 50px; background-color: transparent;"></li>
    
    @can('ver-dashboard')
    <li class="side-menu-item">
        <a href="/home" class="side-menu-link {{ Request::is('home*') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt side-menu-icon"></i>
            <span class="side-menu-text">Dashboard</span>
        </a>
    </li>
    @endcan
    
    @can('ver-usuario')
    <li class="side-menu-item">
        <a href="/usuarios" class="side-menu-link {{ Request::is('usuarios*') ? 'active' : '' }}">
            <i class="fas fa-users side-menu-icon"></i>
            <span class="side-menu-text">Usuarios</span>
        </a>
    </li>
    @endcan
    
    @can('ver-rol')
    <li class="side-menu-item">
        <a href="/roles" class="side-menu-link {{ Request::is('roles*') ? 'active' : '' }}">
            <i class="fas fa-user-shield side-menu-icon"></i>
            <span class="side-menu-text">Roles</span>
        </a>
    </li>
    @endcan
    
    <li class="side-menu-item">
        <a href="/evaluados" class="side-menu-link {{ Request::is('evaluados*') ? 'active' : '' }}">
            <i class="fas fa-clipboard-check side-menu-icon"></i>
            <span class="side-menu-text">Evaluados</span>
        </a>
    </li>
    
    {{-- Uncomment if needed
    @can('ver-log')
    <li class="side-menu-item">
        <a href="/logs" class="side-menu-link {{ Request::is('logs*') ? 'active' : '' }}">
            <i class="fas fa-history side-menu-icon"></i>
            <span class="side-menu-text">Logs</span>
        </a>
    </li>
    @endcan
    --}}
</ul>
@endif