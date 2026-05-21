<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
<title>TalentoES — Conecta con el mejor talento</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root{
  /* Primary palette */
  --primary:       #0F52BA;
  --primary-dark:  #0A3D8F;
  --primary-light: #1A6FE0;
  --primary-50:    #EEF4FF;
  --primary-100:   #D6E4FF;
  --primary-200:   #ADC8FF;
  --primary-400:   #5B8EF0;

  /* Secondary palette */
  --secondary:     #64748B;
  --secondary-dark:#475569;
  --secondary-50:  #F1F5F9;
  --secondary-100: #E2E8F0;
  --secondary-200: #CBD5E1;
  --secondary-400: #94A3B8;

  /* Tertiary / background */
  --tertiary:      #F8FAFC;
  --white:         #FFFFFF;

  /* Neutral / text */
  --neutral:       #1E293B;
  --neutral-700:   #334155;
  --neutral-500:   #64748B;
  --neutral-300:   #CBD5E1;
  --neutral-100:   #F1F5F9;

  /* Semantic */
  --success:       #16A34A;
  --success-bg:    #F0FDF4;

  /* Typography */
  --font-headline: 'Manrope', sans-serif;
  --font-body:     'Inter', sans-serif;

  /* Radii */
  --r-sm:  6px;
  --r:     10px;
  --r-lg:  16px;
  --r-xl:  24px;
}

html{scroll-behavior:smooth}
body{
  font-family:var(--font-body);
  background:var(--tertiary);
  color:var(--neutral);
  line-height:1.6;
  overflow-x:hidden;
  -webkit-font-smoothing:antialiased;
}

/* ── ANIMATIONS ── */
@keyframes fadeUp{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:translateY(0)}}
.fade{opacity:0;transform:translateY(18px);transition:opacity .55s ease,transform .55s ease}
.fade.in{opacity:1;transform:none}
.d1{transition-delay:.08s}.d2{transition-delay:.16s}.d3{transition-delay:.24s}.d4{transition-delay:.32s}

/* ── NAVBAR ── */
nav{
  position:sticky;top:0;z-index:200;
  background:rgba(15,82,186,.97);
  backdrop-filter:blur(14px);
  -webkit-backdrop-filter:blur(14px);
  height:56px;
  display:flex;align-items:center;justify-content:space-between;
  padding:0 1.5rem;
  border-bottom:1px solid rgba(255,255,255,.1);
}
.nav-logo{
  font-family:var(--font-headline);
  font-weight:800;font-size:1.15rem;
  color:var(--white);letter-spacing:-.02em;
  text-decoration:none;display:flex;align-items:center;gap:8px;
}
.nav-logo-mark{
  width:28px;height:28px;
  background:rgba(255,255,255,.15);
  border-radius:7px;
  display:flex;align-items:center;justify-content:center;
}
.nav-logo-mark svg{width:16px;height:16px;stroke:white;fill:none;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}
.nav-actions{display:flex;gap:.6rem;align-items:center}

/* Buttons — matching brand guide */
.btn{
  display:inline-flex;align-items:center;justify-content:center;gap:6px;
  font-family:var(--font-body);
  font-size:.82rem;font-weight:600;
  border-radius:var(--r-sm);
  cursor:pointer;text-decoration:none;
  transition:all .18s ease;border:1.5px solid transparent;
  white-space:nowrap;
}
/* Primary */
.btn-primary{
  background:var(--primary);color:var(--white);
  border-color:var(--primary);
  padding:.5rem 1.1rem;
}
.btn-primary:hover{background:var(--primary-dark);border-color:var(--primary-dark)}
/* Secondary (ghost on dark bg) */
.btn-secondary{
  background:transparent;color:var(--white);
  border-color:rgba(255,255,255,.35);
  padding:.5rem 1.1rem;
}
.btn-secondary:hover{background:rgba(255,255,255,.12);border-color:rgba(255,255,255,.6)}
/* Inverted */
.btn-inverted{
  background:var(--neutral);color:var(--white);
  border-color:var(--neutral);
  padding:.5rem 1.1rem;
}
/* Outlined (light bg) */
.btn-outlined{
  background:transparent;color:var(--primary);
  border-color:var(--primary);
  padding:.5rem 1.1rem;
}
.btn-outlined:hover{background:var(--primary-50)}

