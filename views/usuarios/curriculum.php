<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use App\models\Usuario;
use App\controller\ExperienciaControlador;
use App\controller\EstudioControlador;
use App\controller\HabilidadControlador;
use App\controller\ReferenciaControlador;

$id_usuario = $_SESSION['userAuth']['id'] ?? null;
if (!$id_usuario) {
    header("Location: index.php?pagina=ingreso");
    exit;
}

// Cargar datos
$perfil = Usuario::obtenerPerfilDetallado($id_usuario);
$experiencias = ExperienciaControlador::mostrarExperiencias();
$estudios = EstudioControlador::mostrarEstudios();
$habilidades = HabilidadControlador::mostrarHabilidades();
$referencias = ReferenciaControlador::mostrarReferencias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Curriculum - <?= htmlspecialchars(($perfil['nombre'] ?? '') . ' ' . ($perfil['apellido'] ?? '')) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f4f6f9; font-family: system-ui, sans-serif; }
        .cv-container {
            max-width: 900px; margin: 30px auto; background: #fff;
            border-radius: 12px; padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .cv-header { display: flex; align-items: center; gap: 20px; }
        .cv-photo {
            width: 110px; height: 110px; border-radius: 50%;
            background-size: cover; background-position: center;
            background-color: #ddd;
        }
        .section-title {
            font-size: 1.3rem; font-weight: 700;
            margin-top: 25px; margin-bottom: 10px; color: #0d6efd;
        }
        .item { margin-bottom: 15px; padding-left: 10px; border-left: 3px solid #0d6efd; }
        .item-title { font-weight: 600; font-size: 1.05rem; }
        .item-sub { color: #666; font-size: 0.9rem; }
        .item-desc { margin-top: 5px; font-size: 0.95rem; }
    </style>
</head>

<body>

<div class="cv-container">

    <!-- ENCABEZADO -->
    <div class="cv-header">
        <div class="cv-photo"
             style="background-image: url('<?= !empty($perfil['foto']) ? $perfil['foto'] : 'https://via.placeholder.com/110' ?>');">
        </div>

        <div>
            <h2 class="mb-1"><?= htmlspecialchars(($perfil['nombre'] ?? '') . ' ' . ($perfil['apellido'] ?? '')) ?></h2>
            <h5 class="text-muted"><?= htmlspecialchars($perfil['profesion'] ?? 'Profesión no registrada') ?></h5>

            <p class="mb-0">
                <strong>Correo:</strong> <?= htmlspecialchars($perfil['correo'] ?? '') ?><br>
                <strong>Teléfono:</strong> <?= htmlspecialchars($perfil['telefono'] ?? 'No registrado') ?><br>
                <strong>Nacionalidad:</strong> <?= htmlspecialchars($perfil['nacionalidad'] ?? 'No registrada') ?><br>
                <strong>Género:</strong> 
                <?php 
                    $gen = $perfil['genero'] ?? '';
                    if ($gen === 'M') echo 'Masculino';
                    elseif ($gen === 'F') echo 'Femenino';
                    elseif ($gen === 'O') echo 'Otro';
                    else echo 'No registrado';
                ?>
            </p>
        </div>
    </div>

    <!-- UBICACIÓN -->
    <div class="section-title">Ubicación</div>
    <p>
        <strong>Departamento:</strong> <?= htmlspecialchars($perfil['departamento'] ?? 'No registrado') ?><br>
        <strong>Distrito:</strong> <?= htmlspecialchars($perfil['distrito'] ?? 'No registrado') ?><br>
        <strong>Municipio:</strong> <?= htmlspecialchars($perfil['municipio'] ?? 'No registrado') ?>
    </p>

    <!-- EXPERIENCIA -->
    <div class="section-title">Experiencia Laboral</div>

    <?php if (!empty($experiencias)): ?>
        <?php foreach ($experiencias as $exp): ?>
            <div class="item">
                <div class="item-title"><?= htmlspecialchars($exp['puesto'] ?? '') ?> - <?= htmlspecialchars($exp['empresa'] ?? '') ?></div>
                <div class="item-sub">
                    <?= htmlspecialchars($exp['fecha_inicio'] ?? '') ?> a <?= htmlspecialchars($exp['fecha_fin'] ?: 'Actual') ?>
                </div>
                <div class="item-desc"><?= nl2br(htmlspecialchars($exp['descripcion'] ?? '')) ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted">No hay experiencia registrada.</p>
    <?php endif; ?>

    <!-- ESTUDIOS -->
    <div class="section-title">Formación Académica</div>

    <?php if (!empty($estudios)): ?>
        <?php foreach ($estudios as $est): ?>
            <div class="item">
                <div class="item-title"><?= htmlspecialchars($est['titulo'] ?? '') ?> - <?= htmlspecialchars($est['institucion'] ?? '') ?></div>
                <div class="item-sub">
                    <strong>Nivel:</strong> <?= htmlspecialchars($est['nivel_academico'] ?? 'No especificado') ?><br>
                    <strong>Fecha Logro:</strong> <?= htmlspecialchars($est['fecha_logro'] ?? 'Sin fecha') ?><br>
                    <strong>Estado:</strong> <?= htmlspecialchars($est['estado'] ?? 'Finalizado') ?>
                </div>
                <div class="item-desc"><?= nl2br(htmlspecialchars($est['descripcion'] ?? '')) ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted">No hay estudios registrados.</p>
    <?php endif; ?>

    <!-- HABILIDADES -->
    <div class="section-title">Habilidades</div>

    <?php if (!empty($habilidades)): ?>
        <ul>
            <?php foreach ($habilidades as $hab): ?>
                <li><strong><?= htmlspecialchars($hab['habilidad'] ?? '') ?></strong></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-muted">No hay habilidades registradas.</p>
    <?php endif; ?>

    <!-- REFERENCIAS -->
    <div class="section-title">Referencias</div>

    <?php if (!empty($referencias)): ?>
        <?php foreach ($referencias as $ref): ?>
            <div class="item">
                <div class="item-title"><?= htmlspecialchars($ref['nombre_referencia'] ?? '') ?></div>
                <div class="item-sub">
                    Tel: <?= htmlspecialchars($ref['telefono_contacto'] ?? 'No registrado') ?><br>
                    Correo: <?= htmlspecialchars($ref['correo_contacto'] ?? 'No registrado') ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted">No hay referencias registradas.</p>
    <?php endif; ?>

</div>

</body>
</html>
