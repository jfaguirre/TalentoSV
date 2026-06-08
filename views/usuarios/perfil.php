<?php
    require_once __DIR__ . '/../../vendor/autoload.php';
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
            <?= $perfil['nombre'] ?? 'Nombre no disponible' ?>
        </div>

        <div class="perfil-profesion">
            <?= $perfil['profesion'] ?? 'Profesión no registrada' ?>
        </div>

        <div class="perfil-ubicacion">
            <?= $perfil['departamento'] ?? '' ?>,
            <?= $perfil['municipio'] ?? '' ?>,
            <?= $perfil['distrito'] ?? '' ?>
        </div>

        <button class="btn-editar" onclick="location.href='index.php?pagina=cv_ver_edit'">
            Editar Perfil
        </button>
    </div>

    <!-- ===========================
         ACERCA DE
    ============================ -->
    <div class="seccion">
        <h3>Acerca de</h3>
        <p><?= $perfil['acerca'] ?? 'El usuario aún no ha agregado una descripción.' ?></p>
    </div>

    <!-- ===========================
         EXPERIENCIA
    ============================ -->
    <div class="seccion">
        <h3>Experiencia</h3>

        <?php if (!empty($experiencia)): ?>
            <p><strong>Puesto:</strong> <?= $experiencia['puesto'] ?></p>
            <p><strong>Empresa:</strong> <?= $experiencia['empresa'] ?></p>
            <p><strong>Periodo:</strong> <?= $experiencia['fecha_inicio'] ?> — <?= $experiencia['fecha_fin'] ?></p>
            <p><?= $experiencia['descripcion'] ?></p>
        <?php else: ?>
            <p>No hay experiencia registrada.</p>
        <?php endif; ?>
    </div>

    <!-- ===========================
         HABILIDADES
    ============================ -->
    <div class="seccion">
        <h3>Habilidades</h3>
        <p><?= $habilidad['habilidad'] ?? 'No hay habilidades registradas.' ?></p>
    </div>

    <!-- ===========================
         ESTUDIOS
    ============================ -->
    <div class="seccion">
        <h3>Estudios</h3>

        <?php if (!empty($estudios)): ?>
            <?php foreach ($estudios as $e): ?>
                <p><strong>Nivel:</strong> <?= $e['nivel_academico'] ?></p>
                <p><strong>Carrera:</strong> <?= $e['carrera'] ?></p>
                <p><strong>Institución:</strong> <?= $e['institucion'] ?></p>
                <p><strong>Periodo:</strong> <?= $e['fecha_inicio'] ?> — <?= $e['fecha_fin'] ?></p>
                <p><strong>Estado:</strong> <?= $e['estado'] ?></p>
                <p><?= $e['descripcion'] ?></p>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay estudios registrados.</p>
        <?php endif; ?>
    </div>

    <!-- ===========================
         REFERENCIAS
    ============================ -->
    <div class="seccion">
        <h3>Referencias</h3>

        <?php if (!empty($referencias)): ?>
            <?php foreach ($referencias as $r): ?>
                <p><strong>Nombre:</strong> <?= $r['nombre'] ?></p>
                <p><strong>Teléfono:</strong> <?= $r['telefono'] ?></p>
                <p><strong>Correo:</strong> <?= $r['correo'] ?></p>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay referencias registradas.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
