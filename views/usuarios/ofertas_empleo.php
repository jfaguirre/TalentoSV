<?php

use App\controller\OfertaControlador;
$ofertas = OfertaControlador::obtenerOfertasEmpleo($_GET['id_municipio'] ?? 0);

// die(var_dump($ofertas));

?>

<!-- ===== MAIN CONTENT ===== -->
<div class="main__welcome">
    <h1>Ofertas de empleo por empresa</h1>
    <p>Aqui encontraras las ofertas de empleo por empresa</p>
</div>
<div class="acciones">
    <a href="javascript:history.back()" class="btn-regresar">
        ← Regresar
    </a>
</div>

<div class="cards-grid">
    <?php foreach($ofertas as $oferta): ?>
    <a class="card" href="index.php?pagina=detalle_empleo&id_oferta=<?php echo $oferta['id_oferta']; ?>">            
        <div class="card__title">
            <span class="card__location-icon"><i class="bi bi-person-rolodex icono-empleo"></i></span>
            <?php echo htmlspecialchars($oferta['titulo']); ?>
        </div>

        <div class="card__trend card__trend--up">
            <?php echo $oferta['descripcion']; ?>             
        </div>

        <div class="card__trend card__trend--up">
            <?php echo $oferta['tipo_contrato']; ?>
        </div>

        <div class="card__trend card__trend--up nombre_empresa">
            <p><?php echo $oferta['empresa']; ?></p>
        </div>
    </a>
    <?php endforeach; ?>
</div>