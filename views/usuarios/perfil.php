<?php
    require_once __DIR__ . '/../../vendor/autoload.php';

    use App\models\Usuario;
    use App\models\Experiencia;
    use App\models\Habilidad;
    use App\models\Estudio;
    use App\models\Referencia;

    $id_usuario = $_SESSION['userAuth']['id'] ?? 0;

    $perfil = [];
    $experiencia = null;
    $habilidad = null;
    $estudios = [];
    $referencias = [];

    if ($id_usuario > 0) {
        $perfil = Usuario::obtenerPerfilDetallado($id_usuario);
        
        $experiencias = Experiencia::mostrarExperiencias($id_usuario);
        $experiencia = !empty($experiencias) ? $experiencias[0] : null;

        $habilidades = Habilidad::mostrarHabilidades($id_usuario);
        $habilidad = !empty($habilidades) ? $habilidades[0] : null;

        $estudios = Estudio::mostrarEstudios($id_usuario);
        
        $referencias = Referencia::mostrarReferencias($id_usuario);
    }
?>

<div class="perfil-container">

    <!-- ===========================
         PERFIL PRINCIPAL
    ============================ -->
    <div class="perfil-card">

        <!-- AVATAR (inicial del nombre) -->
        <div class="perfil-avatar">
            <?= strtoupper(substr($perfil['nombre'] ?? 'U', 0, 1)) ?>
        </div>

        <div class="perfil-nombre">
            <?= htmlspecialchars(($perfil['nombre'] ?? '') . ' ' . ($perfil['apellido'] ?? '')) ?>
        </div>

        <div class="perfil-profesion">
            <?= htmlspecialchars($perfil['profesion'] ?? 'Profesión no registrada') ?>
        </div>

        <div class="perfil-ubicacion font-medium" style="color: var(--text-muted);">
            <?php if (!empty($perfil['departamento']) || !empty($perfil['municipio'])): ?>
                📍 <?= htmlspecialchars(($perfil['departamento'] ?? '') . ', ' . ($perfil['municipio'] ?? '') . ', ' . ($perfil['distrito'] ?? '')) ?>
            <?php else: ?>
                Ubicación no registrada
            <?php endif; ?>
        </div>

        <button class="btn-editar" onclick="location.href='index.php?pagina=curriculum'">
            Editar Currículum
        </button>
    </div>

    <!-- ===========================
         ACERCA DE
    ============================ -->
    <div class="seccion">
        <h3>Datos de Contacto</h3>
        <p><strong>Correo electrónico:</strong> <?= htmlspecialchars($perfil['correo'] ?? 'No disponible') ?></p>
        <p><strong>Teléfono:</strong> <?= htmlspecialchars($perfil['telefono'] ?? 'No disponible') ?></p>
        <p><strong>Nacionalidad:</strong> <?= htmlspecialchars($perfil['nacionalidad'] ?? 'No disponible') ?></p>
        <p><strong>Género:</strong> <?= htmlspecialchars($perfil['genero'] ?? 'No disponible') ?></p>
    </div>

    <!-- ===========================
         EXPERIENCIA
    ============================ -->
    <div class="seccion">
        <h3>Experiencia</h3>

        <?php if (!empty($experiencia)): ?>
            <p><strong>Puesto:</strong> <?= htmlspecialchars($experiencia['puesto']) ?></p>
            <p><strong>Empresa:</strong> <?= htmlspecialchars($experiencia['empresa']) ?></p>
            <p><strong>Periodo:</strong> <?= htmlspecialchars($experiencia['fecha_inicio']) ?> — <?= htmlspecialchars($experiencia['fecha_fin'] ?? 'Presente') ?></p>
            <p><?= nl2br(htmlspecialchars($experiencia['descripcion'])) ?></p>
        <?php else: ?>
            <p style="color: var(--text-muted); font-style: italic;">No hay experiencia registrada.</p>
        <?php endif; ?>
    </div>

    <!-- ===========================
         HABILIDADES
    ============================ -->
    <div class="seccion">
        <h3>Habilidades</h3>
        <p><?= htmlspecialchars($habilidad['habilidad'] ?? 'No hay habilidades registradas.') ?></p>
    </div>

    <!-- ===========================
         ESTUDIOS
    ============================ -->
    <div class="seccion">
        <h3>Estudios</h3>

        <?php if (!empty($estudios)): ?>
            <?php foreach ($estudios as $e): ?>
                <p><strong>Nivel:</strong> <?= htmlspecialchars($e['nivel_academico'] ?? 'No disponible') ?></p>
                <p><strong>Título:</strong> <?= htmlspecialchars($e['titulo'] ?? $e['carrera'] ?? 'No disponible') ?></p>
                <p><strong>Institución:</strong> <?= htmlspecialchars($e['institucion'] ?? 'No disponible') ?></p>
                <?php if (!empty($e['fecha_logro'])): ?>
                    <p><strong>Fecha de logro:</strong> <?= htmlspecialchars($e['fecha_logro']) ?></p>
                <?php else: ?>
                    <p><strong>Periodo:</strong> <?= htmlspecialchars(($e['fecha_inicio'] ?? '') . ' — ' . ($e['fecha_fin'] ?? '')) ?></p>
                <?php endif; ?>
                <p><strong>Estado:</strong> <?= htmlspecialchars($e['estado'] ?? 'No disponible') ?></p>
                <?php if (!empty($e['descripcion'])): ?>
                    <p><?= nl2br(htmlspecialchars($e['descripcion'])) ?></p>
                <?php endif; ?>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color: var(--text-muted); font-style: italic;">No hay estudios registrados.</p>
        <?php endif; ?>
    </div>

    <!-- ===========================
         REFERENCIAS
    ============================ -->
    <div class="seccion">
        <h3>Referencias</h3>

        <?php if (!empty($referencias)): ?>
            <?php foreach ($referencias as $r): ?>
                <p><strong>Nombre:</strong> <?= htmlspecialchars($r['nombre_referencia'] ?? $r['nombre'] ?? 'No disponible') ?></p>
                <p><strong>Teléfono:</strong> <?= htmlspecialchars($r['telefono_contacto'] ?? $r['telefono'] ?? 'No disponible') ?></p>
                <p><strong>Correo:</strong> <?= htmlspecialchars($r['correo_contacto'] ?? $r['correo'] ?? 'No disponible') ?></p>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color: var(--text-muted); font-style: italic;">No hay referencias registradas.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
