<?php
$pagina = $_GET['pagina'] ?? 'inicio';

$id_usuario = $_SESSION['userAuth']['id'] ?? null;       
$empresa = $id_usuario ? \App\models\Empresa::obtenerPorUsuario($id_usuario) : null;

?>
<!-- ===== SIDEBAR ===== -->
<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar__header">
        <div class="sidebar__avatar">
            <?php 
                $nombreUser = $_SESSION['userAuth']['nombre'] ?? 'U';
                echo htmlspecialchars(strtoupper(substr($nombreUser, 0, 1))); 
            ?>
        </div>
        <div class="sidebar__user-info">
            <div class="sidebar__user-name"><?php echo htmlspecialchars($_SESSION['userAuth']['nombre'] ?? 'Usuario'); ?></div>
            <div class="sidebar__user-role"><?php echo htmlspecialchars($_SESSION['userAuth']['rol'] ?? 'Usuario'); ?></div>
        </div>
    </div>

    <!-- Sidebar Nav -->
    <nav class="sidebar__nav">
            <div class="sidebar__nav-label">Principal</div>

            <a href="index.php?pagina=inicio" class="sidebar__nav-item <?php echo $pagina === 'inicio' ? 'active' : ''; ?>" data-page="inicio">
                <i class="bi bi-house-fill sidebar__nav-icon"></i>
                Inicio
            </a>

            <a href="index.php?pagina=perfil" class="sidebar__nav-item <?php echo $pagina === 'perfil' ? 'active' : ''; ?>" data-page="perfil">
                <i class="bi bi-person-fill sidebar__nav-icon"></i>
                Perfil
            </a>
             

            <a href="index.php?pagina=curriculum" class="sidebar__nav-item <?php echo $pagina === 'curriculum' ? 'active' : ''; ?>" data-page="curriculum">
                <i class="bi bi-card-checklist sidebar__nav-icon"></i>
                Curriculum
            </a>

            <a href="index.php?pagina=postulaciones" class="sidebar__nav-item <?php echo $pagina === 'postulaciones' ? 'active' : ''; ?>" data-page="postulaciones">
                <i class="bi bi-briefcase-fill sidebar__nav-icon"></i>
                Mis Postulaciones
            </a>
                                
            <div class="sidebar__nav-label">Sistema</div>

            <a href="index.php?pagina=configuraciones" class="sidebar__nav-item <?php echo $pagina === 'configuraciones' ? 'active' : ''; ?>" data-page="configuraciones">
                <i class="bi bi-gear-fill sidebar__nav-icon"></i>
                Configuraciones
            </a>

        <!-- Cambiar a modo empresa o crear empresa -->        
        <?php if ($empresa): ?>
            <a href="index.php?cambiar_modo=empresa" class="sidebar__nav-item" data-page="configuraciones">            
                <i class="bi bi-geo-fill sidebar__nav-icon"></i>
                Modo empresa
            </a>                        
        <?php else: ?>
            <a href="index.php?pagina=registrar_empresa" class="sidebar__nav-item" data-page="configuraciones">
            <i class="bi bi-window-plus sidebar__nav-icon"></i>
                Registrar empresa
            </a>                                    
        <?php endif; ?>   

    </nav>        

        <!-- Sidebar Footer -->
        <div class="sidebar__footer">
            <a href="index.php?pagina=salir" class="sidebar__logout" data-page="configuraciones">
                <i class="bi bi-box-arrow-right sidebar__nav-icon"></i>
                Cerrar sesión
            </a>            
        </div>            

</aside>