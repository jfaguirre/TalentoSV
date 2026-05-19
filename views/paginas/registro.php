<?php

use App\controller\UsuarioControlador;  
$usuario = new UsuarioControlador();
$respuesta = $usuario->crearUsuario();            

?>

<!-- Regresar -->
<div class="topbar">
  <button class="topbar-back" aria-label="Volver" onclick="history.back()">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <polyline points="15 18 9 12 15 6"></polyline>
    </svg>
  </button>
  <span class="topbar-brand">Ta<span>lento</span>ES</span>
</div>

<!-- Contenido -->
<main class="page">

  <!-- Hero -->
  <div class="hero">
    <div class="hero-icon">
      <svg viewBox="0 0 24 24"><path d="M20 7H4a2 2 0 00-2 2v9a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
    </div>
    <h1>Crea tu cuenta</h1>
    <p>Únete a la mayor red de oportunidades profesionales en El Salvador.</p>
  </div>

  <!-- Formulario -->
  <div class="card" id="form-card">

    <!-- ── FORM ── -->
    <form id="register-form" novalidate action="" method="POST">

       <!-- Rol usuario -->
      <input type="hidden" name="tipo_usuario" id="tipo_usuario" value="usuario">

       <?php if(isset($respuesta['nombre'])): ?>
                <h6><?php echo $respuesta['nombre']  ?></h6>                
            <?php endif ?>

      <!-- Nombre  -->
      <div class="form-body">
        <div class="form-panel active" id="panel-candidato" role="tabpanel" aria-labelledby="tab-candidato">        
          
        <!-- Nombre  -->
          <div class="field">
            <label for="nombreUsuario">Nombre <span class="req">*</span></label>
            <div class="input-wrap">
              <span class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
              </span>
              <input type="text" id="nombreUsuario" name="nombreUsuario" placeholder="Tu nombre real" autocomplete="name" required maxlength="100">
            </div>
            <span class="field-error" id="err-nombreUsuario"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Ingresa tu nombre completo</span>                     
          </div>
  
          <!-- Apellido -->
          <div class="field">
            <label for="apellidoUsuario">Apellido <span class="req">*</span></label>
            <div class="input-wrap">
              <span class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
              </span>
              <input type="text" id="apellidoUsuario" name="apellidoUsuario" placeholder="Tu apellido real" autocomplete="name" required maxlength="100">
            </div>
            <span class="field-error" id="err-apellidoUsuario"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Ingresa tu apellido completo</span>
          </div>

          <!-- Correo -->
          <div class="field">
            <label for="correoUsuario">Correo electrónico<span class="req">*</span></label>
            <div class="input-wrap">
              <span class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
              </span>
              <input type="email" id="correoUsuario" name="correoUsuario" placeholder="ejemplo@correo.com" autocomplete="email" required>
            </div>
            <span class="field-error" id="err-correoUsuario">Ingresa un correo válido</span>
          </div>

          <!-- Password -->
          <div class="field">
            <label for="passwordUsuario">Contraseña<span class="req">*</span></label>
            <div class="input-wrap">
              <span class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
              </span>
              <input type="password" id="passwordUsuario" name="passwordUsuario" placeholder="Mínimo 8 caracteres" autocomplete="new-password" required minlength="8" oninput="checkStrength(this, 'strength-c')">
              <button type="button" class="toggle-pass" onclick="togglePass('passwordUsuario', this)" aria-label="Mostrar contraseña">
                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
            
            <span class="field-error" id="err-passwordUsuario">Mínimo 8 caracteres</span>
          </div>

          <!-- Confirmar Password -->
          <div class="field">
            <label for="confirmarPassword">Confirmar contraseña<span class="req">*</span></label>
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
            <span class="field-error" id="err-confirmarPassword">Las contraseñas no coinciden</span>
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
      <button class="btn-primary" style="max-width:240px;margin-top:8px" onclick="location.href='/login'">Iniciar sesión</button>
    </div>

  </div>
  <!-- /card -->

  <!-- Banner -->
  <div class="promo" aria-hidden="true">
    <div class="promo-text">Impulsa tu carrera con los líderes del mercado</div>
    <svg class="promo-icon" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="18" cy="20" r="8" fill="#3b82f6" opacity=".85"/>
      <circle cx="38" cy="20" r="8" fill="#60a5fa" opacity=".7"/>
      <path d="M4 44c0-7.7 6.3-14 14-14s14 6.3 14 14" stroke="#93c5fd" stroke-width="2" stroke-linecap="round"/>
      <path d="M24 44c0-7.7 6.3-14 14-14s14 6.3 14 14" stroke="#bfdbfe" stroke-width="2" stroke-linecap="round"/>
    </svg>
  </div>

  <!-- Login -->
  <div class="login-row">
    ¿Ya tienes cuenta? <a href="/TalentoSV/views/paginas/ingreso.php">Iniciar Sesión</a>
  </div>

</main>


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
    const terms = document.getElementById('acepta_terminos');
    let valid   = true;

    if (role === 'usuario') {
      const nombre  = document.getElementById('nombreUsuario');
      const apellido  = document.getElementById('apellidoUsuario');
      const email   = document.getElementById('correoUsuario');
      const pass    = document.getElementById('passwordUsuario');
      const confirm = document.getElementById('confirmarPassword');

      if (!nombre.value.trim())                         { showErr('err-nombreUsuario', nombre); valid = false; }
      else                                              { clearErr('err-nombreUsuario', nombre); }
      if (!apellido.value.trim())                       { showErr('err-apellidoUsuario', apellido); valid = false; }
      else                                              { clearErr('err-apellidoUsuario', apellido); }
      if (!email.value || !/\S+@\S+\.\S+/.test(email.value)) { showErr('err-correoUsuario', email); valid = false; }
      else                                              { clearErr('err-correoUsuario', email); }
      if (!pass.value || pass.value.length < 8)         { showErr('err-passwordUsuario', pass); valid = false; }
      else                                              { clearErr('err-passwordUsuario', pass); }
      if (pass.value !== confirm.value || !confirm.value) { showErr('err-confirmarPassword', confirm); valid = false; }
      else                                              { clearErr('err-confirmarPassword', confirm); }
    }

    if (!valid) return;    
    document.getElementById('register-form').submit();
   
  }

  function showErr(errId, input) {
    document.getElementById(errId).classList.add('visible');
    input.classList.add('error-field');
    input.focus();
  }
  function clearErr(errId, input) {
    document.getElementById(errId).classList.remove('visible');
    input.classList.remove('error-field');
  }
</script>
