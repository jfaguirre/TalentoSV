    <?php

require_once __DIR__ . '/../../vendor/autoload.php';
use App\controller\OfertaController;
use App\models\Empresa;

    $departamentos = OfertaController::mostrarDepartamentos();

    ?>
    <!-- ===== OVERLAY ===== -->
    <div class="overlay" id="overlay"></div>

    <!-- ===== HEADER MOBILE ===== -->
    <header class="header">
        <button class="header__menu-btn" id="menuBtn" aria-label="Abrir menú">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="header__logo">Talento<span>ES</span></div>
        <div class="header__avatar" id="headerAvatar">JD</div>
    </header>

    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar" id="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar__header">
            <div class="sidebar__avatar">J</div>
            <div class="sidebar__user-info">
                <div class="sidebar__user-name">Juan </div>
                <div class="sidebar__user-role">Usuario Premium</div>
            </div>
        </div>

        <!-- Sidebar Nav -->
        <nav class="sidebar__nav">
            <div class="sidebar__nav-label">Principal</div>

            <a href="#" class="sidebar__nav-item active" data-page="inicio">
                <svg class="sidebar__nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Inicio
            </a>

            <a href="#" class="sidebar__nav-item" data-page="perfil">
                <svg class="sidebar__nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Perfil
            </a>
             

            <a href="index.php?pagina=curriculum" class="sidebar__nav-item" data-page="curriculum">
                <svg class="sidebar__nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="3" width="20" height="18" rx="2"/>
                    <line x1="8" y1="3" x2="8" y2="21"/>
                    <line x1="2" y1="9" x2="22" y2="9"/>
                    <line x1="12" y1="13" x2="18" y2="13"/>
                    <line x1="12" y1="17" x2="16" y2="17"/>
                </svg>
                Curriculum
            </a>
                                
            <div class="sidebar__nav-label">Sistema</div>

            <a href="#" class="sidebar__nav-item" data-page="configuraciones">
                <svg class="sidebar__nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                </svg>
                Configuraciones
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <!-- <div class="sidebar__footer">
            <button class="sidebar__logout">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Cerrar sesión
            </button>
        </div> -->

        <!-- Cambiar a modo empresa o crear empresa -->
        <?php
        $id_usuario = $_SESSION['userAuth']['id'] ?? null;
        
        $empresa = $id_usuario ? \App\models\Empresa::obtenerPorUsuario($id_usuario) : null;
        if ($empresa):
        ?>
            <li><a class="inactivo" href="index.php?cambiar_modo=empresa" style="background-color: rgba(79, 70, 229, 0.1); color: #4f46e5; border-radius: 6px; padding: 4px 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"><i class="fa-solid fa-building"></i> Modo Empresa</a></li>
        <?php else: ?>
            <li><a class="inactivo" href="index.php?pagina=registrar_empresa" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981; border-radius: 6px; padding: 4px 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"><i class="fa-solid fa-circle-plus"></i> Registrar mi empresa</a></li>
        <?php endif; ?>

        <!-- Salir -->
      <?php if(($_GET['pagina'] ?? '') == 'salir'): ?>
            <li><a class="activo" href="index.php?pagina=salir">Salir</a></li>
        <?php else: ?>
            <li><a class="inactivo" href="index.php?pagina=salir">Salir</a></li>
        <?php endif ?>

    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="main" id="mainContent">
        <div class="main__welcome">
         <h1>Hola,<span>
        <?php echo htmlspecialchars($usuario['nombre'] ?? 'Usuario'); ?>
        </span> 👋
        </h1>
            <p>Bienvenido a tu panel de control. Aquí tienes un resumen de tu actividad.</p>
        </div>

<div class="cards-grid">

<?php foreach($departamentos as $departamento): ?>

    <a class="card" href="views/usuarios/ofertas.php?id_departamento=<?php echo $departamento['id_departamento']; ?>">
 
        <div class="card__header">

        </div>

        <div class="card__title">
    <span class="card__location-icon">📍</span>
    <?php echo htmlspecialchars($departamento['departamento']); ?>
</div>

        <div class="card__trend card__trend--up">
            <?php echo $departamento['total_ofertas']; ?> ofertas de trabajo
        </div>

    </a>

<?php endforeach; ?>

</div>
        </div>
    </main>

    <!-- ===== JAVASCRIPT ===== -->
    <script>
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const navItems = document.querySelectorAll('.sidebar__nav-item');

        // --- Toggle sidebar ---
        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            menuBtn.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
        }

        function closeSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            menuBtn.classList.remove('active');
            document.body.style.overflow = '';
        }

        menuBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', closeSidebar);

        // --- Nav items active state ---
        navItems.forEach(item => {
            item.addEventListener('click', (e) => {                
                // Remove active from all
                navItems.forEach(n => n.classList.remove('active'));
                // Add active to clicked
                item.classList.add('active');

                // Close sidebar on mobile
                if (window.innerWidth < 768) {
                    closeSidebar();
                }

                // TODO: Aquí puedes navegar a cada página
                const page = item.getAttribute('data-page');
                console.log('Navegar a:', page);
            });
        });

        // --- Close sidebar on resize to desktop ---
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.add('active');
                overlay.classList.remove('active');
                menuBtn.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // --- Keyboard: Escape to close ---
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                closeSidebar();
            }
        });
    </script>
