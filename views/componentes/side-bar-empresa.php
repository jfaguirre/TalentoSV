<?php
$pagina = $_GET['pagina'] ?? 'inicio';

$id_usuario = $_SESSION['userAuth']['id'] ?? null;       
$empresa = $id_usuario ? \App\models\Empresa::obtenerPorUsuario($id_usuario) : null;
$nombre_empresa = $empresa['nombre'] ?? $_SESSION['userAuth']['nombre'] ?? 'Empresa';
$inicial = strtoupper(substr($nombre_empresa, 0, 1));
?>
<!-- ===== SIDEBAR ===== -->
<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar__header">
        <div class="sidebar__avatar"><?php echo htmlspecialchars($inicial); ?></div>
        <div class="sidebar__user-info">
            <div class="sidebar__user-name"><?php echo htmlspecialchars($nombre_empresa); ?></div>
            <div class="sidebar__user-role">Modo Empresa</div>
        </div>
    </div>

    <!-- Sidebar Nav -->
    <nav class="sidebar__nav">
        <div class="sidebar__nav-label">Principal</div>
        
        <!-- Inicio -->
        <a href="index.php?pagina=inicio" class="sidebar__nav-item <?php echo $pagina === 'inicio' ? 'active' : ''; ?>" data-page="inicio">
            <i class="bi bi-reception-4 sidebar__nav-icon"></i>
            Inicio
        </a>

        <!-- Perfil -->
        <a href="index.php?pagina=perfil" class="sidebar__nav-item <?php echo $pagina === 'perfil' ? 'active' : ''; ?>" data-page="perfil">
            <i class="bi bi-building-fill-check sidebar__nav-icon"></i>
            Perfil de empresa
        </a>
         
        <!-- Ofertas -->
        <a href="index.php?pagina=ofertas" class="sidebar__nav-item <?php echo $pagina === 'ofertas' ? 'active' : ''; ?>" data-page="ofertas">
            <i class="bi bi-briefcase-fill sidebar__nav-icon"></i>
            Mis ofertas
        </a>
                            
        <div class="sidebar__nav-label">Sistema</div>

        <!-- Ajustes Cuenta -->
        <a href="index.php?pagina=configuracion" class="sidebar__nav-item <?php echo $pagina === 'configuracion' ? 'active' : ''; ?>" data-page="configuracion">
            <i class="bi bi-person-fill-gear sidebar__nav-icon"></i>
            Ajustes Cuenta                
        </a>

        <!-- Cambiar modo -->
        <a href="index.php?cambiar_modo=usuario" class="sidebar__nav-item" data-page="candidato">
            <i class="bi bi-geo-fill sidebar__nav-icon"></i>
            Modo Candidato
        </a>  

    </nav>        

    <!-- Sidebar Footer -->
    <div class="sidebar__footer">
        <a href="index.php?pagina=salir" class="sidebar__logout" data-page="salir">
            <i class="bi bi-box-arrow-right sidebar__nav-icon"></i>
            Cerrar sesión
        </a>            
    </div>            

</aside>