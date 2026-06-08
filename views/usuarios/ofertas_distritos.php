<?php

use App\controller\OfertaControlador;

$distritos = OfertaControlador::obtenerOfertasDestritos($_GET['id_distrito'] ?? 0);

?>

<!-- ===== MAIN CONTENT ===== -->
<div class="main__welcome">
    <h1>Ofertas de Empleo por Distrito</h1>
    <p>Aqui encontraras las ofertas de empleo por distrito</p>
</div>

<div class="cards-grid">
    <?php foreach($distritos as $distrito): ?>
    <a class="card" href="index.php?pagina=ofertas_municipios&id_distrito=<?php echo $distrito['id_distrito']; ?>">            
        <div class="card__title">
            <span class="card__location-icon">📍</span>
            <?php echo htmlspecialchars($distrito['distrito']); ?>
        </div>

        <div class="card__trend card__trend--up">
            <?php echo $distrito['total_ofertas']; ?> ofertas de trabajo
        </div>
    </a>
    <?php endforeach; ?>
</div>

