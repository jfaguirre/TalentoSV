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
    


