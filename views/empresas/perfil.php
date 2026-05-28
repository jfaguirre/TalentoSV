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

$perfil = $controlador->gestionarPerfil($empresa_id);
?>

<div class="page-header">
    <h1 class="page-title">Perfil de Empresa</h1>
    <p class="page-subtitle">Modifica la información de presentación de tu marca empleadora.</p>
</div>

<div class="card">
    <h2 class="card-title">Información General</h2>
    
    <form action="" method="POST">
        <div class="form-grid">
            <!-- Nombre de Empresa -->
            <div class="form-group">
                <label class="form-label" for="nombre_empresa">Nombre de la Empresa <span style="color:var(--danger)">*</span></label>
                <input type="text" class="form-input" id="nombre_empresa" name="nombre_empresa" value="<?= htmlspecialchars($perfil['nombre_empresa'] ?? ''); ?>" required placeholder="Ej. Tech Solutions S.A. de C.V.">
            </div>

            <!-- Sector -->
            <div class="form-group">
                <label class="form-label" for="sector">Sector de Negocio</label>
                <input type="text" class="form-input" id="sector" name="sector" value="<?= htmlspecialchars($perfil['sector'] ?? ''); ?>" placeholder="Ej. Tecnología, Finanzas, Comercio, Educación">
            </div>

            <!-- Correo de Contacto -->
            <div class="form-group">
                <label class="form-label" for="correo_empresa">Correo Electrónico de Contacto <span style="color:var(--danger)">*</span></label>
                <input type="email" class="form-input" id="correo_empresa" name="correo_empresa" value="<?= htmlspecialchars($perfil['correo_empresa'] ?? ''); ?>" required placeholder="Ej. contrataciones@techsolutions.com">
            </div>

            <!-- Teléfono -->
            <div class="form-group">
                <label class="form-label" for="telefono_empresa">Teléfono Corporativo</label>
                <input type="tel" class="form-input" id="telefono_empresa" name="telefono_empresa" value="<?= htmlspecialchars($perfil['telefono_empresa'] ?? ''); ?>" placeholder="Ej. 2222-2222">
            </div>

            <!-- Ubicación -->
            <div class="form-group">
                <label class="form-label" for="ubicacion">Dirección / Ubicación</label>
                <input type="text" class="form-input" id="ubicacion" name="ubicacion" value="<?= htmlspecialchars($perfil['ubicacion'] ?? ''); ?>" placeholder="Ej. San Salvador, El Salvador">
            </div>

            <!-- Sitio Web -->
            <div class="form-group">
                <label class="form-label" for="sitio_web">Sitio Web Oficial</label>
                <input type="url" class="form-input" id="sitio_web" name="sitio_web" value="<?= htmlspecialchars($perfil['sitio_web'] ?? ''); ?>" placeholder="Ej. https://www.techsolutions.com">
            </div>

            <!-- Descripción (Full Width) -->
            <div class="form-group form-grid-full" style="grid-column: span 2;">
                <label class="form-label" for="descripcion">Descripción de la Empresa</label>
                <textarea class="form-input form-textarea" id="descripcion" name="descripcion" placeholder="Describe brevemente a tu empresa, su cultura laboral y qué tipo de talentos buscas..."><?= htmlspecialchars($perfil['descripcion'] ?? ''); ?></textarea>
            </div>
            
            <div class="form-grid-full" style="grid-column: span 2; display: flex; justify-content: flex-end; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
                </button>
            </div>
        </div>
    </form>
</div>
