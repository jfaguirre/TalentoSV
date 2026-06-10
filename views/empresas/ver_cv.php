<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use App\models\Usuario;
use App\models\Experiencia;
use App\models\Habilidad;
use App\models\Estudio;
use App\models\Referencia;

$id_usuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : 0;

if ($id_usuario <= 0) {
    echo "<div class='container' style='padding: 40px; text-align: center;'><h2>Candidato no válido.</h2><a href='index.php?pagina=inicio' class='btn btn-primary'>Volver al Panel</a></div>";
    exit;
}

$perfil = Usuario::obtenerPerfilDetallado($id_usuario);
$experiencias = Experiencia::mostrarExperiencias($id_usuario);
$habilidades = Habilidad::mostrarHabilidades($id_usuario);
$estudios = Estudio::mostrarEstudios($id_usuario);
$referencias = Referencia::mostrarReferencias($id_usuario);
?>

<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;">
    <div>
        <h1 class="page-title">Currículum Vitae</h1>
        <p class="page-subtitle">Revisa el perfil curricular del candidato.</p>
    </div>
    <a href="index.php?pagina=inicio" class="btn btn-outline" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; height: fit-content; padding: 0.75rem 1.25rem;">
        <i class="fa-solid fa-arrow-left"></i> Volver al Panel
    </a>
</div>

