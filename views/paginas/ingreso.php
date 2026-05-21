<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use App\controller\UsuarioControlador;

$login = new UsuarioControlador();
$respuesta = $login->login();

?>

<div class="contenedor-auth">
    <!-- Left Side: Promo Panel (Desktop only) -->
    <div class="auth-promo-panel">
        <div class="promo-content">
            <a href="index.php" class="promo-logo" style="color: white; text-decoration: none;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="7" width="20" height="14" rx="2"/>
                    <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                </svg>
                <span>Talento<span>ES</span></span>
            </a>
            <h1>Conecta con el futuro profesional</h1>
            <p>La plataforma líder en El Salvador para encontrar el talento idóneo o el empleo de tus sueños.</p>
            <div class="promo-features">
                <div class="promo-feature">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Conexión directa entre talento y empresas</span>
                </div>
                <div class="promo-feature">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Búsqueda avanzada y perfiles optimizados</span>
                </div>
                <div class="promo-feature">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Plataforma 100% segura y verificada</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Form Panel -->
    <div class="auth-form-panel">
        <!-- Top bar (Mobile only) -->
        <div class="topbar">
            <button class="topbar-back" aria-label="Volver" onclick="location.href='index.php'">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>                           
                <span class="topbar-brand">Talento<span>ES</span></span>
            </button>            
        </div>

        <div class="auth-card-wrapper">
            <!-- Hero -->
            <div class="hero">
                <div class="hero-icon">                    
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                </div>
                <h2>Bienvenido de nuevo</h2>
                <p>Ingresa tus credenciales para acceder a tu cuenta.</p>
            </div>

            <!-- Form card -->
            <div class="card" id="form-card">
                <!-- Formulario -->
                <form action="" method="POST" class="form-login">
                    <div class="form-body">
                        <!-- Correo -->
                        <div class="field">
                            <label for="correoUsuario">Correo electrónico <span class="req">*</span></label>
                            <div class="input-wrap">
                                <span class="icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
                                </span>
                                <input type="email" id="correoUsuario" name="correoUsuario" placeholder="ejemplo@talento.sv" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="field">
                            <label for="passwordUsuario">Contraseña <span class="req">*</span></label>
                            <div class="input-wrap">
                                <span class="icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                </span>
                                <input type="password" id="passwordUsuario" name="passwordUsuario" required placeholder="••••••••">
                            </div>
                        </div>

                        <?php if (isset($respuesta['error_credenciales'])): ?>
                            <div class="field-error visible" style="margin-top: 5px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                <?php echo $respuesta['error_credenciales']; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Botón -->
                        <button type="submit" class="btn-primary">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>

            <!-- Registro Link -->
            <p class="registro-link">
                ¿No tienes cuenta?
                <a href="index.php?pagina=registro">Regístrate</a>
            </p>
        </div>
    </div>
</div>
