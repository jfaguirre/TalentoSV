<nav class="menu">
    <ul class="items">
        <?php if(isset($_GET['pagina'])): ?>        
            <!-- Salir -->
            <?php if($_GET['pagina'] == 'salir'): ?>
                <li><a class="activo" href="index.php?pagina=salir">Salir</a></li>
            <?php else: ?>
                <li><a class="inactivo" href="index.php?pagina=salir">Salir</a></li>
            <?php endif ?>

            <!-- Perfil -->
            <?php if($_GET['pagina'] == 'perfil'): ?>
                <li><a class="activo" href="index.php?pagina=perfil">Perfil</a></li>
            <?php else: ?>
                <li><a class="inactivo" href="index.php?pagina=perfil">Perfil</a></li>
            <?php endif ?>

        <?php else: ?>            
            <li><a class="inactivo" href="index.php?pagina=perfil">Perfil</a></li>
            <li><a class="inactivo" href="index.php?pagina=salir">Salir</a></li>
        <?php endif ?>

        <!-- Cambiar Modo a Empresa / Registrar Empresa -->
        <?php
        $id_usuario = $_SESSION['userAuth']['id'] ?? null;
        $empresa = $id_usuario ? \App\models\Empresa::obtenerPorUsuario($id_usuario) : null;
        if ($empresa):
        ?>
            <li><a class="inactivo" href="index.php?cambiar_modo=empresa" style="background-color: rgba(79, 70, 229, 0.1); color: #4f46e5; border-radius: 6px; padding: 4px 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"><i class="fa-solid fa-building"></i> Modo Empresa</a></li>
        <?php else: ?>
            <li><a class="inactivo" href="index.php?pagina=registrar_empresa" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981; border-radius: 6px; padding: 4px 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"><i class="fa-solid fa-circle-plus"></i> Registrar mi empresa</a></li>
        <?php endif; ?>
    </ul>
</nav>
