<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use App\controller\UsuarioControlador;
use App\controller\ExperienciaControlador;
use App\controller\EstudioControlador;
use App\controller\HabilidadControlador;
use App\controller\ReferenciaControlador;
use App\models\Usuario;
use App\models\Ubicacion;

$id_usuario = $_SESSION['userAuth']['id'] ?? null;
if (!$id_usuario) {
    header("Location: index.php?pagina=ingreso");
    exit;
}

// Instanciar controladores
$usuarioCtrl = new UsuarioControlador();
$experienciaCtrl = new ExperienciaControlador();
$estudioCtrl = new EstudioControlador();
$habilidadCtrl = new HabilidadControlador();
$referenciaCtrl = new ReferenciaControlador();

// PROCESAR ACCIONES POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['actualizar_perfil'])) {
        $usuarioCtrl->actualizarUsuario($id_usuario);
    } elseif (isset($_POST['crear_experiencia'])) {
        $experienciaCtrl->crearExperiencia();
    } elseif (isset($_POST['actualizar_experiencia'])) {
        $id_exp = (int)($_POST['id_experiencia'] ?? 0);
        $experienciaCtrl->actualizarExperiencia($id_exp);
    } elseif (isset($_POST['eliminar_experiencia'])) {
        $experienciaCtrl->eliminarExperiencia();
    } elseif (isset($_POST['crear_estudio'])) {
        $estudioCtrl->crearEstudio();
    } elseif (isset($_POST['actualizar_estudio'])) {
        $id_est = (int)($_POST['id_estudio'] ?? 0);
        $estudioCtrl->actualizarEstudio($id_est);
    } elseif (isset($_POST['eliminar_estudio'])) {
        $estudioCtrl->eliminarEstudio();
    } elseif (isset($_POST['crear_habilidad'])) {
        $habilidadCtrl->crearHabilidad();
    } elseif (isset($_POST['actualizar_habilidad'])) {
        $id_hab = (int)($_POST['id_habilidad'] ?? 0);
        $habilidadCtrl->actualizarHabilidad($id_hab);
    } elseif (isset($_POST['eliminar_habilidad'])) {
        $habilidadCtrl->eliminarHabilidad();
    } elseif (isset($_POST['crear_referencia'])) {
        $referenciaCtrl->crearReferencia();
    } elseif (isset($_POST['actualizar_referencia'])) {
        $id_ref = (int)($_POST['id_referencia'] ?? 0);
        $referenciaCtrl->actualizarReferencia($id_ref);
    } elseif (isset($_POST['eliminar_referencia'])) {
        $referenciaCtrl->eliminarReferencia();
    }
}

// CARGAR DATOS PARA LA VISTA
$perfil = Usuario::obtenerPerfilDetallado($id_usuario);
$experiencias = ExperienciaControlador::mostrarExperiencias();
$estudios = EstudioControlador::mostrarEstudios();
$habilidades = HabilidadControlador::mostrarHabilidades();
$referencias = ReferenciaControlador::mostrarReferencias();

