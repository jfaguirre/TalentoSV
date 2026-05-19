<nav class="menu">
    <ul class="items">
        <?php if(isset($_GET['pagina'])): ?>        
            <!-- Salir -->
            <?php if($_GET['pagina'] == 'salir'): ?>
                <li><a class="activo" href="index.php?pagina=salir">Salir</a></li>
            <?php else: ?>
                <li><a class="inactivo" href="index.php?pagina=salir">Salir</a></li>
            <?php endif ?>

        <?php else: ?>            
            <li><a class="inactivo" href="index.php?pagina=salir">Salir</a></li>
        <?php endif ?>
    </ul>
</nav>