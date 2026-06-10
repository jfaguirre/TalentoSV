<?php

namespace App\Views\UsuarioControlador;

use App\controller\OfertaControlador;
use App\controller\PostulacionesControlador;
use App\models\Postulaciones;

// Procesar postulación
PostulacionesControlador::procesarPostulacion();

$id_oferta = $_GET['id_oferta'] ?? 0;
$oferta = OfertaControlador::obtenerDetalleEmpleo($id_oferta);

$id_usuario = $_SESSION['userAuth']['id'] ?? 0;
$yaPostulado = false;
if ($id_usuario > 0 && $oferta) {
    $yaPostulado = Postulaciones::verificarPostulacion($id_usuario, $oferta['id_oferta']);
}

?>
<div class="acciones">
    <a href="javascript:history.back()" class="btn-regresar">
        ← Regresar
    </a>
</div>
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
            <?php if ($yaPostulado): ?>
                <button class="btn-aplicar" style="background-color: #718096; cursor: not-allowed; opacity: 0.8; border: none; outline: none; padding: 0.75rem 1.5rem; border-radius: 6px; color: white;" disabled>
                    ✓ Ya te postulaste a esta oferta
                </button>
            <?php else: ?>
                <form id="form-aplicar" method="POST" style="display:none;">
                    <input type="hidden" name="accion" value="aplicar">
                    <input type="hidden" name="id_oferta" value="<?= htmlspecialchars($oferta['id_oferta']) ?>">
                </form>
                <a href="#" class="btn-aplicar" onclick="confirmarAplicacion(event)"> Aplicar ahora </a>
            <?php endif; ?>
        </div>

    </div>

</div>

<script>
function confirmarAplicacion(event) {
    event.preventDefault();
    Swal.fire({
        title: '¿Confirmar postulación?',
        text: '¿Estás seguro de que deseas aplicar a la vacante "<?= htmlspecialchars($oferta['titulo']) ?>" en <?= htmlspecialchars($oferta['empresa']) ?>?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2b6cb0',
        cancelButtonColor: '#e53e3e',
        confirmButtonText: 'Sí, postularme',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-aplicar').submit();
        }
    });
}
</script>

<?php endif; ?>