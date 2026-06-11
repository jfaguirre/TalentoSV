<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\controller\UsuarioControlador;
use App\controller\ExperienciaControlador;
use App\controller\HabilidadControlador;
use App\controller\EstudioControlador;
use App\controller\ReferenciaControlador;

// ID del usuario logueado
$id_usuario = $_SESSION['userAuth']['id'] ?? null;

if (!$id_usuario) {
    echo "<h2>Error: No has iniciado sesión.</h2>";
    exit;
}

/* ============================
   DATOS PERSONALES + UBICACIÓN
============================ */
$perfil = \App\models\Usuario::obtenerPerfilDetallado($id_usuario);

$nombre = $perfil['nombre'] ?? '';
$apellido = $perfil['apellido'] ?? '';
$nombreCompleto = trim($nombre . ' ' . $apellido);
$inicial = strtoupper(substr($nombre, 0, 1));

/* ============================
   EXPERIENCIA
============================ */
$experiencias = ExperienciaControlador::mostrarExperiencias();

/* ============================
   HABILIDADES
============================ */
$habilidades = HabilidadControlador::mostrarHabilidades();

/* ============================
   ESTUDIOS
============================ */
$estudios = EstudioControlador::mostrarEstudios();

/* ============================
   REFERENCIAS
============================ */
$referencias = ReferenciaControlador::mostrarReferencias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mi Perfil</title>

