<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\controller\PostulacionesControlador;

$postulaciones = PostulacionesControlador::obtenerHistorialUsuario();
?>

<div class="main__welcome">
    <h1>Mis <span>Postulaciones</span> <i class="bi bi-briefcase-fill sidebar__nav-icon"></i></h1>
    <p>Aquí puedes llevar el seguimiento de los puestos a los que has aplicado.</p>
</div>

<div class="cv-container" style="max-width: 100%; margin-top: 0;">
    <?php if (empty($postulaciones)): ?>
        <div class="card2" style="text-align: center; padding: 40px;">
            <div style="font-size: 3rem; color: var(--text-muted); margin-bottom: 15px;">
                <i class="bi bi-folder-x"></i>
            </div>
            <h3 style="color: var(--text-dark);">Aún no te has postulado a ninguna vacante</h3>
            <p style="color: var(--text-muted); margin-bottom: 20px;">Explora las vacantes disponibles en el panel de inicio y postúlate hoy mismo.</p>
            <a href="index.php?pagina=inicio" class="btn-regresar" style="display: inline-block;">
                Ver Vacantes Disponibles
            </a>
        </div>
    <?php else: ?>
        <div class="card2" style="padding: 24px;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e2e8f0; color: #4b5563;">
                            <th style="padding: 12px; font-weight: 600;">Vacante</th>
                            <th style="padding: 12px; font-weight: 600;">Empresa</th>
                            <th style="padding: 12px; font-weight: 600;">Contrato</th>
                            <th style="padding: 12px; font-weight: 600;">Fecha de Aplicación</th>
                            <th style="padding: 12px; font-weight: 600;">Estado</th>
                            <th style="padding: 12px; font-weight: 600;">Detalles / Entrevista</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($postulaciones as $p): ?>
                            <tr style="border-bottom: 1px solid #edf2f7; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 16px 12px; font-weight: 600; color: var(--primary);">
                                    <?= htmlspecialchars($p['titulo']) ?>
                                </td>
                                <td style="padding: 16px 12px; color: var(--text-dark);">
                                    <?= htmlspecialchars($p['empresa']) ?>
                                </td>
                                <td style="padding: 16px 12px;">
                                    <span style="background: #e2e8f0; color: #4a5568; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem; font-weight: 500; text-transform: capitalize;">
                                        <?= htmlspecialchars(str_replace('_', ' ', $p['tipo_contrato'])) ?>
                                    </span>
                                </td>
                                <td style="padding: 16px 12px; color: #718096;">
                                    <?= date('d/m/Y g:i a', strtotime($p['fecha_postulacion'])) ?>
                                </td>
                                <td style="padding: 16px 12px;">
                                    <?php
                                    $badgeStyle = "background-color: #fee2e2; color: #991b1b;"; // rechazada default
                                    if ($p['estado'] === 'pendiente') {
                                        $badgeStyle = "background-color: #fef3c7; color: #92400e;";
                                    } elseif ($p['estado'] === 'revisada') {
                                        $badgeStyle = "background-color: #e0f2fe; color: #075985;";
                                    } elseif ($p['estado'] === 'aceptada') {
                                        $badgeStyle = "background-color: #dcfce7; color: #166534;";
                                    }
                                    ?>
                                    <span style="<?= $badgeStyle ?> padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; text-transform: capitalize; display: inline-block;">
                                        <?= htmlspecialchars($p['estado']) ?>
                                    </span>
                                </td>
                                <td style="padding: 16px 12px;">
                                    <?php if ($p['estado'] === 'aceptada' && !empty($p['entrevista_fecha'])): ?>
                                        <div style="background: #ebf8ff; border: 1px solid #bee3f8; border-radius: 8px; padding: 10px; font-size: 0.85rem; color: #2b6cb0;">
                                            <div style="font-weight: bold; margin-bottom: 4px;">🗓️ Entrevista Programada</div>
                                            <div><strong>Fecha:</strong> <?= date('d/m/Y - h:i A', strtotime($p['entrevista_fecha'])) ?></div>
                                            <div style="text-transform: capitalize;"><strong>Modalidad:</strong> <?= htmlspecialchars($p['entrevista_tipo']) ?></div>
                                        </div>
                                    <?php elseif ($p['estado'] === 'aceptada'): ?>
                                        <span style="color: #48bb78; font-size: 0.85rem; font-weight: 500;">
                                            🎉 ¡Aceptado! En espera de programar entrevista.
                                        </span>
                                    <?php elseif ($p['estado'] === 'rechazada'): ?>
                                        <span style="color: #e53e3e; font-size: 0.85rem;">
                                            Esta postulación no continuó en el proceso.
                                        </span>
                                    <?php else: ?>
                                        <span style="color: #a0aec0; font-size: 0.85rem; font-style: italic;">
                                            Tu currículum está en revisión por la empresa.
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
