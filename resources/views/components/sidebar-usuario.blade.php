<!-- Sidebar Nav -->
<nav class="sidebar__nav">
    <div class="sidebar__nav-label">Principal</div>

    <a href="{{ route('dashboard') }}" class="sidebar__nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-door-fill sidebar__nav-icon"></i>
        Inicio
    </a>

    <a href="#" class="sidebar__nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
        <i class="bi bi-person-fill sidebar__nav-icon"></i>
        Perfil
    </a>

    <a href="#" class="sidebar__nav-item {{ request()->routeIs('curriculum.*') ? 'active' : '' }}">
        <i class="bi bi-card-checklist sidebar__nav-icon"></i>
        Curriculum
    </a>

    <a href="#" class="sidebar__nav-item {{ request()->routeIs('postulaciones.*') ? 'active' : '' }}">
        <i class="bi bi-briefcase-fill sidebar__nav-icon"></i>
        Mis Postulaciones
    </a>

    <div class="sidebar__nav-label">Sistema</div>

    <a href="#" class="sidebar__nav-item {{ request()->routeIs('configuraciones.*') ? 'active' : '' }}">
        <i class="bi bi-gear-fill sidebar__nav-icon"></i>
        Configuraciones
    </a>

    <a href="#" class="sidebar__nav-item {{ request()->routeIs('empresa.*') ? 'active' : '' }}">
        <i class="bi bi-building-fill sidebar__nav-icon"></i>
        Registrar empresa
    </a>
</nav>
