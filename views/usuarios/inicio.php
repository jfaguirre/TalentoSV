<?php

    require_once __DIR__ . '/../../vendor/autoload.php';
    use App\controller\OfertaControlador;

    $departamentos = OfertaControlador::obtenerOfertasDepartamento();
    // die(var_dump($departamentos));
    
?>
        
<!-- ===== MAIN CONTENT ===== -->
<div class="main__welcome">
    <h1>Hola,<span>
    <?php echo htmlspecialchars($_SESSION['userAuth']['nombre'] ?? 'Usuario'); ?>
    </span> 👋
    </h1>
        <p>Bienvenido a tu panel de control. Aquí tienes las ofertas disponibles.</p>
</div>

<div class="cards-grid">
    <?php if($departamentos === false || empty($departamentos)): ?>
        <section class="sin-ofertas">
            <p>No hay ofertas de empleo disponibles.</p>   
            <div class="sin-oferta-imagen">
                <img src="assets/imagenes/empty.svg" alt="No hay ofertas de empleo">
            </div>         
        </section>
    <?php else: ?>
        <?php foreach($departamentos as $departamento): ?>            
            <a class="card" href="index.php?pagina=ofertas_distritos&id_departamento=<?php echo $departamento['id_departamento']; ?>">            
                <div class="card__title">
                    <span class="card__location-icon">📍</span>
                    <?php echo htmlspecialchars($departamento['departamento']); ?>
            </div>

                <div class="card__trend card__trend--up">
                    <?php echo $departamento['total_ofertas']; ?> ofertas de trabajo
                </div>
            </a>             
        <?php endforeach; ?>
    <?php endif; ?>
</div>
    

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
