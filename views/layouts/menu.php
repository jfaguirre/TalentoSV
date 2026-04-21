<nav class="menu">
    <ul class="items">
        <?php if(isset($_GET['pagina'])): ?>

            <!-- Inicio -->
            <?php if($_GET['pagina'] == 'inicio'): ?>
                <li><a class="activo" href="index.php?pagina=inicio">Inicio</a></li>
            <?php else: ?>
                <li><a class="inactivo" href="index.php?pagina=inicio">Inicio</a></li>
            <?php endif ?>

            <!-- Registro -->
            <?php if($_GET['pagina'] == 'registro'): ?>
                <li><a class="activo" href="index.php?pagina=registro">Registro</a></li>
            <?php else: ?>
                <li><a class="inactivo" href="index.php?pagina=registro">Registro</a></li>
            <?php endif ?>

            <!-- Ingreso -->
            <?php if($_GET['pagina'] == 'ingreso'): ?>
                <li><a class="activo" href="index.php?pagina=ingreso">Ingreso</a></li>
            <?php else: ?>
                <li><a class="inactivo" href="index.php?pagina=ingreso">Ingreso</a></li>
            <?php endif ?>

            <!-- Salir -->
            <?php if($_GET['pagina'] == 'salir'): ?>
                <li><a class="activo" href="index.php?pagina=salir">Salir</a></li>
            <?php else: ?>
                <li><a class="inactivo" href="index.php?pagina=salir">Salir</a></li>
            <?php endif ?>

        <?php else: ?>
            <li><a class="activo" href="index.php?pagina=inicio">Inicio</a></li>
            <li><a class="inactivo" href="index.php?pagina=registro">Registro</a></li>
            <li><a class="inactivo" href="index.php?pagina=ingreso">Sesión</a></li>
            <li><a class="inactivo" href="index.php?pagina=salir">Salir</a></li>
        <?php endif ?>
    </ul>
</nav>