/* Nav login */
.btn-nav-login{
  background:var(--white);
  color:var(--primary);
  border:none;border-radius:var(--r-sm);
  padding:.45rem 1.1rem;
  font-family:var(--font-body);
  font-size:.8rem;font-weight:700;
  cursor:pointer;text-decoration:none;
  transition:all .18s;
}
.btn-nav-login:hover{background:var(--primary-50)}

/* ── HERO ── */
.hero{
  background:var(--primary);
  padding:3.25rem 1.5rem 0;
  position:relative;overflow:hidden;
}
/* Subtle geometric bg pattern */
.hero::before{
  content:'';
  position:absolute;inset:0;
  background-image:
    radial-gradient(circle at 80% 20%, rgba(255,255,255,.06) 0%, transparent 50%),
    radial-gradient(circle at 10% 80%, rgba(255,255,255,.04) 0%, transparent 40%);
  pointer-events:none;
}
.hero-eyebrow{
  display:inline-flex;align-items:center;gap:7px;
  background:rgba(255,255,255,.12);
  border:1px solid rgba(255,255,255,.2);
  border-radius:999px;
  padding:.3rem .9rem;
  font-family:var(--font-body);
  font-size:.72rem;font-weight:600;
  color:rgba(255,255,255,.9);letter-spacing:.05em;text-transform:uppercase;
  margin-bottom:1.5rem;
}
.hero-eyebrow-dot{width:5px;height:5px;border-radius:50%;background:rgba(255,255,255,.7)}
.hero h1{
  font-family:var(--font-headline);
  font-size:2.5rem;font-weight:800;
  line-height:1.08;letter-spacing:-.03em;
  color:var(--white);
  margin-bottom:1.25rem;
}
.hero h1 .muted{color:rgba(255,255,255,.5);font-weight:300}
.hero-desc{
  font-family:var(--font-body);
  font-size:.875rem;color:rgba(255,255,255,.7);
  font-weight:300;line-height:1.75;
  margin-bottom:1.75rem;
}

/* CTA stack */
.hero-cta{display:flex;flex-direction:column;gap:.75rem;margin-bottom:2.5rem}
.btn-hero-primary{
  display:flex;align-items:center;justify-content:center;gap:8px;
  background:var(--white);color:var(--primary);
  border:none;border-radius:var(--r);
  padding:.9rem 1.5rem;
  font-family:var(--font-body);
  font-size:.9rem;font-weight:700;
  cursor:pointer;text-decoration:none;
  transition:all .18s;
}
.btn-hero-primary:hover{background:var(--primary-50)}
.btn-hero-primary .arrow{
  width:20px;height:20px;border-radius:50%;
  background:var(--primary-100);
  display:flex;align-items:center;justify-content:center;
  font-size:.75rem;color:var(--primary);
}
.btn-hero-secondary{
  display:flex;align-items:center;justify-content:center;
  background:transparent;color:rgba(255,255,255,.85);
  border:1.5px solid rgba(255,255,255,.3);
  border-radius:var(--r);
  padding:.9rem 1.5rem;
  font-family:var(--font-body);
  font-size:.9rem;font-weight:500;
  cursor:pointer;text-decoration:none;
  transition:all .18s;
}
.btn-hero-secondary:hover{border-color:rgba(255,255,255,.6);color:white}

/* Hero stats */
.hero-stats{
  display:grid;grid-template-columns:repeat(3,1fr);
  margin:0 -1.5rem;
  border-top:1px solid rgba(255,255,255,.12);
  background:rgba(0,0,0,.08);
}
.hstat{
  padding:1.1rem .75rem;
  text-align:center;
  border-right:1px solid rgba(255,255,255,.1);
}
.hstat:last-child{border-right:none}
.hstat-num{
  font-family:var(--font-headline);
  font-size:1.45rem;font-weight:800;
  color:var(--white);line-height:1;
  letter-spacing:-.025em;
}
.hstat-num sup{font-size:.9rem;font-weight:600;color:rgba(255,255,255,.7)}
.hstat-lbl{font-size:.67rem;color:rgba(255,255,255,.5);margin-top:3px;line-height:1.3;font-family:var(--font-body)}

/* ── SECTION BASE ── */
.section{padding:3.5rem 1.5rem}
.section-white{background:var(--white)}
.section-tertiary{background:var(--tertiary)}
.section-primary{background:var(--primary)}
.section-neutral{background:var(--neutral)}

