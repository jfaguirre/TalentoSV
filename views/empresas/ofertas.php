<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use App\controller\EmpresaControlador;

$controlador = new EmpresaControlador();
$empresa_id = $_SESSION['userAuth']['empresa_id'] ?? null;
if (!$empresa_id) {
    echo "<h2>Error: No se encontró la empresa asociada.</h2>";
    exit;
}

$ofertas = $controlador->gestionarOfertas($empresa_id);

// Función auxiliar para formatear el tipo de contrato
function formatearContrato($tipo) {
    switch ($tipo) {
        case 'Tiempo completo': return 'Tiempo Completo';
        case 'Medio tiempo': return 'Medio Tiempo';
        case 'Temporal': return 'Temporal';
        case 'Freelance': return 'Freelance';
        default: return htmlspecialchars($tipo);
    }
}
?>

<div class="page-header" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 class="page-title">Gestionar Ofertas</h1>
        <p class="page-subtitle">Publica nuevas plazas de empleo y administra tus vacantes activas.</p>
    </div>
    <button class="btn btn-primary" onclick="abrirModalCrear()">
        <i class="fa-solid fa-plus"></i> Publicar Vacante
    </button>
</div>

<!-- Listado de Ofertas -->
<?php if (empty($ofertas)): ?>
    <div class="card">
        <div class="empty-state">
            <div class="empty-state-icon"><i class="fa-solid fa-briefcase"></i></div>
            <h3>No tienes ofertas publicadas</h3>
            <p>Comienza a buscar talento publicando tu primera oferta de empleo en segundos.</p>
            <button class="btn btn-primary btn-sm" style="margin-top:0.5rem" onclick="abrirModalCrear()">Publicar ahora</button>
        </div>
    </div>
<?php else: ?>
    <div class="jobs-grid">
        <?php foreach ($ofertas as $o): ?>
            <div class="job-card" id="card-<?= $o['id_oferta']; ?>">
                <div>
                    <h3 class="job-card-title"><?= htmlspecialchars($o['titulo']); ?></h3>
                    <span class="badge revisada" style="margin-bottom:0.75rem"><?= formatearContrato($o['tipo_contrato']); ?></span>
                    <p class="job-card-desc"><?= htmlspecialchars($o['descripcion']); ?></p>
                </div>
                
                <div class="job-card-footer">
                    <div class="job-actions">
                        <button class="btn btn-secondary btn-sm" onclick="abrirModalEditar(<?= $o['id_oferta']; ?>, '<?= htmlspecialchars(addslashes($o['titulo'])); ?>', '<?= htmlspecialchars(addslashes($o['tipo_contrato'])); ?>', '<?= htmlspecialchars(addslashes($o['descripcion'])); ?>')">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </button>
                        <button class="btn btn-outline btn-sm btn-danger" onclick="confirmarEliminar(<?= $o['id_oferta']; ?>, '<?= htmlspecialchars(addslashes($o['titulo'])); ?>')">
                            <i class="fa-solid fa-trash-can"></i> Eliminar
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Formulario Oculto de Eliminación -->
<form id="form-eliminar" method="POST" style="display:none;">
    <input type="hidden" name="accion" value="eliminar">
    <input type="hidden" name="id_oferta" id="delete_id_oferta" value="">
</form>

<!-- MODAL CREAR OFERTA -->
<div class="modal-backdrop" id="modalCrear">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Publicar Vacante</h3>
            <button class="modal-close" onclick="cerrarModalCrear()">&times;</button>
        </div>
        <form method="POST">
            <div class="modal-body">
                <input type="hidden" name="accion" value="crear">
                
                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label class="form-label" for="titulo_crear">Título del Puesto <span style="color:var(--danger)">*</span></label>
                    <input type="text" class="form-input" name="titulo" id="titulo_crear" placeholder="Ej. Desarrollador PHP Semi-Senior" required>
                </div>

                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label class="form-label" for="tipo_contrato_crear">Tipo de Contrato <span style="color:var(--danger)">*</span></label>
                    <select class="form-select" name="tipo_contrato" id="tipo_contrato_crear" required>
                        <option value="Tiempo completo">Tiempo Completo</option>
                        <option value="Medio tiempo">Medio Tiempo</option>
                        <option value="Temporal">Temporal</option>
                        <option value="Freelance">Freelance</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="descripcion_crear">Descripción de Funciones y Requisitos <span style="color:var(--danger)">*</span></label>
                    <textarea class="form-input form-textarea" name="descripcion" id="descripcion_crear" placeholder="Detalla el perfil buscado, responsabilidades, conocimientos técnicos y beneficios..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="cerrarModalCrear()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Publicar</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDITAR OFERTA -->
<div class="modal-backdrop" id="modalEditar">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Editar Vacante</h3>
            <button class="modal-close" onclick="cerrarModalEditar()">&times;</button>
        </div>
        <form method="POST">
            <div class="modal-body">
                <input type="hidden" name="accion" value="editar">
                <input type="hidden" name="id_oferta" id="edit_id_oferta" value="">
                
                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label class="form-label" for="titulo_editar">Título del Puesto <span style="color:var(--danger)">*</span></label>
                    <input type="text" class="form-input" name="titulo" id="titulo_editar" required>
                </div>

                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label class="form-label" for="tipo_contrato_editar">Tipo de Contrato <span style="color:var(--danger)">*</span></label>
                    <select class="form-select" name="tipo_contrato" id="tipo_contrato_editar" required>
                        <option value="Tiempo completo">Tiempo Completo</option>
                        <option value="Medio tiempo">Medio Tiempo</option>
                        <option value="Temporal">Temporal</option>
                        <option value="Freelance">Freelance</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="descripcion_editar">Descripción del Puesto <span style="color:var(--danger)">*</span></label>
                    <textarea class="form-input form-textarea" name="descripcion" id="descripcion_editar" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="cerrarModalEditar()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

<script>
// Modal Crear
function abrirModalCrear() {
    document.getElementById('modalCrear').classList.add('open');
}
function cerrarModalCrear() {
    document.getElementById('modalCrear').classList.remove('open');
}

// Modal Editar
function abrirModalEditar(id, titulo, tipo, descripcion) {
    document.getElementById('edit_id_oferta').value = id;
    document.getElementById('titulo_editar').value = titulo;
    document.getElementById('tipo_contrato_editar').value = tipo;
    document.getElementById('descripcion_editar').value = descripcion;
    document.getElementById('modalEditar').classList.add('open');
}
function cerrarModalEditar() {
    document.getElementById('modalEditar').classList.remove('open');
}

// Confirmar Eliminación con SweetAlert2
function confirmarEliminar(id, titulo) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: `Estás a punto de eliminar la vacante "${titulo}". Esta acción no se puede deshacer.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete_id_oferta').value = id;
            document.getElementById('form-eliminar').submit();
        }
    });
}

// Cerrar modales clickeando fuera
document.querySelectorAll('.modal-backdrop').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('open');
        }
    });
});
</script>
