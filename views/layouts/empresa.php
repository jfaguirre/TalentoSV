<?php
$base_path = (strpos($_SERVER['SCRIPT_NAME'], 'views/') !== false) ? '../../' : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empresa — TalentoES</title>    

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>node_modules/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Estilos -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/dashboard_empresa.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/side_bar.css">    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="<?php echo $base_path; ?>assets/js/sweetalert2.all.min.js"></script>
</head>
<body>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- header para mobile -->
    <header class="header">
        <button class="header__menu-btn" id="menuBtn" aria-label="Abrir menú">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="header__logo">Talento<span>ES</span></div>            
        <div class="header__avatar" id="headerAvatar">
            <?php 
                $nombreEmp = $_SESSION['userAuth']['nombre'] ?? 'E';
                echo htmlspecialchars(strtoupper(substr($nombreEmp, 0, 2))); 
            ?>
        </div>
    </header>

    <!-- Side bar -->
    <?php include 'views/componentes/side-bar-empresa.php'; ?>

    <!-- Contenido Principal -->
    <main class="main-content">
        <?php             
            // Páginas permitidas
            $paginasPermitidas = 
            [
                'inicio',
                'perfil',
                'ofertas',
                'configuracion',
                'ver_cv'
            ];                        
            
            $pagina = $_GET['pagina'] ?? 'inicio';                       
                        
            if (in_array($pagina, $paginasPermitidas, true)) {
                include "views/empresas/{$pagina}.php";
            } else {
                include 'views/paginas/error404.php';
            }            
        ?>
    </main>

    <!-- Sidebar Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuBtn = document.getElementById('menuBtn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            if (menuBtn && sidebar && overlay) {
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

                // Cerrar con tecla Escape
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                        closeSidebar();
                    }
                });

                // Cerrar al redimensionar a versión de escritorio
                window.addEventListener('resize', () => {
                    if (window.innerWidth >= 768) {
                        closeSidebar();
                    }
                });
            }
        });
    </script>
</body>
</html>
