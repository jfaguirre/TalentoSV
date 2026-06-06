<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use App\controller\UsuarioControlador;  

$login = new UsuarioControlador();
$respuesta = $login->crearUsuario();            

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
            </button>
            <span class="topbar-brand">Ta<span>lento</span>ES</span>
        </div>

        <div class="auth-card-wrapper">
            <!-- Hero -->
            <div class="hero">
                <div class="hero-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="8.5" cy="7" r="4"/>
                        <line x1="20" y1="8" x2="20" y2="14"/>
                        <line x1="23" y1="11" x2="17" y2="11"/>
                    </svg>
                </div>
                <h2>Crea tu cuenta</h2>
                <p>Únete a la mayor red de oportunidades profesionales en El Salvador.</p>
            </div>

            <!-- Form card -->
            <div class="card" id="form-card">
                <!-- FORM -->
                <form id="register-form" novalidate action="" method="POST">
                    <!-- Rol usuario -->
                    <input type="hidden" name="tipo_usuario" id="tipo_usuario" value="usuario">

                    <div class="form-body">
                        <div class="form-panel active" id="panel-candidato" role="tabpanel" aria-labelledby="tab-candidato">        
                            
                            <!-- Nombre -->
                            <div class="field">
                                <label for="nombreUsuario">Nombre <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <span class="icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                    </span>
                                    <input type="text" id="nombreUsuario" name="nombreUsuario" placeholder="Tu nombre" autocomplete="name" required maxlength="100" class="<?php echo isset($respuesta['nombre']) ? 'error-field' : ''; ?>" value="<?php echo isset($_POST['nombreUsuario']) ? htmlspecialchars($_POST['nombreUsuario']) : ''; ?>">
                                </div>
                                <span class="field-error <?php echo isset($respuesta['nombre']) ? 'visible' : ''; ?>" id="err-nombreUsuario">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    <span class="err-text"><?php echo isset($respuesta['nombre']) ? htmlspecialchars($respuesta['nombre']) : 'Ingresa tu nombre completo'; ?></span>
                                </span>                     
                            </div>
                    
                            <!-- Apellido -->
                            <div class="field">
                                <label for="apellidoUsuario">Apellido <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <span class="icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                    </span>
                                    <input type="text" id="apellidoUsuario" name="apellidoUsuario" placeholder="Tu apellido" autocomplete="name" required maxlength="100" class="<?php echo isset($respuesta['apellido']) ? 'error-field' : ''; ?>" value="<?php echo isset($_POST['apellidoUsuario']) ? htmlspecialchars($_POST['apellidoUsuario']) : ''; ?>">
                                </div>
                                <span class="field-error <?php echo isset($respuesta['apellido']) ? 'visible' : ''; ?>" id="err-apellidoUsuario">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    <span class="err-text"><?php echo isset($respuesta['apellido']) ? htmlspecialchars($respuesta['apellido']) : 'Ingresa tu apellido completo'; ?></span>
                                </span>
                            </div>

                            <!-- Correo -->
                            <div class="field">
                                <label for="correoUsuario">Correo electrónico <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <span class="icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
                                    </span>
                                    <input type="email" id="correoUsuario" name="correoUsuario" placeholder="ejemplo@correo.com" autocomplete="email" required class="<?php echo isset($respuesta['correo']) ? 'error-field' : ''; ?>" value="<?php echo isset($_POST['correoUsuario']) ? htmlspecialchars($_POST['correoUsuario']) : ''; ?>">
                                </div>
                                <span class="field-error <?php echo isset($respuesta['correo']) ? 'visible' : ''; ?>" id="err-correoUsuario">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    <span class="err-text"><?php echo isset($respuesta['correo']) ? htmlspecialchars($respuesta['correo']) : 'Ingresa un correo válido'; ?></span>
                                </span>
                            </div>

                            <!-- Password -->
                            <div class="field">
                                <label for="passwordUsuario">Contraseña <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <span class="icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                    </span>
                                    <input type="password" id="passwordUsuario" name="passwordUsuario" placeholder="Mínimo 8 caracteres" autocomplete="new-password" required minlength="8" class="<?php echo isset($respuesta['password']) ? 'error-field' : ''; ?>">
                                    <button type="button" class="toggle-pass" onclick="togglePass('passwordUsuario', this)" aria-label="Mostrar contraseña">
                                        <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                                <span class="field-error <?php echo isset($respuesta['password']) ? 'visible' : ''; ?>" id="err-passwordUsuario">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    <span class="err-text"><?php echo isset($respuesta['password']) ? htmlspecialchars($respuesta['password']) : 'Mínimo 8 caracteres'; ?></span>
                                </span>
                            </div>

                            <!-- Confirmar Password -->
                            <div class="field">
                                <label for="confirmarPassword">Confirmar contraseña <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <span class="icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/><line x1="9" y1="16" x2="9.01" y2="16" stroke-width="2.5"/><line x1="12" y1="16" x2="12.01" y2="16" stroke-width="2.5"/><line x1="15" y1="16" x2="15.01" y2="16" stroke-width="2.5"/></svg>
                                    </span>
                                    <input type="password" id="confirmarPassword" name="confirmarPassword" placeholder="Repite tu contraseña" autocomplete="new-password" required oninput="checkMatch('passwordUsuario', 'confirmarPassword', 'match-c')">
                                    <button type="button" class="toggle-pass" onclick="togglePass('confirmarPassword', this)" aria-label="Mostrar confirmación">
                                        <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                                <span class="match-indicator" id="match-c"></span>
                                <span class="field-error" id="err-confirmarPassword">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    <span class="err-text">Las contraseñas no coinciden</span>
                                </span>
                            </div>

                        </div>

                        <!-- Submit -->
                        <button type="button" class="btn-primary" id="btn-submit" onclick="handleSubmit(event)">
                            Registrarse
                        </button>            

                    </div>
                </form>

                <!-- Success state -->
                <div class="success-overlay" id="success-overlay">
                    <div class="success-icon">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <h2>¡Cuenta creada!</h2>
                    <p id="success-msg">Tu cuenta ha sido registrada exitosamente. Revisa tu correo para verificar tu cuenta.</p>
                    <button class="btn-primary" style="max-width:240px;margin-top:8px" onclick="location.href='<?php echo (strpos($_SERVER['SCRIPT_NAME'], 'views/paginas') !== false) ? 'ingreso.php' : 'index.php?pagina=ingreso'; ?>'">Iniciar sesión</button>
                </div>
            </div>

            <!-- Login Link -->
            <div class="login-row">
                ¿Ya tienes cuenta? <a href="index.php?pagina=ingreso">Iniciar Sesión</a>
            </div>
        </div>
    </div>