<style>
/* ============================
   ESTILOS GENERALES
============================ */
body {
    font-family: Arial, sans-serif;
    background: #f4f4f9;
    margin: 0;
    padding: 20px;
}
.perfil-container {
    max-width: 900px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.avatar {
    width: 120px;
    height: 120px;
    background: #4f46e5;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 50px;
    margin-bottom: 10px;
}
.section {
    margin-top: 30px;
}
.section h2 {
    color: #4f46e5;
    border-bottom: 2px solid #ddd;
    padding-bottom: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.item {
    margin-top: 10px;
    padding: 10px;
    background: #fafafa;
    border-radius: 8px;
}

/* ============================
   BOTONES
============================ */
.btn-add, .btn-edit, .btn-delete {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-left: 5px;
}
.btn-add { background: #4f46e5; color: white; }
.btn-edit { background: #10b981; color: white; }
.btn-delete { background: #ef4444; color: white; }

/* ============================
   MODALES
============================ */
.modal {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.4);
    justify-content: center;
    align-items: center;
}
.modal-content {
    background: white;
    padding: 20px;
    width: 400px;
    border-radius: 10px;
}
.modal-content input,
.modal-content textarea,
.modal-content select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 15px;
}
.modal-content button {
    padding: 8px 15px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
</style>
</head>

<body>

<div class="perfil-container">

    <!-- ENCABEZADO -->
    <div style="text-align:center;">
        <div class="avatar"><?= $inicial ?></div>
        <h1><?= $nombreCompleto ?></h1>
        <p><?= $perfil['profesion'] ?? 'Profesión no registrada' ?></p>
    </div>

    <!-- DATOS PERSONALES -->
    <div class="section">
        <h2>
            Datos personales
            <button class="btn-edit" onclick="openModal('modalEditarPerfil')">Editar</button>
        </h2>

        <p><strong>Correo:</strong> <?= $perfil['correo'] ?></p>
        <p><strong>Teléfono:</strong> <?= $perfil['telefono'] ?? 'No registrado' ?></p>
        <p><strong>Género:</strong> <?= $perfil['genero'] ?? 'No registrado' ?></p>
        <p><strong>Nacionalidad:</strong> <?= $perfil['nacionalidad'] ?? 'No registrada' ?></p>
    </div>

    <!-- UBICACIÓN COMPLETA -->
    <div class="section">
        <h2>Ubicación</h2>
        <p><strong>Departamento:</strong> <?= $perfil['departamento'] ?? 'No registrado' ?></p>
        <p><strong>Distrito:</strong> <?= $perfil['distrito'] ?? 'No registrado' ?></p>
        <p><strong>Municipio:</strong> <?= $perfil['municipio'] ?? 'No registrado' ?></p>
    </div>

    <!-- EXPERIENCIA -->
    <div class="section">
        <h2>
            Experiencia laboral
            <button class="btn-add" onclick="openModal('modalAgregarExperiencia')">Agregar</button>
        </h2>

        <?php if ($experiencias): ?>
            <?php foreach ($experiencias as $exp): ?>
                <div class="item">
                    <strong><?= $exp['puesto'] ?></strong> - <?= $exp['empresa'] ?><br>
                    <small><?= $exp['fecha_inicio'] ?> a <?= $exp['fecha_fin'] ?></small>
                    <p><?= $exp['descripcion'] ?></p>

                    <button class="btn-edit" onclick="openModalEditarExperiencia(<?= $exp['id_experiencia'] ?>)">Editar</button>

                    <form method="POST" action="index.php?pagina=perfil" style="display:inline;">
                        <input type="hidden" name="id_experiencia" value="<?= $exp['id_experiencia'] ?>">
                        <button class="btn-delete">Eliminar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay experiencia registrada.</p>
        <?php endif; ?>
    </div>

    <!-- HABILIDADES -->
    <div class="section">
        <h2>
            Habilidades
            <button class="btn-add" onclick="openModal('modalAgregarHabilidad')">Agregar</button>
        </h2>

        <?php if ($habilidades): ?>
            <?php foreach ($habilidades as $hab): ?>
                <div class="item">
                    <?= $hab['habilidad'] ?>

                    <form method="POST" action="index.php?pagina=perfil" style="display:inline;">
                        <input type="hidden" name="id_habilidad" value="<?= $hab['id_habilidad'] ?>">
                        <button class="btn-delete">Eliminar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay habilidades registradas.</p>
        <?php endif; ?>
    </div>

    <!-- ESTUDIOS -->
    <div class="section">
        <h2>
            Estudios
            <button class="btn-add" onclick="openModal('modalAgregarEstudio')">Agregar</button>
        </h2>

        <?php if ($estudios): ?>
            <?php foreach ($estudios as $e): ?>
                <div class="item">
                    <strong><?= $e['titulo'] ?></strong> - <?= $e['institucion'] ?><br>
                    <small><?= $e['fecha_logro'] ?> — <?= $e['estado'] ?></small>
                    <p><?= $e['descripcion'] ?></p>

                    <button class="btn-edit" onclick="openModalEditarEstudio(<?= $e['id_estudio'] ?>)">Editar</button>

                    <form method="POST" action="index.php?pagina=perfil" style="display:inline;">
                        <input type="hidden" name="id_estudio" value="<?= $e['id_estudio'] ?>">
                        <button class="btn-delete">Eliminar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay estudios registrados.</p>
        <?php endif; ?>
    </div>

    <!-- REFERENCIAS -->
    <div class="section">
        <h2>
            Referencias
            <button class="btn-add" onclick="openModal('modalAgregarReferencia')">Agregar</button>
        </h2>

        <?php if ($referencias): ?>
            <?php foreach ($referencias as $r): ?>
                <div class="item">
                    <strong><?= $r['nombre_referencia'] ?></strong><br>
                    <small>Tel: <?= $r['telefono_contacto'] ?></small><br>
                    <small>Email: <?= $r['correo_contacto'] ?></small>

                    <button class="btn-edit" onclick="openModalEditarReferencia(<?= $r['id_referencias'] ?>)">Editar</button>

                    <form method="POST" action="index.php?pagina=perfil" style="display:inline;">
                        <input type="hidden" name="id_referencia" value="<?= $r['id_referencias'] ?>">
                        <button class="btn-delete">Eliminar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay referencias registradas.</p>
        <?php endif; ?>
    </div>

</div>

<!-- ============================
     MODALES A–E
============================ -->

<!-- A — EDITAR PERFIL -->
<div id="modalEditarPerfil" class="modal">
    <div class="modal-content">
        <h3>Editar datos personales</h3>

        <form method="POST" action="index.php?pagina=perfil">
            <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">

            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= $perfil['nombre'] ?>">

            <label>Apellido</label>
            <input type="text" name="apellido" value="<?= $perfil['apellido'] ?>">

            <label>Teléfono</label>
            <input type="text" name="telefono" value="<?= $perfil['telefono'] ?>">

            <label>Nacionalidad</label>
            <input type="text" name="nacionalidad" value="<?= $perfil['nacionalidad'] ?>">

            <label>Género</label>
            <select name="genero">
                <option value="M" <?= $perfil['genero']=='M'?'selected':'' ?>>M</option>
                <option value="F" <?= $perfil['genero']=='F'?'selected':'' ?>>F</option>
            </select>

            <button type="submit" name="actualizar_perfil">Guardar cambios</button>
            <button type="button" onclick="closeModal('modalEditarPerfil')">Cancelar</button>
        </form>
    </div>
</div>

<!-- B — AGREGAR EXPERIENCIA -->
<div id="modalAgregarExperiencia" class="modal">
    <div class="modal-content">
        <h3>Agregar experiencia</h3>

        <form method="POST" action="index.php?pagina=perfil">
            <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">

            <label>Empresa</label>
            <input type="text" name="empresa">

            <label>Puesto</label>
            <input type="text" name="puesto">

            <label>Descripción</label>
            <textarea name="descripcion"></textarea>

            <label>Fecha inicio</label>
            <input type="date" name="fecha_inicio">

            <label>Fecha fin</label>
            <input type="date" name="fecha_fin">

            <button type="submit" name="crear_experiencia">Guardar</button>
            <button type="button" onclick="closeModal('modalAgregarExperiencia')">Cancelar</button>
        </form>
    </div>
</div>

<!-- B — EDITAR EXPERIENCIA -->
<div id="modalEditarExperiencia" class="modal">
    <div class="modal-content">
        <h3>Editar experiencia</h3>

        <form method="POST" action="index.php?pagina=perfil">
            <input type="hidden" id="edit_id_experiencia" name="id_experiencia">

            <label>Empresa</label>
            <input type="text" id="edit_empresa" name="empresa">

            <label>Puesto</label>
            <input type="text" id="edit_puesto" name="puesto">

            <label>Descripción</label>
            <textarea id="edit_descripcion" name="descripcion"></textarea>

            <label>Fecha inicio</label>
            <input type="date" id="edit_fecha_inicio" name="fecha_inicio">

            <label>Fecha fin</label>
            <input type="date" id="edit_fecha_fin" name="fecha_fin">

            <button type="submit" name="actualizar_experiencia">Guardar cambios</button>
            <button type="button" onclick="closeModal('modalEditarExperiencia')">Cancelar</button>
        </form>
    </div>
</div>

<!-- C — AGREGAR HABILIDAD -->
<div id="modalAgregarHabilidad" class="modal">
    <div class="modal-content">
        <h3>Agregar habilidad</h3>

        <form method="POST" action="index.php?pagina=perfil">
            <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">

            <label>Habilidad</label>
            <input type="text" name="habilidad">

            <button type="submit" name="crear_habilidad">Guardar</button>
            <button type="button" onclick="closeModal('modalAgregarHabilidad')">Cancelar</button>
        </form>
    </div>
</div>

<!-- D — AGREGAR ESTUDIO -->
<div id="modalAgregarEstudio" class="modal">
    <div class="modal-content">
        <h3>Agregar estudio</h3>

        <form method="POST" action="index.php?pagina=perfil">
            <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">

            <label>Título</label>
            <input type="text" name="titulo">

            <label>Institución</label>
            <input type="text" name="institucion">

            <label>Fecha logro</label>
            <input type="date" name="fecha_logro">

            <label>Estado</label>
            <input type="text" name="estado">

            <label>Descripción</label>
            <textarea name="descripcion"></textarea>

            <button type="submit" name="crear_estudio">Guardar</button>
            <button type="button" onclick="closeModal('modalAgregarEstudio')">Cancelar</button>
        </form>
    </div>
</div>

<!-- D — EDITAR ESTUDIO -->
<div id="modalEditarEstudio" class="modal">
    <div class="modal-content">
        <h3>Editar estudio</h3>

        <form method="POST" action="index.php?pagina=perfil">
            <input type="hidden" id="edit_id_estudio" name="id_estudio">

            <label>Título</label>
            <input type="text" id="edit_titulo" name="titulo">

            <label>Institución</label>
            <input type="text" id="edit_institucion" name="institucion">

            <label>Fecha logro</label>
            <input type="date" id="edit_fecha_logro" name="fecha_logro">

            <label>Estado</label>
            <input type="text" id="edit_estado" name="estado">

            <label>Descripción</label>
            <textarea id="edit_descripcion" name="descripcion"></textarea>

            <button type="submit" name="actualizar_estudio">Guardar cambios</button>
            <button type="button" onclick="closeModal('modalEditarEstudio')">Cancelar</button>
        </form>
    </div>
</div>

<!-- E — AGREGAR REFERENCIA -->
<div id="modalAgregarReferencia" class="modal">
    <div class="modal-content">
        <h3>Agregar referencia</h3>

        <form method="POST" action="index.php?pagina=perfil">
            <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">

            <label>Nombre</label>
            <input type="text" name="nombre_referencia">

            <label>Teléfono</label>
            <input type="text" name="telefono_contacto">

            <label>Correo</label>
            <input type="email" name="correo_contacto">

            <button type="submit" name="crear_referencia">Guardar</button>
            <button type="button" onclick="closeModal('modalAgregarReferencia')">Cancelar</button>
        </form>
    </div>
</div>

<!-- E — EDITAR REFERENCIA -->
<div id="modalEditarReferencia" class="modal">
    <div class="modal-content">
        <h3>Editar referencia</h3>

        <form method="POST" action="index.php?pagina=perfil">
            <input type="hidden"
                id="edit_id_referencia"
                name="id_referencia"
            >           
            <label>Nombre</label>
            <input type="text" id="edit_nombre_referencia" name="nombre_referencia          ">              
            <label>Teléfono</label> 
            <input type="text" id="edit_telefono_contacto" name="telefono_contacto">        
            <label>Correo</label>
            <input type="email" id="edit_correo_contacto" name="correo_contacto">   
            <button type="submit" name="actualizar_referencia">Guardar cambios</button>
            <button type="button" onclick="closeModal('modalEditarReferencia')">Cancelar</button>
        </form> 
    </div>
</div>
<script>
// ===============================
// ABRIR Y CERRAR MODALES
// ===============================
function openModal(id) {
    document.getElementById(id).style.display = "flex"
}

function closeModal(id) {
    document.getElementById(id).style.display = "none"
}

// Cerrar modal al hacer clic fuera
window.onclick = function(e) {
    const modals = document.querySelectorAll(".modal")
    modals.forEach(modal => {
        if (e.target === modal) {
            modal.style.display = "none"
        }
    })
}



// ===============================
// EDITAR EXPERIENCIA
// ===============================
function openModalEditarExperiencia(id) {
    // Buscar el div de la experiencia
    const item = document.querySelector(`[data-exp="${id}"]`)

    // Cargar datos en el modal
    document.getElementById("edit_id_experiencia").value = id
    document.getElementById("edit_empresa").value = item.dataset.empresa
    document.getElementById("edit_puesto").value = item.dataset.puesto
    document.getElementById("edit_descripcion").value = item.dataset.descripcion
    document.getElementById("edit_fecha_inicio").value = item.dataset.inicio
    document.getElementById("edit_fecha_fin").value = item.dataset.fin

    openModal("modalEditarExperiencia")
}



// ===============================
// EDITAR ESTUDIO
// ===============================
function openModalEditarEstudio(id) {
    const item = document.querySelector(`[data-est="${id}"]`)

    document.getElementById("edit_id_estudio").value = id
    document.getElementById("edit_titulo").value = item.dataset.titulo
    document.getElementById("edit_institucion").value = item.dataset.institucion
    document.getElementById("edit_fecha_logro").value = item.dataset.fecha
    document.getElementById("edit_estado").value = item.dataset.estado
    document.getElementById("edit_descripcion").value = item.dataset.descripcion

    openModal("modalEditarEstudio")
}



// ===============================
// EDITAR REFERENCIA
// ===============================
function openModalEditarReferencia(id) {
    const item = document.querySelector(`[data-ref="${id}"]`)

    document.getElementById("edit_id_referencia").value = id
    document.getElementById("edit_nombre_referencia").value = item.dataset.nombre
    document.getElementById("edit_telefono_contacto").value = item.dataset.telefono
    document.getElementById("edit_correo_contacto").value = item.dataset.correo

    openModal("modalEditarReferencia")
}
</script>
</body>
</html>