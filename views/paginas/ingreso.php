<?php

namespace App\controller;
use App\controller\UsuarioControlador;

$usuarioControlador = new UsuarioControlador();
$login = $usuarioControlador->login();

?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
<title>TalentoES — El talento que tu empresa necesita</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<div class="contenedor-login">

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
    <h1>Bienvenido de nuevo</h1>
    <p>Ingresa tus credenciales para acceder a tu cuenta.</p>
  </div>
  <!-- Form card -->
  <div class="card" id="form-card">
    <!-- Formulario -->
    <form action="" method="POST" class="form-login">
        <div class="form-body">
        <!-- Correo -->
        <div class="grupo-form">
            <label>Correo electrónico</label>
            <div class="input-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" name="correoUsuario" placeholder="ejemplo@talento.sv" required>
            </div>
        </div>

        <!-- Password -->
        <div class="grupo-form">
            <div class="password-header">
                <label>Contraseña</label>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input  type="password" name="passwordUsuario" required>
            </div>
        </div>
        <!-- Botón -->
        <button type="submit" class="btn-login">
            Iniciar Sesión
        </button>
        </div>
    </form>
</div>
        <!-- Registro -->
        <p class="registro-link">
            ¿No tienes cuenta?
            <a href="/TalentoSV/views/paginas/registro.php">
                Regístrate
            </a>
        </p>
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

/* ===== CONTENEDOR ===== */
.contenedor-login{
    width:100%;
    max-width:500px;
    margin:0 auto;
    padding:40px 25px 40px;
}

/* ===== LOGO ===== */
.logo-texto{
    text-align:center;
    margin-bottom:55px;
}

.logo-texto h1{
    color:#1453c8;
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

/* ===== ENCABEZADO ===== */
.encabezado-login{
    margin-bottom:45px;
}

.encabezado-login h2{
    color:#111827;
    margin-bottom:15px;
}

.encabezado-login p{
    line-height:1.6;
    color:#667085;
}


/* ===== FORM ===== */
.form-login{
    width:100%;
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

/* ===== GRUPOS ===== */
.grupo-form{
    margin-bottom:35px;
}

/* ===== LABEL ===== */
.grupo-form label{
    font-size: 13px;
    font-weight: 600;
    color: var(--text-primary);
    letter-spacing: 0.01em;
}

/* ===== PASSWORD HEADER ===== */
.password-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
}

.password-header a{
    text-decoration:none;
    color:#123ea5;
}

/* ===== INPUT GROUP ===== */
.input-group{
    position: relative;
    display: flex;
    align-items: center;
}

.input-group i{
    position:absolute;
    top:50%;
    left:20px;
    transform:translateY(-50%);
    color:#6b7280;
}

.input-group input{
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

.input-group input:focus{
    border-color:#1453c8;
}

/* ===== BOTON ===== */
/* ── login button ── */
  .btn-login {
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
  .btn-login:hover {
    background: var(--primary-dark);
    box-shadow: 0 4px 14px rgba(15,82,186,.35);
  }
  .btn-login:active { transform: scale(0.99); }
  .btn-login:disabled { background: var(--text-hint); cursor: not-allowed; box-shadow: none; }


/* ===== SOCIAL ===== */
.social-login{
    display:flex;
    gap:18px;
}

.social-btn{
    flex:1;
    height:82px;
    border:2px solid #d0d5dd;
    border-radius:18px;
    background:white;
    font-size:22px;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:15px;
    transition:.3s;
}

.social-btn:hover{
    border-color:#1453c8;
}



/* ===== REGISTRO ===== */
.registro-link{
    text-align:center;
    margin-top:20px;
    color:#475467;
}

.registro-link a{
    color:#123ea5;
    text-decoration:none;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){

    .logo-texto h1{
        font-size:42px;
    }

    .encabezado-login h2{
        font-size:42px;
    }

    .encabezado-login p{
        font-size:20px;
    }

    .grupo-form label{
        font-size:20px;
    }

    .input-group input{
        height:72px;
        font-size:22px;
    }

    .btn-login{
        height:78px;
        font-size:28px;
    }

    .social-login{
        flex-direction:column;
    }

}
</style>
