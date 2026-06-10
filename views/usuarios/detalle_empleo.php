<?php

namespace App\Views\UsuarioControlador;

use App\controller\OfertaControlador;

$oferta = OfertaControlador::obtenerDetalleEmpleo($_GET['id_oferta'] ?? 0);

?>

<?php if (!$oferta): ?>

    <div class="alerta-error">
        <h2>Oferta no encontrada</h2>
        <p>No existen datos para esta oferta.</p>
    </div>

<?php else: ?>

<div class="oferta-container">
    <div class="oferta-card">
        <div class="cabecera">
            <div>
                <h1 class="empresa">
                    <?= htmlspecialchars($oferta['empresa']) ?>
                </h1>

                <h2 class="puesto">
                    <?= htmlspecialchars($oferta['titulo']) ?>
                </h2>
            </div>

            <span class="tipo-contrato">
                <?= htmlspecialchars($oferta['tipo_contrato']) ?>
            </span>

        </div>
        <hr>
        <div class="info-resumen">
            <div class="info-box">
                <span class="titulo-info">Correo de contacto</span>
                <span><?= htmlspecialchars($oferta['correo']) ?></span>
            </div>

            <div class="info-box">
                <span class="titulo-info">Sector empresarial</span>
                <span><?= htmlspecialchars($oferta['sector_empresa']) ?></span>
            </div>

        </div>

        <section class="seccion">

            <h3>Descripción del puesto</h3>

            <div class="contenido">
                <?= nl2br(htmlspecialchars($oferta['descripcion'])) ?>
            </div>

        </section>

        <section class="seccion">

            <h3>Sobre la empresa</h3>

            <div class="contenido">
                <?= nl2br(htmlspecialchars($oferta['descripcion_empresa'])) ?>
            </div>

        </section>

        <div class="acciones">

            <a href="" class="btn-aplicar"> Aplicar ahora </a>

        </div>

    </div>

</div>
<?php endif; ?>