$listaDepartamentos = Ubicacion::obtenerDepartamentos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - TalentoSV</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        .perfil-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .perfil-foto {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background-color: #ddd;
            background-size: cover;
            background-position: center;
        }
        .perfil-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        .item-card {
            border-left: 4px solid #0d6efd;
            background: #f8f9ff;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 8px;
        }
        .item-title {
            font-weight: 600;
        }
        .item-meta {
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container py-4">

    <!-- ENCABEZADO PERFIL -->
    <div class="perfil-card mb-3">
        <div class="perfil-header">
            <div class="perfil-foto"
                 style="background-image: url('<?= !empty($perfil['foto']) ? htmlspecialchars($perfil['foto']) : 'https://via.placeholder.com/90' ?>');">
            </div>
            <div>
                <h3 class="mb-1">
                    <?= htmlspecialchars(($perfil['nombre'] ?? '') . ' ' . ($perfil['apellido'] ?? '')) ?>
                </h3>
                <p class="mb-1 text-muted">
                    <?= htmlspecialchars($perfil['profesion'] ?? 'Sin profesión registrada') ?>
                </p>
                <p class="mb-0">
                    <strong>Correo:</strong> <?= htmlspecialchars($perfil['correo'] ?? '') ?><br>
                    <strong>Teléfono:</strong> <?= htmlspecialchars($perfil['telefono'] ?? 'No registrado') ?>
                </p>
            </div>
            <div class="ms-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">
                    Editar perfil
                </button>
            </div>
        </div>
    </div>

    <!-- DATOS PERSONALES / UBICACIÓN -->
    <div class="row">
        <div class="col-md-6">
            <div class="perfil-card">
                <div class="section-title">Datos personales</div>
                <p><strong>Nombre:</strong> <?= htmlspecialchars(($perfil['nombre'] ?? '') . ' ' . ($perfil['apellido'] ?? '')) ?></p>
                <p><strong>Correo:</strong> <?= htmlspecialchars($perfil['correo'] ?? '') ?></p>
                <p><strong>Nacionalidad:</strong> <?= htmlspecialchars($perfil['nacionalidad'] ?? 'No registrada') ?></p>
                <p><strong>Género:</strong> <?= htmlspecialchars($perfil['genero'] ?? 'No registrado') ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="perfil-card">
                <div class="section-title">Ubicación</div>
                <p><strong>Departamento:</strong> <?= htmlspecialchars($perfil['departamento'] ?? 'No registrado') ?></p>
                <p><strong>Distrito:</strong> <?= htmlspecialchars($perfil['distrito'] ?? 'No registrado') ?></p>
                <p><strong>Municipio:</strong> <?= htmlspecialchars($perfil['municipio'] ?? 'No registrado') ?></p>
            </div>
        </div>
    </div>

    <!-- EXPERIENCIA -->
    <div class="perfil-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="section-title mb-0">Experiencia laboral</div>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCrearExperiencia">
                Agregar experiencia
            </button>
        </div>

        <?php if (!empty($experiencias)): ?>
            <?php foreach ($experiencias as $exp): ?>
                <div class="item-card">
                    <div class="item-title"><?= htmlspecialchars($exp['puesto'] ?? '') ?> - <?= htmlspecialchars($exp['empresa'] ?? '') ?></div>
                    <div class="item-meta">
                        <?= htmlspecialchars($exp['fecha_inicio'] ?? '') ?> a <?= htmlspecialchars($exp['fecha_fin'] ?? 'Actual') ?><br>
                        <?= nl2br(htmlspecialchars($exp['descripcion'] ?? '')) ?>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-sm btn-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarExperiencia"
                                data-id="<?= $exp['id_experiencia'] ?>"
                                data-puesto="<?= htmlspecialchars($exp['puesto'] ?? '', ENT_QUOTES) ?>"
                                data-empresa="<?= htmlspecialchars($exp['empresa'] ?? '', ENT_QUOTES) ?>"
                                data-fecha_inicio="<?= htmlspecialchars($exp['fecha_inicio'] ?? '') ?>"
                                data-fecha_fin="<?= htmlspecialchars($exp['fecha_fin'] ?? '') ?>"
                                data-descripcion="<?= htmlspecialchars($exp['descripcion'] ?? '', ENT_QUOTES) ?>">
                            Editar
                        </button>
                        <form method="POST" action="" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta experiencia?');">
                            <input type="hidden" name="eliminar_experiencia" value="1">
                            <input type="hidden" name="id_experiencia" value="<?= $exp['id_experiencia'] ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted mb-0">Aún no has registrado experiencia laboral.</p>
        <?php endif; ?>
    </div>

    <!-- ESTUDIOS -->
    <div class="perfil-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="section-title mb-0">Formación académica</div>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCrearEstudio">
                Agregar estudio
            </button>
        </div>

        <?php if (!empty($estudios)): ?>
            <?php foreach ($estudios as $est): ?>
                <div class="item-card">
                    <div class="item-title"><?= htmlspecialchars($est['titulo'] ?? '') ?> - <?= htmlspecialchars($est['institucion'] ?? '') ?></div>
                    <div class="item-meta">
                        <strong>Nivel:</strong> <?= htmlspecialchars($est['nivel_academico'] ?? 'No especificado') ?><br>
                        <strong>Fecha Logro:</strong> <?= htmlspecialchars($est['fecha_logro'] ?? 'No especificada') ?><br>
                        <strong>Estado:</strong> <?= htmlspecialchars($est['estado'] ?? 'Finalizado') ?><br>
                        <?= nl2br(htmlspecialchars($est['descripcion'] ?? '')) ?>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-sm btn-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarEstudio"
                                data-id="<?= $est['id_estudio'] ?>"
                                data-titulo="<?= htmlspecialchars($est['titulo'] ?? '', ENT_QUOTES) ?>"
                                data-nivel_academico="<?= htmlspecialchars($est['nivel_academico'] ?? '', ENT_QUOTES) ?>"
                                data-institucion="<?= htmlspecialchars($est['institucion'] ?? '', ENT_QUOTES) ?>"
                                data-fecha_logro="<?= htmlspecialchars($est['fecha_logro'] ?? '') ?>"
                                data-estado="<?= htmlspecialchars($est['estado'] ?? '') ?>"
                                data-descripcion="<?= htmlspecialchars($est['descripcion'] ?? '', ENT_QUOTES) ?>">
                            Editar
                        </button>
                        <form method="POST" action="" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este estudio?');">
                            <input type="hidden" name="eliminar_estudio" value="1">
                            <input type="hidden" name="id_estudio" value="<?= $est['id_estudio'] ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted mb-0">Aún no has registrado estudios.</p>
        <?php endif; ?>
    </div>

    <!-- HABILIDADES -->
    <div class="perfil-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="section-title mb-0">Habilidades</div>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCrearHabilidad">
                Agregar habilidad
            </button>
        </div>

        <?php if (!empty($habilidades)): ?>
            <div class="d-flex flex-wrap gap-2">
                <?php foreach ($habilidades as $hab): ?>
                    <div class="badge bg-primary p-2 d-flex align-items-center gap-2" style="font-size: 0.9rem;">
                        <span><?= htmlspecialchars($hab['habilidad'] ?? '') ?></span>
                        <div class="d-flex gap-1">
                            <button class="btn btn-xs p-0 text-white" 
                                    style="font-size: 0.8rem;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditarHabilidad"
                                    data-id="<?= $hab['id_habilidad'] ?>"
                                    data-habilidad="<?= htmlspecialchars($hab['habilidad'] ?? '', ENT_QUOTES) ?>">
                                ✏️
                            </button>
                            <form method="POST" action="" class="d-inline m-0 p-0" onsubmit="return confirm('¿Eliminar habilidad?');">
                                <input type="hidden" name="eliminar_habilidad" value="1">
                                <input type="hidden" name="id_habilidad" value="<?= $hab['id_habilidad'] ?>">
                                <button type="submit" class="btn btn-xs p-0 text-white" style="font-size: 0.8rem; border: none; background: transparent;">
                                    ❌
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted mb-0">Aún no has registrado habilidades.</p>
        <?php endif; ?>
    </div>

    <!-- REFERENCIAS -->
    <div class="perfil-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="section-title mb-0">Referencias</div>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCrearReferencia">
                Agregar referencia
            </button>
        </div>

        <?php if (!empty($referencias)): ?>
            <?php foreach ($referencias as $ref): ?>
                <div class="item-card">
                    <div class="item-title"><?= htmlspecialchars($ref['nombre_referencia'] ?? '') ?></div>
                    <div class="item-meta">
                        <strong>Teléfono:</strong> <?= htmlspecialchars($ref['telefono_contacto'] ?? 'No registrado') ?><br>
                        <strong>Correo:</strong> <?= htmlspecialchars($ref['correo_contacto'] ?? 'No registrado') ?>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-sm btn-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarReferencia"
                                data-id="<?= $ref['id_referencia'] ?>"
                                data-nombre="<?= htmlspecialchars($ref['nombre_referencia'] ?? '', ENT_QUOTES) ?>"
                                data-telefono="<?= htmlspecialchars($ref['telefono_contacto'] ?? '', ENT_QUOTES) ?>"
                                data-correo="<?= htmlspecialchars($ref['correo_contacto'] ?? '', ENT_QUOTES) ?>">
                            Editar
                        </button>
                        <form method="POST" action="" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta referencia?');">
                            <input type="hidden" name="eliminar_referencia" value="1">
                            <input type="hidden" name="id_referencia" value="<?= $ref['id_referencia'] ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted mb-0">Aún no has registrado referencias.</p>
        <?php endif; ?>
    </div>

</div>

<!-- ============================
     MODAL EDITAR PERFIL
============================= -->
<div class="modal fade" id="modalEditarPerfil" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="">
                <input type="hidden" name="actualizar_perfil" value="1">
                <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($id_usuario) ?>">

                <div class="modal-header">
                    <h5 class="modal-title">Editar perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <h6>Datos personales</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control"
                                   value="<?= htmlspecialchars($perfil['nombre'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label>Apellido</label>
                            <input type="text" name="apellido" class="form-control"
                                   value="<?= htmlspecialchars($perfil['apellido'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Correo</label>
                            <input type="email" name="correo" class="form-control"
                                   value="<?= htmlspecialchars($perfil['correo'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label>Contraseña (opcional)</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control"
                                   value="<?= htmlspecialchars($perfil['telefono'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Nacionalidad</label>
                            <input type="text" name="nacionalidad" class="form-control"
                                   value="<?= htmlspecialchars($perfil['nacionalidad'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Género</label>
                            <select name="genero" class="form-control">
                                <option value="">Seleccione</option>
                                <option value="M" <?= ($perfil['genero'] ?? '') === 'M' ? 'selected' : '' ?>>Masculino</option>
                                <option value="F" <?= ($perfil['genero'] ?? '') === 'F' ? 'selected' : '' ?>>Femenino</option>
                                <option value="O" <?= ($perfil['genero'] ?? '') === 'O' ? 'selected' : '' ?>>Otro</option>
                            </select>
                        </div>
                    </div>

                    <hr class="mt-4 mb-3">

                    <h6>Ubicación</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="perfil_departamento">Departamento</label>
                            <select id="perfil_departamento" name="id_departamento" class="form-control">
                                <option value="">Seleccione</option>
                                <?php foreach ($listaDepartamentos as $d): ?>
                                    <option value="<?= $d['id_departamento'] ?>"
                                        <?= ($perfil['id_departamento'] ?? null) == $d['id_departamento'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($d['departamento']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="perfil_distrito">Distrito</label>
                            <select id="perfil_distrito" name="id_distrito" class="form-control" disabled>
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="perfil_municipio">Municipio</label>
                            <select id="perfil_municipio" name="id_municipio" class="form-control" disabled>
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>

                    <hr class="mt-4 mb-3">

                    <h6>Profesión</h6>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Profesión</label>
                            <input type="text" name="profesion" class="form-control"
                                   placeholder="Ej. Desarrollador Web, Ingeniero Civil"
                                   value="<?= htmlspecialchars($perfil['profesion'] ?? '') ?>">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================
     MODALES DE EXPERIENCIA / ESTUDIO / HABILIDAD / REFERENCIA
============================= -->

<!-- Crear experiencia -->
<div class="modal fade" id="modalCrearExperiencia" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <input type="hidden" name="crear_experiencia" value="1">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar experiencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Puesto</label>
                    <input type="text" name="puesto" class="form-control" required placeholder="Ej. Desarrollador Frontend">
                    <label class="mt-2">Empresa</label>
                    <input type="text" name="empresa" class="form-control" required placeholder="Ej. Tech Solutions">
                    <label class="mt-2">Fecha inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" required>
                    <label class="mt-2">Fecha fin (Dejar vacío si trabaja aquí actualmente)</label>
                    <input type="date" name="fecha_fin" class="form-control">
                    <label class="mt-2">Descripción</label>
                    <textarea name="descripcion" class="form-control" required placeholder="Describe tus responsabilidades y logros..."></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Editar experiencia -->
<div class="modal fade" id="modalEditarExperiencia" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <input type="hidden" name="actualizar_experiencia" value="1">
                <input type="hidden" name="id_experiencia" id="exp_id">
                <div class="modal-header">
                    <h5 class="modal-title">Editar experiencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Puesto</label>
                    <input type="text" name="puesto" id="exp_puesto" class="form-control" required>
                    <label class="mt-2">Empresa</label>
                    <input type="text" name="empresa" id="exp_empresa" class="form-control" required>
                    <label class="mt-2">Fecha inicio</label>
                    <input type="date" name="fecha_inicio" id="exp_fecha_inicio" class="form-control" required>
                    <label class="mt-2">Fecha fin (Dejar vacío si trabaja aquí actualmente)</label>
                    <input type="date" name="fecha_fin" id="exp_fecha_fin" class="form-control">
                    <label class="mt-2">Descripción</label>
                    <textarea name="descripcion" id="exp_descripcion" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Crear estudio -->
<div class="modal fade" id="modalCrearEstudio" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <input type="hidden" name="crear_estudio" value="1">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar estudio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Título / Título Obtenido</label>
                    <input type="text" name="titulo" class="form-control" required placeholder="Ej. Bachiller General, Ingeniería de Software">
                    
                    <label class="mt-2">Nivel Académico</label>
                    <input type="text" name="nivel_academico" class="form-control" required placeholder="Ej. Universidad, Bachillerato, Técnico">
                    
                    <label class="mt-2">Institución</label>
                    <input type="text" name="institucion" class="form-control" required placeholder="Ej. Universidad de El Salvador">
                    
                    <label class="mt-2">Fecha Logro (Graduación)</label>
                    <input type="date" name="fecha_logro" class="form-control">
                    
                    <label class="mt-2">Estado</label>
                    <select name="estado" class="form-control" required>
                        <option value="Finalizado">Finalizado</option>
                        <option value="En curso">En curso</option>
                        <option value="Suspendido">Suspendido</option>
                    </select>
                    
                    <label class="mt-2">Descripción (Opcional)</label>
                    <textarea name="descripcion" class="form-control" placeholder="Describe brevemente tus logros o materias cursadas..."></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Editar estudio -->
<div class="modal fade" id="modalEditarEstudio" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <input type="hidden" name="actualizar_estudio" value="1">
                <input type="hidden" name="id_estudio" id="est_id">
                <div class="modal-header">
                    <h5 class="modal-title">Editar estudio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Título / Título Obtenido</label>
                    <input type="text" name="titulo" id="est_titulo" class="form-control" required>
                    
                    <label class="mt-2">Nivel Académico</label>
                    <input type="text" name="nivel_academico" id="est_nivel_academico" class="form-control" required>
                    
                    <label class="mt-2">Institución</label>
                    <input type="text" name="institucion" id="est_institucion" class="form-control" required>
                    
                    <label class="mt-2">Fecha Logro (Graduación)</label>
                    <input type="date" name="fecha_logro" id="est_fecha_logro" class="form-control">
                    
                    <label class="mt-2">Estado</label>
                    <select name="estado" id="est_estado" class="form-control" required>
                        <option value="Finalizado">Finalizado</option>
                        <option value="En curso">En curso</option>
                        <option value="Suspendido">Suspendido</option>
                    </select>
                    
                    <label class="mt-2">Descripción (Opcional)</label>
                    <textarea name="descripcion" id="est_descripcion" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Crear habilidad -->
<div class="modal fade" id="modalCrearHabilidad" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <input type="hidden" name="crear_habilidad" value="1">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar habilidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Nombre de la habilidad</label>
                    <input type="text" name="habilidad" class="form-control" placeholder="Ej. JavaScript, Trabajo en equipo, Liderazgo" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Editar habilidad -->
<div class="modal fade" id="modalEditarHabilidad" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <input type="hidden" name="actualizar_habilidad" value="1">
                <input type="hidden" name="id_habilidad" id="hab_id">
                <div class="modal-header">
                    <h5 class="modal-title">Editar habilidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Nombre de la habilidad</label>
                    <input type="text" name="habilidad" id="hab_habilidad" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Crear referencia -->
<div class="modal fade" id="modalCrearReferencia" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <input type="hidden" name="crear_referencia" value="1">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar referencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Nombre Completo</label>
                    <input type="text" name="nombre_referencia" class="form-control" placeholder="Ej. Juan Pérez" required>
                    
                    <label class="mt-2">Teléfono de Contacto</label>
                    <input type="text" name="telefono_contacto" class="form-control" placeholder="Ej. 7777-7777">
                    
                    <label class="mt-2">Correo de Contacto</label>
                    <input type="email" name="correo_contacto" class="form-control" placeholder="Ej. juan.perez@example.com">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Editar referencia -->
<div class="modal fade" id="modalEditarReferencia" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <input type="hidden" name="actualizar_referencia" value="1">
                <input type="hidden" name="id_referencia" id="ref_id">
                <div class="modal-header">
                    <h5 class="modal-title">Editar referencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Nombre Completo</label>
                    <input type="text" name="nombre_referencia" id="ref_nombre" class="form-control" required>
                    
                    <label class="mt-2">Teléfono de Contacto</label>
                    <input type="text" name="telefono_contacto" id="ref_telefono" class="form-control">
                    
                    <label class="mt-2">Correo de Contacto</label>
                    <input type="email" name="correo_contacto" id="ref_correo" class="form-control">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Rellenar modal de experiencia
    const modalEditarExperiencia = document.getElementById('modalEditarExperiencia');
    if (modalEditarExperiencia) {
        modalEditarExperiencia.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('exp_id').value = button.getAttribute('data-id');
            document.getElementById('exp_puesto').value = button.getAttribute('data-puesto');
            document.getElementById('exp_empresa').value = button.getAttribute('data-empresa');
            document.getElementById('exp_fecha_inicio').value = button.getAttribute('data-fecha_inicio');
            document.getElementById('exp_fecha_fin').value = button.getAttribute('data-fecha_fin');
            document.getElementById('exp_descripcion').value = button.getAttribute('data-descripcion');
        });
    }

    // Rellenar modal de estudio
    const modalEditarEstudio = document.getElementById('modalEditarEstudio');
    if (modalEditarEstudio) {
        modalEditarEstudio.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('est_id').value = button.getAttribute('data-id');
            document.getElementById('est_titulo').value = button.getAttribute('data-titulo');
            document.getElementById('est_nivel_academico').value = button.getAttribute('data-nivel_academico');
            document.getElementById('est_institucion').value = button.getAttribute('data-institucion');
            document.getElementById('est_fecha_logro').value = button.getAttribute('data-fecha_logro');
            document.getElementById('est_estado').value = button.getAttribute('data-estado');
            document.getElementById('est_descripcion').value = button.getAttribute('data-descripcion');
        });
    }

    // Rellenar modal de habilidad
    const modalEditarHabilidad = document.getElementById('modalEditarHabilidad');
    if (modalEditarHabilidad) {
        modalEditarHabilidad.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('hab_id').value = button.getAttribute('data-id');
            document.getElementById('hab_habilidad').value = button.getAttribute('data-habilidad');
        });
    }

    // Rellenar modal de referencia
    const modalEditarReferencia = document.getElementById('modalEditarReferencia');
    if (modalEditarReferencia) {
        modalEditarReferencia.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('ref_id').value = button.getAttribute('data-id');
            document.getElementById('ref_nombre').value = button.getAttribute('data-nombre');
            document.getElementById('ref_telefono').value = button.getAttribute('data-telefono');
            document.getElementById('ref_correo').value = button.getAttribute('data-correo');
        });
    }

    // Ubicaciones geográficas dinámicas en el modal de editar perfil
    const deptoSelect = document.getElementById('perfil_departamento');
    const distSelect = document.getElementById('perfil_distrito');
    const munSelect = document.getElementById('perfil_municipio');

    const selectedDepto = <?= json_encode($perfil['id_departamento'] ?? null) ?>;
    const selectedDist = <?= json_encode($perfil['id_distrito'] ?? null) ?>;
    const selectedMun = <?= json_encode($perfil['id_municipio'] ?? null) ?>;

    if (deptoSelect) {
        if (selectedDepto) {
            cargarDistritos(selectedDepto, selectedDist);
        }

        deptoSelect.addEventListener('change', () => {
            cargarDistritos(deptoSelect.value);
        });

        distSelect.addEventListener('change', () => {
            cargarMunicipios(distSelect.value);
        });
    }

    function cargarDistritos(id_departamento, preselectId = null) {
        distSelect.innerHTML = '<option value="">Seleccione</option>';
        munSelect.innerHTML = '<option value="">Seleccione</option>';
        munSelect.disabled = true;

        if (!id_departamento) {
            distSelect.disabled = true;
            return;
        }

        fetch(`index.php?action=get_distritos&id_departamento=${id_departamento}`)
            .then(res => res.json())
            .then(data => {
                distSelect.disabled = false;
                data.forEach(item => {
                    const selected = (preselectId && item.id_distrito == preselectId) ? 'selected' : '';
                    distSelect.innerHTML += `<option value="${item.id_distrito}" ${selected}>${item.distrito}</option>`;
                });

                if (preselectId) {
                    cargarMunicipios(preselectId, selectedMun);
                }
            })
            .catch(err => console.error("Error cargando distritos:", err));
    }

    function cargarMunicipios(id_distrito, preselectId = null) {
        munSelect.innerHTML = '<option value="">Seleccione</option>';

        if (!id_distrito) {
            munSelect.disabled = true;
            return;
        }

        fetch(`index.php?action=get_municipios&id_distrito=${id_distrito}`)
            .then(res => res.json())
            .then(data => {
                munSelect.disabled = false;
                data.forEach(item => {
                    const selected = (preselectId && item.id_municipio == preselectId) ? 'selected' : '';
                    munSelect.innerHTML += `<option value="${item.id_municipio}" ${selected}>${item.municipio}</option>`;
                });
            })
            .catch(err => console.error("Error cargando municipios:", err));
    }
});
</script>

</body>
</html>
