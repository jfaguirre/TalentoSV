<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use App\controller\EmpresaControlador;

$controlador = new EmpresaControlador();
$controlador->procesarAccionesInicio();

$empresa_id = $_SESSION['userAuth']['empresa_id'] ?? null;
if (!$empresa_id) {
    echo "<h2>Error: No se encontró la empresa asociada.</h2>";
    exit;
}

$datos = $controlador->obtenerDatosInicio($empresa_id);
?>

<div class="page-header">
    <h1 class="page-title">Panel de Control</h1>
    <p class="page-subtitle">Bienvenido, <?= htmlspecialchars($_SESSION['userAuth']['nombre']); ?>. Gestiona tus vacantes y candidatos.</p>
</div>

<!-- Grid de Estadísticas -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon primary">
            <i class="fa-solid fa-briefcase"></i>
        </div>
        <div class="stat-info">
            <span class="stat-value"><?= $datos['totalOfertas']; ?></span>
            <span class="stat-label">Ofertas Publicadas</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon warning">
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="stat-info">
            <span class="stat-value"><?= $datos['totalPostulaciones']; ?></span>
            <span class="stat-label">Postulaciones Recibidas</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon danger">
            <i class="fa-solid fa-clock"></i>
        </div>
        <div class="stat-info">
            <span class="stat-value"><?= $datos['pendientes']; ?></span>
            <span class="stat-label">Candidatos Pendientes</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon success">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
        <div class="stat-info">
            <span class="stat-value"><?= count($datos['entrevistas']); ?></span>
            <span class="stat-label">Entrevistas Agendadas</span>
        </div>
    </div>
</div>

<div class="form-grid">
    <!-- Tabla de Postulantes Recientes -->
    <div class="card form-grid-full" style="grid-column: span 2;">
        <h2 class="card-title">Candidatos Reclutados</h2>
        
        <?php if (empty($datos['postulaciones'])): ?>
            <div class="empty-state">
                <div class="empty-state-icon"><i class="fa-regular fa-folder-open"></i></div>
                <p>Aún no has recibido postulaciones para tus vacantes.</p>
                <a href="index.php?pagina=ofertas" class="btn btn-primary btn-sm">Publicar Nueva Vacante</a>
            </div>
        <?php else: ?>
            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Candidato</th>
                            <th>Contacto</th>
                            <th>Puesto</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datos['postulaciones'] as $p): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']); ?></strong></td>
                                <td><?= htmlspecialchars($p['correo']); ?></td>
                                <td><?= htmlspecialchars($p['titulo']); ?></td>
                                <td><?= date('d/m/Y g:i a', strtotime($p['fecha_postulacion'])); ?></td>
                                <td>
                                    <span class="badge <?= htmlspecialchars($p['estado']); ?>">
                                        <?= htmlspecialchars($p['estado']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                        <!-- Botones rápidos de cambio de estado -->
                                        <form method="POST" style="margin:0;">
                                            <input type="hidden" name="accion" value="cambiar_estado">
                                            <input type="hidden" name="id_postulacion" value="<?= $p['id_postulacion']; ?>">
                                            
                                            <?php if($p['estado'] === 'pendiente'): ?>
                                                <button type="submit" name="estado" value="revisada" class="btn btn-secondary btn-sm" title="Marcar como Revisada">
                                                    Revisar
                                                </button>
                                            <?php endif; ?>
                                            
                                            <button type="submit" name="estado" value="aceptada" class="btn btn-success btn-sm <?= ($p['estado'] === 'aceptada') ? 'disabled' : ''; ?>" <?= ($p['estado'] === 'aceptada') ? 'disabled' : ''; ?>>
                                                Aceptar
                                            </button>
                                            <button type="submit" name="estado" value="rechazada" class="btn btn-danger btn-sm <?= ($p['estado'] === 'rechazada') ? 'disabled' : ''; ?>" <?= ($p['estado'] === 'rechazada') ? 'disabled' : ''; ?>>
                                                Rechazar
                                            </button>
                                        </form>

                                        <?php if($p['estado'] !== 'rechazada'): ?>
                                            <button type="button" class="btn btn-outline btn-sm" onclick="abrirModalEntrevista(<?= $p['id_postulacion']; ?>, '<?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']); ?>')">
                                                <i class="fa-solid fa-calendar"></i> Agendar Entrevista
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Lista de Entrevistas Próximas -->
    <div class="card form-grid-full" style="grid-column: span 2;">
        <h2 class="card-title">Agenda de Entrevistas</h2>
        <?php if (empty($datos['entrevistas'])): ?>
            <div class="empty-state">
                <div class="empty-state-icon"><i class="fa-regular fa-calendar-times"></i></div>
                <p>No tienes entrevistas programadas en este momento.</p>
            </div>
        <?php else: ?>
            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Candidato</th>
                            <th>Vacante</th>
                            <th>Fecha y Hora</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datos['entrevistas'] as $ent): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($ent['nombre'] . ' ' . $ent['apellido']); ?></strong></td>
                                <td><?= htmlspecialchars($ent['titulo']); ?></td>
                                <td><?= date('d/m/Y - h:i A', strtotime($ent['fecha_hora'])); ?></td>
                                <td>
                                    <span class="badge revisada" style="text-transform: capitalize;">
                                        <?= htmlspecialchars($ent['tipo']); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?= ($ent['estado'] === 'programada') ? 'pendiente' : 'aceptada'; ?>">
                                        <?= htmlspecialchars($ent['estado']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- MODAL PARA AGENDAR ENTREVISTA (CSS Puro + JS ligero) -->
<div class="modal-backdrop" id="modalEntrevista">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Programar Entrevista</h3>
            <button class="modal-close" onclick="cerrarModalEntrevista()">&times;</button>
        </div>
        <form method="POST" id="form-entrevista">
            <div class="modal-body">
                <input type="hidden" name="accion" value="programar_entrevista">
                <input type="hidden" name="id_postulacion" id="modal_id_postulacion" value="">
                
                <p style="margin-bottom: 1rem; font-size: 0.95rem; color: var(--text-muted)">
                    Agendar entrevista para: <strong id="modal_nombre_candidato" style="color: var(--text-main)">Candidato</strong>
                </p>

                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label class="form-label" for="fecha_hora">Fecha y Hora</label>
                    <input type="datetime-local" class="form-input" name="fecha_hora" id="fecha_hora" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="tipo">Tipo de Entrevista</label>
                    <select class="form-select" name="tipo" id="tipo" required>
                        <option value="virtual">Virtual (Video llamada)</option>
                        <option value="presencial">Presencial (En oficinas)</option>
                        <option value="telefonica">Telefónica</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="cerrarModalEntrevista()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Agendar</button>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModalEntrevista(idPostulacion, nombreCandidato) {
    document.getElementById('modal_id_postulacion').value = idPostulacion;
    document.getElementById('modal_nombre_candidato').innerText = nombreCandidato;
    document.getElementById('modalEntrevista').classList.add('open');
}

function cerrarModalEntrevista() {
    document.getElementById('modalEntrevista').classList.remove('open');
}

// Cerrar al hacer click fuera del contenedor del modal
document.getElementById('modalEntrevista').addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModalEntrevista();
    }
});
</script>
