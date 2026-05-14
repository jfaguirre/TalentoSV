<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TalentoES — Crear cuenta</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --primary:        #0F52BA;
    --primary-dark:   #0a3d8f;
    --primary-light:  #e8f0fb;
    --secondary:      #64748B;
    --tertiary-bg:    #F8FAFC;
    --neutral:        #1E293B;
    --white:          #ffffff;
    --border:         #e2e8f0;
    --border-focus:   #0F52BA;
    --text-primary:   #1E293B;
    --text-secondary: #64748B;
    --text-hint:      #94a3b8;
    --error:          #dc2626;
    --success:        #16a34a;
    --radius-sm:      8px;
    --radius-md:      12px;
    --radius-lg:      16px;
    --radius-xl:      20px;
    --shadow-card:    0 2px 12px rgba(15,82,186,.08), 0 1px 3px rgba(0,0,0,.06);
    --transition:     0.18s ease;
  }

  html { font-size: 16px; }

  body {
    font-family: 'Inter', sans-serif;
    background: var(--tertiary-bg);
    color: var(--text-primary);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0;
  }

  /* ── Top bar ── */
  .topbar {
    width: 100%;
    max-width: 480px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 16px 20px 0;
  }
  .topbar-back {
    width: 36px; height: 36px;
    border-radius: 50%;
    border: none;
    background: transparent;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: var(--primary);
    transition: background var(--transition);
  }
  .topbar-back:hover { background: var(--primary-light); }
  .topbar-back svg { width: 20px; height: 20px; }
  .topbar-brand {
    font-family: 'Manrope', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: var(--primary);
    letter-spacing: -0.5px;
  }
  .topbar-brand span { color: var(--neutral); }

  /* ── Main wrapper ── */
  .page {
    width: 100%;
    max-width: 480px;
    padding: 24px 20px 48px;
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  /* ── Hero ── */
  .hero {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    padding-bottom: 4px;
  }
  .hero-icon {
    width: 64px; height: 64px;
    background: var(--primary);
    border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 4px 16px rgba(15,82,186,.28);
  }
  .hero-icon svg { width: 32px; height: 32px; fill: white; }
  .hero h1 {
    font-family: 'Manrope', sans-serif;
    font-size: 26px;
    font-weight: 800;
    color: var(--text-primary);
    letter-spacing: -0.5px;
    text-align: center;
  }
  .hero p {
    font-size: 14px;
    color: var(--text-secondary);
    text-align: center;
    line-height: 1.6;
    max-width: 300px;
  }

  /* ── Card ── */
  .card {
    background: var(--white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-card);
    padding: 24px 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  /* ── Form fields ── */
  .form-body {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  /* Panel visibility */
  .form-panel { display: none; flex-direction: column; gap: 16px; }
  .form-panel.active { display: flex; }

  .field {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }
  .field label {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-primary);
    letter-spacing: 0.01em;
  }
  .field label span.req { color: var(--error); margin-left: 2px; }

  .input-wrap {
    position: relative;
    display: flex;
    align-items: center;
  }
  .input-wrap .icon {
    position: absolute;
    left: 13px;
    width: 18px; height: 18px;
    color: var(--text-hint);
    pointer-events: none;
    display: flex; align-items: center; justify-content: center;
  }
  .input-wrap .icon svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 1.6; }

  .input-wrap input,
  .input-wrap select {
    width: 100%;
    padding: 11px 14px 11px 40px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    color: var(--text-primary);
    background: var(--white);
    outline: none;
    transition: border-color var(--transition), box-shadow var(--transition);
    -webkit-appearance: none;
  }
  .input-wrap select { cursor: pointer; }
  .input-wrap input::placeholder { color: var(--text-hint); }

  .input-wrap input:focus,
  .input-wrap select:focus {
    border-color: var(--border-focus);
    box-shadow: 0 0 0 3px rgba(15,82,186,.12);
  }
  .input-wrap input.error-field { border-color: var(--error); }
  .input-wrap input.error-field:focus { box-shadow: 0 0 0 3px rgba(220,38,38,.12); }

  .toggle-pass {
    position: absolute;
    right: 12px;
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-hint);
    display: flex; align-items: center;
    padding: 4px;
    border-radius: 4px;
    transition: color var(--transition);
  }
  .toggle-pass:hover { color: var(--text-secondary); }
  .toggle-pass svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 1.6; }

  .field-error {
    font-size: 12px;
    color: var(--error);
    display: none;
    align-items: center;
    gap: 4px;
  }
  .field-error.visible { display: flex; }

  .field-hint {
    font-size: 12px;
    color: var(--text-hint);
  }

  /* ── Divider ── */
  .divider {
    height: 1px;
    background: var(--border);
  }

  /* ── Password match indicator ── */
  .match-indicator {
    font-size: 12px;
    display: none;
    align-items: center;
    gap: 5px;
  }
  .match-indicator.visible { display: flex; }
  .match-indicator.ok { color: var(--success); }
  .match-indicator.fail { color: var(--error); }
  .match-indicator svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }


  /* ── Submit button ── */
  .btn-primary {
    width: 100%;
    padding: 14px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: var(--radius-sm);
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
    letter-spacing: 0.01em;
    position: relative;
    overflow: hidden;
  }
  .btn-primary:hover {
    background: var(--primary-dark);
    box-shadow: 0 4px 14px rgba(15,82,186,.35);
  }
  .btn-primary:active { transform: scale(0.99); }
  .btn-primary:disabled { background: var(--text-hint); cursor: not-allowed; box-shadow: none; }

  /* Ripple */
  .ripple {
    position: absolute;
    border-radius: 50%;
    transform: scale(0);
    animation: ripple-anim 0.5s linear;
    background: rgba(255,255,255,0.35);
    pointer-events: none;
  }
  @keyframes ripple-anim {
    to { transform: scale(4); opacity: 0; }
  }

  /* ── Footer ── */
  .form-footer {
    text-align: center;
    font-size: 13px;
    color: var(--text-secondary);
  }
  .form-footer a {
    color: var(--primary);
    font-weight: 700;
    text-decoration: none;
  }
  .form-footer a:hover { text-decoration: underline; }

  /* ── Promo banner ── */
  .promo {
    background: var(--neutral);
    border-radius: var(--radius-lg);
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    overflow: hidden;
    position: relative;
  }
  .promo::before {
    content: '';
    position: absolute;
    top: -30px; right: -30px;
    width: 120px; height: 120px;
    border-radius: 50%;
    background: rgba(15,82,186,.35);
  }
  .promo-text {
    flex: 1;
    font-size: 14px;
    font-weight: 600;
    color: var(--white);
    line-height: 1.45;
    z-index: 1;
  }
  .promo-icon {
    z-index: 1;
    flex-shrink: 0;
    width: 56px; height: 56px;
  }

  /* ── Login link ── */
  .login-row {
    text-align: center;
    font-size: 14px;
    color: var(--text-secondary);
    padding-bottom: 8px;
  }
  .login-row a {
    color: var(--primary);
    font-weight: 700;
    text-decoration: none;
  }
  .login-row a:hover { text-decoration: underline; }

  /* ── Animations ── */
  @keyframes fadeSlideIn {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .form-panel.active { animation: fadeSlideIn 0.22s ease; }

  /* ── Success overlay ── */
  .success-overlay {
    display: none;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    padding: 32px 16px;
    text-align: center;
  }
  .success-overlay.visible { display: flex; }
  .success-icon {
    width: 72px; height: 72px;
    border-radius: 50%;
    background: #dcfce7;
    display: flex; align-items: center; justify-content: center;
  }
  .success-icon svg { width: 36px; height: 36px; stroke: #16a34a; fill: none; stroke-width: 2; }
  .success-overlay h2 {
    font-family: 'Manrope', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: var(--text-primary);
  }
  .success-overlay p { font-size: 14px; color: var(--text-secondary); line-height: 1.6; }

  /* ── Responsive ── */
  @media (min-width: 480px) {
    .topbar, .page { max-width: 480px; }
    .page { padding: 28px 24px 56px; }
    .card { padding: 28px 24px; }
  }
</style>
</head>
<body>

<!-- Top bar -->
<div class="topbar">
  <button class="topbar-back" aria-label="Volver" onclick="history.back()">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <polyline points="15 18 9 12 15 6"></polyline>
    </svg>
  </button>
  <span class="topbar-brand">Ta<span>lento</span>ES</span>
</div>

<!-- Page content -->
<main class="page">

  <!-- Hero -->
  <div class="hero">
    <div class="hero-icon">
      <svg viewBox="0 0 24 24"><path d="M20 7H4a2 2 0 00-2 2v9a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
    </div>
    <h1>Crea tu cuenta</h1>
    <p>Únete a la mayor red de oportunidades profesionales en El Salvador.</p>
  </div>

  <!-- Form card -->
  <div class="card" id="form-card">

    <!-- ── FORM ── -->
    <form id="register-form" novalidate action="/registro" method="POST">
      <!-- Hidden field for MVC controller routing -->
      <input type="hidden" name="tipo_usuario" id="tipo_usuario" value="candidato">

      <div class="form-body">
        <div class="form-panel active" id="panel-candidato" role="tabpanel" aria-labelledby="tab-candidato">

          <!-- Nombre  -->
          <div class="field">
            <label for="nombre_candidato">Nombre <span class="req">*</span></label>
            <div class="input-wrap">
              <span class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
              </span>
              <input type="text" id="nombre_candidato" name="nombre" placeholder="Tu nombre real" autocomplete="name" required maxlength="100">
            </div>
            <span class="field-error" id="err-nombre"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Ingresa tu nombre completo</span>
          </div>
          <div class="field">
            <label for="apellido_candidato">Apellido <span class="req">*</span></label>
            <div class="input-wrap">
              <span class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
              </span>
              <input type="text" id="apellido_candidato" name="nombre" placeholder="Tu apellido real" autocomplete="name" required maxlength="100">
            </div>
            <span class="field-error" id="err-nombre"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Ingresa tu nombre completo</span>
          </div>

          <!-- Correo -->
          <div class="field">
            <label for="email_candidato">Correo electrónico<span class="req">*</span></label>
            <div class="input-wrap">
              <span class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
              </span>
              <input type="email" id="email_candidato" name="email" placeholder="ejemplo@correo.com" autocomplete="email" required>
            </div>
            <span class="field-error" id="err-email">Ingresa un correo válido</span>
          </div>

          <!-- Contraseña -->
          <div class="field">
            <label for="password_candidato">Contraseña<span class="req">*</span></label>
            <div class="input-wrap">
              <span class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
              </span>
              <input type="password" id="password_candidato" name="password" placeholder="Mínimo 8 caracteres" autocomplete="new-password" required minlength="8" oninput="checkStrength(this, 'strength-c')">
              <button type="button" class="toggle-pass" onclick="togglePass('password_candidato', this)" aria-label="Mostrar contraseña">
                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
            
            <span class="field-error" id="err-pass">Mínimo 8 caracteres</span>
          </div>

          <!-- Confirmar contraseña -->
          <div class="field">
            <label for="confirm_candidato">Confirmar contraseña<span class="req">*</span></label>
            <div class="input-wrap">
              <span class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/><line x1="9" y1="16" x2="9.01" y2="16" stroke-width="2.5"/><line x1="12" y1="16" x2="12.01" y2="16" stroke-width="2.5"/><line x1="15" y1="16" x2="15.01" y2="16" stroke-width="2.5"/></svg>
              </span>
              <input type="password" id="confirm_candidato" name="confirm_password" placeholder="Repite tu contraseña" autocomplete="new-password" required oninput="checkMatch('password_candidato', 'confirm_candidato', 'match-c')">
              <button type="button" class="toggle-pass" onclick="togglePass('confirm_candidato', this)" aria-label="Mostrar confirmación">
                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
            <span class="match-indicator" id="match-c"></span>
            <span class="field-error" id="err-confirm">Las contraseñas no coinciden</span>
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

  <!-- Promo banner -->
  <div class="promo" aria-hidden="true">
    <div class="promo-text">Impulsa tu carrera con los líderes del mercado</div>
    <svg class="promo-icon" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="18" cy="20" r="8" fill="#3b82f6" opacity=".85"/>
      <circle cx="38" cy="20" r="8" fill="#60a5fa" opacity=".7"/>
      <path d="M4 44c0-7.7 6.3-14 14-14s14 6.3 14 14" stroke="#93c5fd" stroke-width="2" stroke-linecap="round"/>
      <path d="M24 44c0-7.7 6.3-14 14-14s14 6.3 14 14" stroke="#bfdbfe" stroke-width="2" stroke-linecap="round"/>
    </svg>
  </div>

  <!-- Login row -->
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

    if (role === 'candidato') {
      const nombre  = document.getElementById('nombre_candidato');
      const email   = document.getElementById('email_candidato');
      const pass    = document.getElementById('password_candidato');
      const confirm = document.getElementById('confirm_candidato');

      if (!nombre.value.trim())                         { showErr('err-nombre', nombre); valid = false; }
      else                                              { clearErr('err-nombre', nombre); }
      if (!email.value || !/\S+@\S+\.\S+/.test(email.value)) { showErr('err-email', email); valid = false; }
      else                                              { clearErr('err-email', email); }
      if (!pass.value || pass.value.length < 8)         { showErr('err-pass', pass); valid = false; }
      else                                              { clearErr('err-pass', pass); }
      if (pass.value !== confirm.value || !confirm.value) { showErr('err-confirm', confirm); valid = false; }
      else                                              { clearErr('err-confirm', confirm); }
    }

    if (!valid) return;

    /* Ripple effect */
    const rect = btn.getBoundingClientRect();
    const r    = document.createElement('span');
    r.className = 'ripple';
    const size  = Math.max(btn.clientWidth, btn.clientHeight);
    r.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX - rect.left - size/2}px;top:${e.clientY - rect.top - size/2}px`;
    btn.appendChild(r);
    setTimeout(() => r.remove(), 600);

    /* Simulate submit → show success */
    btn.disabled    = true;
    btn.textContent = 'Registrando…';
    setTimeout(() => {
      document.querySelector('.role-toggle').style.display = 'none';
      document.getElementById('register-form').style.display = 'none';
      document.getElementById('form-footer').style.display = 'none';
      const overlay = document.getElementById('success-overlay');
      const email   = role === 'candidato'
        ? document.getElementById('email_candidato').value
        : document.getElementById('email_empresa').value;
      document.getElementById('success-msg').textContent = `Tu cuenta ha sido registrada. Hemos enviado un correo de verificación a ${email}.`;
      overlay.classList.add('visible');
    }, 1600);
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
</body>
</html> 