<div class="form-grid" style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
    
    <!-- CABECERA DE PERFIL -->
    <div class="card" style="display: flex; flex-direction: row; align-items: center; gap: 2rem; padding: 2.5rem; flex-wrap: wrap;">
        <div style="width: 100px; height: 100px; border-radius: 50%; background: var(--primary-light, #ebf8ff); color: var(--primary, #2b6cb0); display: flex; align-items: center; justify-content: center; font-size: 3rem; font-weight: 700; border: 3px solid var(--primary, #2b6cb0);">
            <?= strtoupper(substr($perfil['nombre'] ?? 'C', 0, 1)) ?>
        </div>
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; margin: 0; color: var(--text-main, #1a202c);">
                <?= htmlspecialchars(($perfil['nombre'] ?? 'Candidato') . ' ' . ($perfil['apellido'] ?? '')) ?>
            </h2>
            <p style="font-size: 1.2rem; font-weight: 600; color: var(--primary, #2b6cb0); margin: 0.25rem 0 0.5rem 0;">
                <?= htmlspecialchars($perfil['profesion'] ?? 'Profesión no especificada') ?>
            </p>
            <p style="font-size: 0.95rem; color: var(--text-muted, #718096); margin: 0; display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-location-dot"></i> 
                <?= htmlspecialchars(($perfil['departamento'] ?? '') . ', ' . ($perfil['municipio'] ?? '') . ', ' . ($perfil['distrito'] ?? '')) ?>
            </p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr; gap: 2rem; @media (min-width: 992px) { grid-template-columns: 1fr 2fr; }">
        <!-- SECCIÓN IZQUIERDA: DATOS DE CONTACTO Y HABILIDADES -->
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            <!-- DATOS DE CONTACTO -->
            <div class="card" style="padding: 2rem;">
                <h3 class="card-title" style="border-bottom: 2px solid #edf2f7; padding-bottom: 0.75rem; margin-bottom: 1.25rem; color: var(--primary, #2b6cb0);">
                    <i class="fa-solid fa-address-book"></i> Datos de Contacto
                </h3>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <div>
                        <span style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted, #718096); text-transform: uppercase;">Correo Electrónico</span>
                        <strong style="font-size: 0.95rem; color: var(--text-main, #1a202c); word-break: break-all;"><?= htmlspecialchars($perfil['correo'] ?? 'No disponible') ?></strong>
                    </div>
                    <div>
                        <span style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted, #718096); text-transform: uppercase;">Teléfono</span>
                        <strong style="font-size: 0.95rem; color: var(--text-main, #1a202c);"><?= htmlspecialchars($perfil['telefono'] ?? 'No disponible') ?></strong>
                    </div>
                    <div>
                        <span style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted, #718096); text-transform: uppercase;">Nacionalidad</span>
                        <strong style="font-size: 0.95rem; color: var(--text-main, #1a202c);"><?= htmlspecialchars($perfil['nacionalidad'] ?? 'No disponible') ?></strong>
                    </div>
                    <div>
                        <span style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted, #718096); text-transform: uppercase;">Género</span>
                        <strong style="font-size: 0.95rem; color: var(--text-main, #1a202c);"><?= htmlspecialchars($perfil['genero'] ?? 'No disponible') ?></strong>
                    </div>
                </div>
            </div>

            <!-- HABILIDADES -->
            <div class="card" style="padding: 2rem;">
                <h3 class="card-title" style="border-bottom: 2px solid #edf2f7; padding-bottom: 0.75rem; margin-bottom: 1.25rem; color: var(--primary, #2b6cb0);">
                    <i class="fa-solid fa-star"></i> Habilidades
                </h3>
                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    <?php if (!empty($habilidades)): ?>
                        <?php foreach($habilidades as $hab): ?>
                            <span class="badge" style="background: #e2e8f0; color: #1a202c; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.85rem;">
                                <?= htmlspecialchars($hab['habilidad']) ?>
                            </span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span style="font-style: italic; color: var(--text-muted, #718096);">No hay habilidades registradas.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- SECCIÓN DERECHA: EXPERIENCIA, ESTUDIOS Y REFERENCIAS -->
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            <!-- EXPERIENCIA LABORAL -->
            <div class="card" style="padding: 2rem;">
                <h3 class="card-title" style="border-bottom: 2px solid #edf2f7; padding-bottom: 0.75rem; margin-bottom: 1.25rem; color: var(--primary, #2b6cb0);">
                    <i class="fa-solid fa-briefcase"></i> Experiencia Laboral
                </h3>
                <?php if (!empty($experiencias)): ?>
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <?php foreach($experiencias as $exp): ?>
                            <div style="border-left: 3px solid var(--primary, #2b6cb0); padding-left: 1rem;">
                                <h4 style="font-size: 1.1rem; font-weight: 700; margin: 0; color: var(--text-main, #1a202c);"><?= htmlspecialchars($exp['puesto']) ?></h4>
                                <div style="font-size: 0.9rem; font-weight: 600; color: var(--primary, #2b6cb0); margin-top: 0.25rem;">
                                    <?= htmlspecialchars($exp['empresa']) ?> &bull; <span style="color: var(--text-muted, #718096); font-weight: normal;"><?= htmlspecialchars($exp['fecha_inicio']) ?> — <?= htmlspecialchars($exp['fecha_fin'] ?? 'Presente') ?></span>
                                </div>
                                <p style="font-size: 0.95rem; color: var(--text-muted, #4b5563); margin: 0.5rem 0 0 0; line-height: 1.6; text-align: justify;">
                                    <?= nl2br(htmlspecialchars($exp['descripcion'])) ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p style="font-style: italic; color: var(--text-muted, #718096); margin: 0;">No se ha registrado experiencia laboral.</p>
                <?php endif; ?>
            </div>

            <!-- ESTUDIOS -->
            <div class="card" style="padding: 2rem;">
                <h3 class="card-title" style="border-bottom: 2px solid #edf2f7; padding-bottom: 0.75rem; margin-bottom: 1.25rem; color: var(--primary, #2b6cb0);">
                    <i class="fa-solid fa-graduation-cap"></i> Historial Académico
                </h3>
                <?php if (!empty($estudios)): ?>
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <?php foreach($estudios as $est): ?>
                            <div style="border-left: 3px solid #48bb78; padding-left: 1rem;">
                                <h4 style="font-size: 1.1rem; font-weight: 700; margin: 0; color: var(--text-main, #1a202c);"><?= htmlspecialchars($est['titulo'] ?? $est['carrera'] ?? 'Título no disponible') ?></h4>
                                <div style="font-size: 0.9rem; font-weight: 600; color: #2f855a; margin-top: 0.25rem;">
                                    <?= htmlspecialchars($est['institucion']) ?> &bull; 
                                    <span style="color: var(--text-muted, #718096); font-weight: normal;">
                                        <?php if (!empty($est['fecha_logro'])): ?>
                                            Fecha de logro: <?= htmlspecialchars($est['fecha_logro']) ?>
                                        <?php else: ?>
                                            Periodo: <?= htmlspecialchars(($est['fecha_inicio'] ?? '') . ' — ' . ($est['fecha_fin'] ?? '')) ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div style="margin-top: 0.25rem;">
                                    <span class="badge" style="background: #c6f6d5; color: #22543d; font-size: 0.75rem; padding: 2px 6px; border-radius: 10px; font-weight: 600;">
                                        <?= htmlspecialchars($est['estado']) ?>
                                    </span>
                                </div>
                                <?php if (!empty($est['descripcion'])): ?>
                                    <p style="font-size: 0.95rem; color: var(--text-muted, #4b5563); margin: 0.5rem 0 0 0; line-height: 1.6; text-align: justify;">
                                        <?= nl2br(htmlspecialchars($est['descripcion'])) ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p style="font-style: italic; color: var(--text-muted, #718096); margin: 0;">No se han registrado estudios académicos.</p>
                <?php endif; ?>
            </div>

            <!-- REFERENCIAS -->
            <div class="card" style="padding: 2rem;">
                <h3 class="card-title" style="border-bottom: 2px solid #edf2f7; padding-bottom: 0.75rem; margin-bottom: 1.25rem; color: var(--primary, #2b6cb0);">
                    <i class="fa-solid fa-users-rectangle"></i> Referencias Personales
                </h3>
                <?php if (!empty($referencias)): ?>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
                        <?php foreach($referencias as $ref): ?>
                            <div style="background: #f8fafc; border: 1px solid #edf2f7; padding: 1rem; border-radius: 10px;">
                                <h4 style="font-size: 1rem; font-weight: 700; margin: 0 0 0.5rem 0; color: var(--text-main, #1a202c);">
                                    <?= htmlspecialchars($ref['nombre_referencia'] ?? $ref['nombre'] ?? 'Referente') ?>
                                </h4>
                                <div style="font-size: 0.85rem; color: var(--text-muted, #4b5563); display: flex; flex-direction: column; gap: 0.25rem;">
                                    <span><i class="fa-solid fa-phone" style="width: 15px;"></i> <?= htmlspecialchars($ref['telefono_contacto'] ?? $ref['telefono'] ?? 'No disponible') ?></span>
                                    <span><i class="fa-solid fa-envelope" style="width: 15px;"></i> <?= htmlspecialchars($ref['correo_contacto'] ?? $ref['correo'] ?? 'No disponible') ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p style="font-style: italic; color: var(--text-muted, #718096); margin: 0;">No se han registrado referencias personales.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