</div>

<script>
  /* ── Toggle password visibility ── */
  function togglePass(inputId, btn) {
    const input = document.getElementById(inputId);
    const show  = input.type === 'password';
    input.type  = show ? 'text' : 'password';
    btn.innerHTML = show
      ? `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`
      : `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
    btn.setAttribute('aria-label', show ? 'Ocultar contraseña' : 'Mostrar contraseña');
  }

  /* ── Password match ── */
  function checkMatch(passId, confirmId, indicatorId) {
    const pass    = document.getElementById(passId).value;
    const confirm = document.getElementById(confirmId).value;
    const el      = document.getElementById(indicatorId);
    if (!confirm) { el.className = 'match-indicator'; return; }
    if (pass === confirm) {
      el.className   = 'match-indicator visible ok';
      el.innerHTML   = `<svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg> Las contraseñas coinciden`;
    } else {
      el.className   = 'match-indicator visible fail';
      el.innerHTML   = `<svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> No coinciden`;
    }
  }

  /* ── Submit / validation ── */
  function handleSubmit(e) {
    const btn   = document.getElementById('btn-submit');
    const role  = document.getElementById('tipo_usuario').value;
    let valid   = true;

    if (role === 'usuario') {
      const nombre  = document.getElementById('nombreUsuario');
      const apellido  = document.getElementById('apellidoUsuario');
      const email   = document.getElementById('correoUsuario');
      const pass    = document.getElementById('passwordUsuario');
      const confirm = document.getElementById('confirmarPassword');

      if (!nombre.value.trim())                         { showErr('err-nombreUsuario', nombre, 'Ingresa tu nombre completo'); valid = false; }
      else                                              { clearErr('err-nombreUsuario', nombre); }
      if (!apellido.value.trim())                       { showErr('err-apellidoUsuario', apellido, 'Ingresa tu apellido completo'); valid = false; }
      else                                              { clearErr('err-apellidoUsuario', apellido); }
      if (!email.value || !/\S+@\S+\.\S+/.test(email.value)) { showErr('err-correoUsuario', email, 'Ingresa un correo válido'); valid = false; }
      else                                              { clearErr('err-correoUsuario', email); }
      if (!pass.value || pass.value.length < 8)         { showErr('err-passwordUsuario', pass, 'Mínimo 8 caracteres'); valid = false; }
      else                                              { clearErr('err-passwordUsuario', pass); }
      if (pass.value !== confirm.value || !confirm.value) { showErr('err-confirmarPassword', confirm, 'Las contraseñas no coinciden'); valid = false; }
      else                                              { clearErr('err-confirmarPassword', confirm); }
    }

    if (!valid) return;    
    document.getElementById('register-form').submit();
  }

  function showErr(errId, input, msg) {
    const errSpan = document.getElementById(errId);
    errSpan.classList.add('visible');
    const txtNode = errSpan.querySelector('.err-text');
    if (txtNode && msg) {
      txtNode.textContent = msg;
    }
    input.classList.add('error-field');
    input.focus();
  }
  
  function clearErr(errId, input) {
    document.getElementById(errId).classList.remove('visible');
    input.classList.remove('error-field');
  }
</script>