.sec-tag{
  font-family:var(--font-body);
  font-size:.68rem;font-weight:700;
  text-transform:uppercase;letter-spacing:.1em;
  color:var(--primary);
  display:flex;align-items:center;gap:8px;
  margin-bottom:.75rem;
}
.sec-tag-line{width:18px;height:2px;background:var(--primary);border-radius:2px;display:inline-block}
.sec-title{
  font-family:var(--font-headline);
  font-size:1.8rem;font-weight:800;
  line-height:1.08;letter-spacing:-.025em;
  color:var(--neutral);margin-bottom:.75rem;
}
.sec-desc{
  font-family:var(--font-body);
  font-size:.875rem;color:var(--secondary);
  font-weight:300;line-height:1.75;
  margin-bottom:2rem;
}

/* ── WHY US — Benefit cards ── */
.benefit-cards{display:flex;flex-direction:column;gap:.875rem}
.benefit-card{
  background:var(--white);
  border:1px solid var(--secondary-100);
  border-radius:var(--r-lg);
  padding:1.35rem;
  display:flex;gap:1rem;align-items:flex-start;
  transition:border-color .2s,box-shadow .2s;
}
.benefit-card:hover{
  border-color:var(--primary-200);
  box-shadow:0 4px 20px rgba(15,82,186,.07);
}
.benefit-icon{
  width:42px;height:42px;
  border-radius:10px;
  background:var(--primary-50);
  border:1px solid var(--primary-100);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
}
.benefit-icon svg{width:20px;height:20px;stroke:var(--primary);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.benefit-title{
  font-family:var(--font-headline);
  font-size:.875rem;font-weight:700;
  color:var(--neutral);margin-bottom:.25rem;
}
.benefit-text{
  font-family:var(--font-body);
  font-size:.8rem;color:var(--secondary);line-height:1.65;font-weight:300;
}

/* ── CANDIDATES ── */
.tab-section{
  background:var(--primary-50);
  border:1px solid var(--primary-100);
  border-radius:var(--r-xl);
  padding:1.75rem 1.5rem;
  margin-bottom:1rem;
}
.tab-label{
  display:inline-block;
  font-family:var(--font-body);
  font-size:.68rem;font-weight:700;
  text-transform:uppercase;letter-spacing:.1em;
  color:var(--primary);
  background:var(--primary-100);
  border-radius:4px;
  padding:.25rem .65rem;
  margin-bottom:.875rem;
}

/* Illustrated preview */
.preview-box{
  background:var(--white);
  border:1px solid var(--secondary-100);
  border-radius:var(--r-lg);
  padding:1.25rem;
  margin-bottom:1.25rem;
  display:flex;flex-direction:column;gap:.75rem;
}
.preview-bar{
  height:8px;border-radius:999px;background:var(--primary);
}
.preview-bar-sm{
  height:8px;border-radius:999px;background:var(--secondary-200);
  width:75%;
}
.preview-bar-xs{
  height:8px;border-radius:999px;background:var(--secondary-100);
  width:50%;
}

.tab-title{
  font-family:var(--font-headline);
  font-size:1.3rem;font-weight:800;
  line-height:1.1;letter-spacing:-.02em;
  color:var(--neutral);margin-bottom:.65rem;
}
.tab-desc{
  font-family:var(--font-body);
  font-size:.82rem;color:var(--secondary);
  font-weight:300;line-height:1.7;margin-bottom:1.25rem;
}
.feature-list{display:flex;flex-direction:column;gap:.65rem;margin-bottom:1.35rem}
.feature-item{
  display:flex;align-items:center;gap:.75rem;
  font-family:var(--font-body);
  font-size:.82rem;color:var(--neutral-700);font-weight:500;
}
.feature-check{
  width:18px;height:18px;border-radius:50%;
  background:var(--primary);
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.feature-check svg{width:10px;height:10px;stroke:white;stroke-width:2.5;fill:none;stroke-linecap:round;stroke-linejoin:round}

/* ── EMPRESA CARD ── */
.empresa-card{
  background:var(--neutral);
  border-radius:var(--r-xl);
  padding:1.75rem 1.5rem;
  position:relative;overflow:hidden;
}
.empresa-card::before{
  content:'';position:absolute;top:-50px;right:-50px;
  width:180px;height:180px;border-radius:50%;
  background:rgba(15,82,186,.35);pointer-events:none;
}
.empresa-card::after{
  content:'';position:absolute;bottom:-30px;left:-20px;
  width:100px;height:100px;border-radius:50%;
  background:rgba(15,82,186,.2);pointer-events:none;
}
.empresa-label{
  display:inline-block;
  font-family:var(--font-body);
  font-size:.68rem;font-weight:700;
  text-transform:uppercase;letter-spacing:.1em;
  color:rgba(255,255,255,.6);
  background:rgba(255,255,255,.1);
  border-radius:4px;
  padding:.25rem .65rem;
  margin-bottom:.875rem;
}
.empresa-title{
  font-family:var(--font-headline);
  font-size:1.3rem;font-weight:800;
  line-height:1.1;letter-spacing:-.02em;
  color:var(--white);margin-bottom:.65rem;
}
.empresa-desc{
  font-family:var(--font-body);
  font-size:.82rem;color:rgba(255,255,255,.6);
  font-weight:300;line-height:1.7;margin-bottom:1.25rem;
}
.empresa-feature-item{
  display:flex;align-items:center;gap:.75rem;
  font-family:var(--font-body);
  font-size:.82rem;color:rgba(255,255,255,.8);font-weight:500;
}
.empresa-check{
  width:18px;height:18px;border-radius:50%;
  background:rgba(15,82,186,.5);
  border:1px solid rgba(15,82,186,.8);
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.empresa-check svg{width:10px;height:10px;stroke:rgba(255,255,255,.9);stroke-width:2.5;fill:none;stroke-linecap:round;stroke-linejoin:round}
.btn-empresa{
  display:flex;align-items:center;justify-content:center;gap:6px;
  width:100%;
  background:var(--primary);color:var(--white);
  border:none;border-radius:var(--r);
  padding:.875rem;
  font-family:var(--font-body);
  font-size:.875rem;font-weight:600;
  cursor:pointer;text-decoration:none;
  transition:all .18s;position:relative;z-index:1;
}
.btn-empresa:hover{background:var(--primary-light)}

/* Button for candidate section */
.btn-candidate{
  display:flex;align-items:center;justify-content:center;gap:6px;
  width:100%;
  background:var(--primary);color:var(--white);
  border:none;border-radius:var(--r);
  padding:.875rem;
  font-family:var(--font-body);
  font-size:.875rem;font-weight:600;
  cursor:pointer;text-decoration:none;
  transition:all .18s;
}
.btn-candidate:hover{background:var(--primary-dark)}

/* ── CTA FINAL ── */
.cta-section{
  background:var(--neutral);
  padding:4rem 1.5rem;text-align:center;
  position:relative;overflow:hidden;
}
.cta-section::before{
  content:'';position:absolute;
  top:50%;left:50%;transform:translate(-50%,-50%);
  width:320px;height:320px;border-radius:50%;
  background:radial-gradient(circle,rgba(15,82,186,.3) 0%,transparent 70%);
  pointer-events:none;
}
.cta-title{
  font-family:var(--font-headline);
  font-size:2rem;font-weight:800;
  line-height:1.08;letter-spacing:-.03em;
  color:var(--white);margin-bottom:1rem;
  position:relative;z-index:1;
}
.cta-title .primary-accent{color:var(--primary-400)}
.cta-desc{
  font-family:var(--font-body);
  font-size:.875rem;color:rgba(255,255,255,.55);
  font-weight:300;line-height:1.75;
  margin-bottom:2rem;position:relative;z-index:1;
}
.btn-cta-final{
  display:inline-flex;align-items:center;gap:8px;
  background:var(--primary);color:var(--white);
  border:none;border-radius:var(--r);
  padding:.9rem 2rem;
  font-family:var(--font-body);
  font-size:.9rem;font-weight:700;
  cursor:pointer;text-decoration:none;
  transition:all .2s;position:relative;z-index:1;
}
.btn-cta-final:hover{background:var(--primary-light);transform:translateY(-1px)}
.btn-cta-final svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round}

/* ── FOOTER ── */
footer{
  background:var(--neutral);
  border-top:1px solid rgba(255,255,255,.07);
  padding:2.5rem 1.5rem 2rem;
}
.footer-logo{
  font-family:var(--font-headline);
  font-weight:800;font-size:1.1rem;
  color:var(--white);letter-spacing:-.02em;
  text-decoration:none;display:inline-block;
  margin-bottom:.4rem;
}
.footer-logo span{color:var(--primary-400)}
.footer-tagline{
  font-family:var(--font-body);
  font-size:.78rem;color:rgba(255,255,255,.35);
  margin-bottom:2rem;font-weight:300;
}
.footer-cols{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem 2rem;margin-bottom:2rem}
.footer-col-title{
  font-family:var(--font-body);
  font-size:.68rem;font-weight:700;
  text-transform:uppercase;letter-spacing:.1em;
  color:rgba(255,255,255,.3);margin-bottom:.875rem;
}
.footer-links{list-style:none;display:flex;flex-direction:column;gap:.55rem}
.footer-links a{
  font-family:var(--font-body);
  font-size:.8rem;color:rgba(255,255,255,.5);
  text-decoration:none;font-weight:300;transition:color .2s;
}
.footer-links a:hover{color:var(--white)}
.footer-bottom{
  padding-top:1.5rem;
  border-top:1px solid rgba(255,255,255,.07);
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;
}
.footer-copy{
  font-family:var(--font-body);
  font-size:.7rem;color:rgba(255,255,255,.25);font-weight:300;
}
.footer-social{display:flex;gap:.6rem}
.social-btn{
  width:30px;height:30px;border-radius:7px;
  border:1px solid rgba(255,255,255,.12);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:border-color .2s,background .2s;
}
.social-btn:hover{border-color:var(--primary);background:rgba(15,82,186,.3)}
.social-btn svg{width:14px;height:14px;fill:rgba(255,255,255,.45)}
</style>
</head>
<body>

<!-- ── NAVBAR ── -->
<nav>
  <a class="nav-logo" href="#">
    <div class="nav-logo-mark">
      <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
    </div>
    TalentoES
  </a>
  <div class="nav-actions">
    <a class="btn-nav-login" href="index.php?pagina=ingreso">Login</a>
  </div>
</nav>

<!-- ── HERO ── -->
<section class="hero">
  <div class="hero-eyebrow fade">
    <span class="hero-eyebrow-dot"></span>
    Plataforma líder en El Salvador
  </div>

  <h1 class="fade d1">
    Encuentra el talento que tu empresa necesita <span class="muted">o el trabajo de tus sueños.</span>
  </h1>

  <p class="hero-desc fade d2">
    La plataforma líder en El Salvador que conecta profesionales excepcionales con empresas que transforman el futuro.
  </p>

  <div class="hero-cta fade d3">
    <a href="index.php?pagina=registro" class="btn-hero-primary">
      Registrarse
      <span class="arrow">→</span>
    </a>
    <a href="index.php?pagina=ingreso" class="btn-hero-secondary">Iniciar Sesión</a>
  </div>

  <div class="hero-stats fade d4">
    <div class="hstat">
      <div class="hstat-num">12<sup>k</sup></div>
      <div class="hstat-lbl">Profesionales activos</div>
    </div>
    <div class="hstat">
      <div class="hstat-num">850<sup>+</sup></div>
      <div class="hstat-lbl">Empresas registradas</div>
    </div>
    <div class="hstat">
      <div class="hstat-num">94<sup>%</sup></div>
      <div class="hstat-lbl">Satisfacción</div>
    </div>
  </div>
</section>

<!-- ── ¿POR QUÉ ELEGIR? ── -->
<section class="section section-tertiary">
  <div class="sec-tag fade">
    <span class="sec-tag-line"></span>
    ¿Por qué elegir TalentoES?
  </div>

  <div class="benefit-cards">
    <div class="benefit-card fade d1">
      <div class="benefit-icon">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
      </div>
      <div>
        <div class="benefit-title">Alcance Nacional</div>
        <div class="benefit-text">Conectamos oportunidades en cada rincón de El Salvador, desde startups locales hasta multinacionales.</div>
      </div>
    </div>

    <div class="benefit-card fade d2">
      <div class="benefit-icon">
        <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.68A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
      </div>
      <div>
        <div class="benefit-title">Conexión Directa</div>
        <div class="benefit-text">Eliminamos barreras de comunicación para que candidatos y reclutadores hablen sin intermediarios.</div>
      </div>
    </div>

    <div class="benefit-card fade d3">
      <div class="benefit-icon">
        <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      </div>
      <div>
        <div class="benefit-title">Seguridad</div>
        <div class="benefit-text">Verificamos cada empresa y oferta para garantizar un entorno de búsqueda confiable.</div>
      </div>
    </div>
  </div>
</section>

<!-- ── PARA CANDIDATOS ── -->
<section class="section section-white" style="padding-bottom:1rem">
  <div class="tab-section fade">
    <div class="tab-label">Para Candidatos</div>


    <div class="tab-title">Potencia tu carrera profesional</div>
    <p class="tab-desc">Crea un perfil que destaque, accede a ofertas exclusivas y recibe recomendaciones personalizadas basadas en tus habilidades únicas.</p>

    <div class="feature-list">
      <div class="feature-item">
        <div class="feature-check"><svg viewBox="0 0 12 12"><polyline points="2,6 5,9 10,3"/></svg></div>
        Búsqueda Avanzada de empleos
      </div>
      <div class="feature-item">
        <div class="feature-check"><svg viewBox="0 0 12 12"><polyline points="2,6 5,9 10,3"/></svg></div>
        Perfil Optimizado con recomendaciones
      </div>
      <div class="feature-item">
        <div class="feature-check"><svg viewBox="0 0 12 12"><polyline points="2,6 5,9 10,3"/></svg></div>
        Alertas de empleos en tiempo real
      </div>
    </div>

    <a href="index.php?pagina=registro" class="btn-candidate">Crear mi perfil gratis</a>
  </div>
</section>

<!-- ── PARA EMPRESAS ── -->
<section class="section section-white" style="padding-top:0">
  <div class="empresa-card fade">
    <div class="empresa-label">Para Empresas</div>
    <div class="empresa-title">Encuentra el fit perfecto</div>
    <p class="empresa-desc">Gestiona vacantes, filtra candidatos calificados y comunícate directamente con el talento que necesitas.</p>

    <div class="feature-list" style="margin-bottom:1.35rem">
      <div class="empresa-feature-item">
        <div class="empresa-check"><svg viewBox="0 0 12 12"><polyline points="2,6 5,9 10,3"/></svg></div>
        Gestión inteligente de vacantes
      </div>
      <div class="empresa-feature-item">
        <div class="empresa-check"><svg viewBox="0 0 12 12"><polyline points="2,6 5,9 10,3"/></svg></div>
        Filtrado por 14+ criterios de candidatos
      </div>
      <div class="empresa-feature-item">
        <div class="empresa-check"><svg viewBox="0 0 12 12"><polyline points="2,6 5,9 10,3"/></svg></div>
        Dashboard de reclutamiento
      </div>
    </div>

    <a href="index.php?pagina=ingreso" class="btn-empresa">Publicar Oferta</a>
  </div>
</section>

<!-- ── CTA FINAL ── -->
<section class="cta-section">
  <h2 class="cta-title fade">
    El futuro de tu empresa comienza <span class="primary-accent">aquí.</span>
  </h2>
  <p class="cta-desc fade d1">
    Únete a miles de profesionales y empresas que ya están transformando el mercado laboral en El Salvador.
  </p>
  <a href="index.php?pagina=ingreso" class="btn-cta-final fade d2">
    Comenzar Ahora
    <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
  </a>
</section>

<!-- ── FOOTER ── -->
<footer>
  <a class="footer-logo" href="#">TalentoES</a>
  <p class="footer-tagline">Conectando el mejor talento con las mejores empresas en todo El Salvador.</p>

  <div class="footer-cols">
    <div>
      <div class="footer-col-title">Empresa</div>
      <ul class="footer-links">
        <li><a href="#">About Us</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Service</a></li>
      </ul>
    </div>
    <div>
      <div class="footer-col-title">Recursos</div>
      <ul class="footer-links">
        <li><a href="#">Find Jobs</a></li>
        <li><a href="index.php?pagina=registro">Post a Job</a></li>
        <li><a href="#">Blog</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="footer-copy">© 2026 TalentoES. All rights reserved.</div>
    <div class="footer-social">
      <div class="social-btn" aria-label="Instagram">
        <!-- Social Media Icon Set Made With NiftyButtons.com -->
            <div class="social-icons" style="display: flex; gap: 0px; flex-wrap: wrap; justify-content: center;">
              <a href="#" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; justify-content: center; width: 25px; height: 58px; color: #59596ad2; text-decoration: none;" >
                <svg class="niftybutton-instagram" data-donate="true" data-tag="ins" data-name="Instagram" viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet" width="25px" height="25px" style="width: 58px; height: 58px; display: block; fill: #59596ad2;"><title>Instagram social icon</title>
                <path d="M256 109.3c47.8 0 53.4 0.2 72.3 1 17.4 0.8 26.9 3.7 33.2 6.2 8.4 3.2 14.3 7.1 20.6 13.4 6.3 6.3 10.1 12.2 13.4 20.6 2.5 6.3 5.4 15.8 6.2 33.2 0.9 18.9 1 24.5 1 72.3s-0.2 53.4-1 72.3c-0.8 17.4-3.7 26.9-6.2 33.2 -3.2 8.4-7.1 14.3-13.4 20.6 -6.3 6.3-12.2 10.1-20.6 13.4 -6.3 2.5-15.8 5.4-33.2 6.2 -18.9 0.9-24.5 1-72.3 1s-53.4-0.2-72.3-1c-17.4-0.8-26.9-3.7-33.2-6.2 -8.4-3.2-14.3-7.1-20.6-13.4 -6.3-6.3-10.1-12.2-13.4-20.6 -2.5-6.3-5.4-15.8-6.2-33.2 -0.9-18.9-1-24.5-1-72.3s0.2-53.4 1-72.3c0.8-17.4 3.7-26.9 6.2-33.2 3.2-8.4 7.1-14.3 13.4-20.6 6.3-6.3 12.2-10.1 20.6-13.4 6.3-2.5 15.8-5.4 33.2-6.2C202.6 109.5 208.2 109.3 256 109.3M256 77.1c-48.6 0-54.7 0.2-73.8 1.1 -19 0.9-32.1 3.9-43.4 8.3 -11.8 4.6-21.7 10.7-31.7 20.6 -9.9 9.9-16.1 19.9-20.6 31.7 -4.4 11.4-7.4 24.4-8.3 43.4 -0.9 19.1-1.1 25.2-1.1 73.8 0 48.6 0.2 54.7 1.1 73.8 0.9 19 3.9 32.1 8.3 43.4 4.6 11.8 10.7 21.7 20.6 31.7 9.9 9.9 19.9 16.1 31.7 20.6 11.4 4.4 24.4 7.4 43.4 8.3 19.1 0.9 25.2 1.1 73.8 1.1s54.7-0.2 73.8-1.1c19-0.9 32.1-3.9 43.4-8.3 11.8-4.6 21.7-10.7 31.7-20.6 9.9-9.9 16.1-19.9 20.6-31.7 4.4-11.4 7.4-24.4 8.3-43.4 0.9-19.1 1.1-25.2 1.1-73.8s-0.2-54.7-1.1-73.8c-0.9-19-3.9-32.1-8.3-43.4 -4.6-11.8-10.7-21.7-20.6-31.7 -9.9-9.9-19.9-16.1-31.7-20.6 -11.4-4.4-24.4-7.4-43.4-8.3C310.7 77.3 304.6 77.1 256 77.1L256 77.1z" fill="#59596ad2"></path>
                <path d="M256 164.1c-50.7 0-91.9 41.1-91.9 91.9s41.1 91.9 91.9 91.9 91.9-41.1 91.9-91.9S306.7 164.1 256 164.1zM256 315.6c-32.9 0-59.6-26.7-59.6-59.6s26.7-59.6 59.6-59.6 59.6 26.7 59.6 59.6S288.9 315.6 256 315.6z" fill="#59596ad2"></path>
                <circle cx="351.5" cy="160.5" r="21.5" fill="#59596ad2"></circle>
</svg>
  </a>
</div>
      </div>
      <div class="social-btn" aria-label="Twitter">
        <svg viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
      </div>
      <div class="social-btn" aria-label="Facebook">
        <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
      </div>
    </div>
  </div>
</footer>

<script>
const obs = new IntersectionObserver((entries) => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('in') });
}, {threshold: 0.1});
document.querySelectorAll('.fade').forEach(el => obs.observe(el));
</script>
</body>
</html>