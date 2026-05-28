<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use App\controller\EmpresaControlador;

$controlador = new EmpresaControlador();
$id_usuario = $_SESSION['userAuth']['id'] ?? null;
if (!$id_usuario) {
    echo "<h2>Error: No has iniciado sesión.</h2>";
    exit;
}

$usuario = $controlador->gestionarConfiguracion($id_usuario);
?>

<div class="page-header">
    <h1 class="page-title">Ajustes de Cuenta</h1>
    <p class="page-subtitle">Modifica tus datos personales y credenciales de acceso al sistema.</p>
</div>

<div class="card" style="max-width: 700px;">
    <h2 class="card-title">Datos Personales</h2>
    
    <form action="" method="POST">
        <div class="form-grid">
            <!-- Nombre -->
            <div class="form-group">
                <label class="form-label" for="nombreUsuario">Nombre <span style="color:var(--danger)">*</span></label>
                <input type="text" class="form-input" id="nombreUsuario" name="nombreUsuario" value="<?= htmlspecialchars($usuario['nombre'] ?? ''); ?>" required placeholder="Tu nombre">
            </div>

            <!-- Apellido -->
            <div class="form-group">
                <label class="form-label" for="apellidoUsuario">Apellido <span style="color:var(--danger)">*</span></label>
                <input type="text" class="form-input" id="apellidoUsuario" name="apellidoUsuario" value="<?= htmlspecialchars($usuario['apellido'] ?? ''); ?>" required placeholder="Tu apellido">
            </div>

            <!-- Correo -->
            <div class="form-group">
                <label class="form-label" for="correoUsuario">Correo Electrónico <span style="color:var(--danger)">*</span></label>
                <input type="email" class="form-input" id="correoUsuario" name="correoUsuario" value="<?= htmlspecialchars($usuario['correo'] ?? ''); ?>" required placeholder="ejemplo@talento.sv">
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <label class="form-label" for="passwordUsuario">Nueva Contraseña</label>
                <input type="password" class="form-input" id="passwordUsuario" name="passwordUsuario" placeholder="Mínimo 8 caracteres (Dejar vacío si no deseas cambiarla)" minlength="8">
            </div>
            
            <div class="form-grid-full" style="grid-column: span 2; display: flex; justify-content: flex-end; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-user-check"></i> Actualizar Cuenta
                </button>
            </div>
        </div>
    </form>
</div>
