<?php

use App\controller\OfertaControlador;
$municipios = OfertaControlador::obtenerOfertasMunicipios($_GET['id_municipio'] ?? 0);

?>

<!-- ===== MAIN CONTENT ===== -->
<div class="main__welcome">
    <h1>Ofertas de Empleo por Municipio</h1>
    <p>Aqui encontraras las ofertas de empleo por municipio</p>
</div>

<div class="cards-grid">
    <?php foreach($municipios as $municipio): ?>
    <a class="card" href="index.php?pagina=ofertas_municipios&id_municipio=<?php echo $municipio['id_municipio']; ?>">            
        <div class="card__title">
            <span class="card__location-icon">📍</span>
            <?php echo htmlspecialchars($municipio['municipio']); ?>
        </div>

        <div class="card__trend card__trend--up">
            <?php echo $municipio['total_ofertas']; ?> ofertas de trabajo
        </div>
    </a>
    <?php endforeach; ?>
</div>