<nav class="sidebar">
    <div class="sidebar-header">
        <a href="index.php?pagina=inicio" class="sidebar-brand">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="20" height="14" rx="2"/>
                <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
            </svg>
            <span>Talento<span>ES</span></span>
        </a>
        <button class="menu-toggle" id="btn-menu-toggle" aria-label="Abrir menú" onclick="toggleMobileMenu()">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
    
    <div class="sidebar-nav" id="sidebar-nav-container">
        <ul class="nav-list">
            <li>
                <a href="index.php?pagina=inicio" class="nav-link <?= (!isset($_GET['pagina']) || $_GET['pagina'] === 'inicio') ? 'active' : '' ?>">
                    <i class="fa-solid fa-chart-simple"></i>
                    Inicio
                </a>
            </li>
            <li>
                <a href="index.php?pagina=perfil" class="nav-link <?= (isset($_GET['pagina']) && $_GET['pagina'] === 'perfil') ? 'active' : '' ?>">
                    <i class="fa-solid fa-building"></i>
                    Perfil Empresa
                </a>
            </li>
            <li>
                <a href="index.php?pagina=ofertas" class="nav-link <?= (isset($_GET['pagina']) && $_GET['pagina'] === 'ofertas') ? 'active' : '' ?>">
                    <i class="fa-solid fa-briefcase"></i>
                    Mis Ofertas
                </a>
            </li>
            <li>
                <a href="index.php?pagina=configuracion" class="nav-link <?= (isset($_GET['pagina']) && $_GET['pagina'] === 'configuracion') ? 'active' : '' ?>">
                    <i class="fa-solid fa-user-gear"></i>
                    Ajustes Cuenta
                </a>
            </li>
            
            <!-- Cambiar Modo -->
            <li>
                <a href="index.php?cambiar_modo=usuario" class="nav-link nav-link-mode">
                    <i class="fa-solid fa-user-tie"></i>
                    Modo Candidato
                </a>
            </li>
            
            <!-- Salir -->
            <li>
                <a href="index.php?pagina=salir" class="nav-link nav-link-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Cerrar Sesión
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const nav = document.getElementById('sidebar-nav-container');
    const btn = document.getElementById('btn-menu-toggle');
    nav.classList.toggle('active');
    if (nav.classList.contains('active')) {
        btn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
    } else {
        btn.innerHTML = '<i class="fa-solid fa-bars"></i>';
    }
}
</script>
