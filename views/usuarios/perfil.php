<?php
// Asumo que PlantillaControlador ya te pasa:
// $perfil, $experiencias, $estudios, $habilidades, $referencias
// $listaDepartamentos, $listaDistritos, $listaMunicipios, $listaProfesiones
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - TalentoSV</title>

    <!-- Bootstrap CSS (si no lo tienes ya en la plantilla principal) -->
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
                 style="background-image: url('<?= !empty($perfil['foto']) ? $perfil['foto'] : 'https://via.placeholder.com/90' ?>');">
            </div>
            <div>
                <h3 class="mb-1">
                    <?= htmlspecialchars($perfil['nombre'] ?? '') ?>
                    <?= htmlspecialchars($perfil['apellido'] ?? '') ?>
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
                <p><strong>Nombre:</strong> <?= htmlspecialchars($perfil['nombre'] ?? '') ?> <?= htmlspecialchars($perfil['apellido'] ?? '') ?></p>
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
                        <?= htmlspecialchars($exp['fecha_inicio'] ?? '') ?> - <?= htmlspecialchars($exp['fecha_fin'] ?? 'Actual') ?><br>
                        <?= htmlspecialchars($exp['descripcion'] ?? '') ?>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-sm btn-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarExperiencia"
                                data-id="<?= $exp['id_experiencia'] ?>"
                                data-puesto="<?= htmlspecialchars($exp['puesto'] ?? '', ENT_QUOTES) ?>"
                                data-empresa="<?= htmlspecialchars($exp['empresa'] ?? '', ENT_QUOTES) ?>"
                                data-fecha_inicio="<?= $exp['fecha_inicio'] ?? '' ?>"
                                data-fecha_fin="<?= $exp['fecha_fin'] ?? '' ?>"
                                data-descripcion="<?= htmlspecialchars($exp['descripcion'] ?? '', ENT_QUOTES) ?>">
                            Editar
                        </button>
                        <form method="POST" action="" class="d-inline">
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
                        <?= htmlspecialchars($est['fecha_inicio'] ?? '') ?> - <?= htmlspecialchars($est['fecha_fin'] ?? 'Actual') ?><br>
                        <?= htmlspecialchars($est['descripcion'] ?? '') ?>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-sm btn-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarEstudio"
                                data-id="<?= $est['id_estudio'] ?>"
                                data-titulo="<?= htmlspecialchars($est['titulo'] ?? '', ENT_QUOTES) ?>"
                                data-institucion="<?= htmlspecialchars($est['institucion'] ?? '', ENT_QUOTES) ?>"
                                data-fecha_inicio="<?= $est['fecha_inicio'] ?? '' ?>"
                                data-fecha_fin="<?= $est['fecha_fin'] ?? '' ?>"
                                data-descripcion="<?= htmlspecialchars($est['descripcion'] ?? '', ENT_QUOTES) ?>">
                            Editar
                        </button>
                        <form method="POST" action="" class="d-inline">
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
            <?php foreach ($habilidades as $hab): ?>
                <div class="item-card">
                    <div class="item-title"><?= htmlspecialchars($hab['habilidad'] ?? '') ?></div>
                    <div class="item-meta">
                        Nivel: <?= htmlspecialchars($hab['nivel'] ?? '') ?>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-sm btn-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarHabilidad"
                                data-id="<?= $hab['id_habilidad'] ?>"
                                data-habilidad="<?= htmlspecialchars($hab['habilidad'] ?? '', ENT_QUOTES) ?>"
                                data-nivel="<?= htmlspecialchars($hab['nivel'] ?? '', ENT_QUOTES) ?>">
                            Editar
                        </button>
                        <form method="POST" action="" class="d-inline">
                            <input type="hidden" name="id_habilidad" value="<?= $hab['id_habilidad'] ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
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
                    <div class="item-title"><?= htmlspecialchars($ref['nombre'] ?? '') ?></div>
                    <div class="item-meta">
                        <?= htmlspecialchars($ref['cargo'] ?? '') ?> - <?= htmlspecialchars($ref['empresa'] ?? '') ?><br>
                        Tel: <?= htmlspecialchars($ref['telefono'] ?? '') ?>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-sm btn-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarReferencia"
                                data-id="<?= $ref['id_referencia'] ?>"
                                data-nombre="<?= htmlspecialchars($ref['nombre'] ?? '', ENT_QUOTES) ?>"
                                data-cargo="<?= htmlspecialchars($ref['cargo'] ?? '', ENT_QUOTES) ?>"
                                data-empresa="<?= htmlspecialchars($ref['empresa'] ?? '', ENT_QUOTES) ?>"
                                data-telefono="<?= htmlspecialchars($ref['telefono'] ?? '', ENT_QUOTES) ?>">
                            Editar
                        </button>
                        <form method="POST" action="" class="d-inline">
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
                <input type="hidden" name="id_usuario" value="<?= $_SESSION['userAuth']['id'] ?>">

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
                                <option value="Masculino" <?= ($perfil['genero'] ?? '') === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                                <option value="Femenino" <?= ($perfil['genero'] ?? '') === 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                                <option value="Otro" <?= ($perfil['genero'] ?? '') === 'Otro' ? 'selected' : '' ?>>Otro</option>
                            </select>
                        </div>
                    </div>

                    <hr class="mt-4 mb-3">

                    <h6>Ubicación</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Departamento</label>
                            <select name="id_departamento" class="form-control">
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
                            <label>Distrito</label>
                            <select name="id_distrito" class="form-control">
                                <option value="">Seleccione</option>
                                <?php foreach ($listaDistritos as $d): ?>
                                    <option value="<?= $d['id_distrito'] ?>"
                                        <?= ($perfil['id_distrito'] ?? null) == $d['id_distrito'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($d['distrito']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Municipio</label>
                            <select name="id_municipio" class="form-control">
                                <option value="">Seleccione</option>
                                <?php foreach ($listaMunicipios as $m): ?>
                                    <option value="<?= $m['id_municipio'] ?>"
                                        <?= ($perfil['id_municipio'] ?? null) == $m['id_municipio'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($m['municipio']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <hr class="mt-4 mb-3">

                    <h6>Profesión</h6>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Profesión</label>
                            <select name="id_profesion" class="form-control">
                                <option value="">Seleccione</option>
                                <?php foreach ($listaProfesiones as $p): ?>
                                    <option value="<?= $p['id_profesion'] ?>"
                                        <?= ($perfil['id_profesion'] ?? null) == $p['id_profesion'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($p['profesion']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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
     (solo estructura, tus controladores ya los manejan)
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
                    <input type="text" name="puesto" class="form-control" required>
                    <label class="mt-2">Empresa</label>
                    <input type="text" name="empresa" class="form-control" required>
                    <label class="mt-2">Fecha inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control">
                    <label class="mt-2">Fecha fin</label>
                    <input type="date" name="fecha_fin" class="form-control">
                    <label class="mt-2">Descripción</label>
                    <textarea name="descripcion" class="form-control"></textarea>
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
                    <input type="date" name="fecha_inicio" id="exp_fecha_inicio" class="form-control">
                    <label class="mt-2">Fecha fin</label>
                    <input type="date" name="fecha_fin" id="exp_fecha_fin" class="form-control">
                    <label class="mt-2">Descripción</label>
                    <textarea name="descripcion" id="exp_descripcion" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Crear / editar estudio, habilidad, referencia: puedes seguir el mismo patrón -->

<!-- Bootstrap JS (si no lo tienes ya en la plantilla principal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Rellenar modal de experiencia al hacer clic en "Editar"
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
</script>

</body>
</html>
