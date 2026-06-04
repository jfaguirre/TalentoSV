<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\controller\OfertaController;

session_start();

// ✅ Validar ID correctamente
$id = filter_input(INPUT_GET, 'id_departamento', FILTER_VALIDATE_INT);


$usuario = OfertaController::obtenerUsuario();

// Si existe usuario, sacar iniciales
$iniciales = $usuario ? OfertaController::obtenerIniciales($usuario) : '';

if (!$id) {
    die("Departamento no válido");
}

// ✅ Obtener ofertas desde el controlador
$ofertas = OfertaController::getOfertasPorDepartamento($id);

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ofertas</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;}

:root{
--primary:#6C5CE7;
--bg-dark:#1E1E2E;
--bg-dark2:#232336;
--text-muted:#9A9AB0;
--text-white:#FFF;
--bg-body:#F0F0F5;
}

/* BODY */
body{
font-family:'Segoe UI',sans-serif;
background:var(--bg-body);
}

/* SIDEBAR EXACTO */
.sidebar{
position:fixed;
width:260px;
height:100vh;
background:linear-gradient(180deg,#1E1E2E,#232336);
color:white;
display:flex;
flex-direction:column;
}

/* USER */
.user{
display:flex;
gap:12px;
padding:20px;
align-items:center;
border-bottom:1px solid #2f2f45;
}

.avatar{
width:45px;
height:45px;
border-radius:12px;
background:linear-gradient(135deg,#6C5CE7,#00D2FF);
display:flex;
align-items:center;
justify-content:center;
font-weight:bold;
}

.user-info span{
display:block;
font-size:13px;
color:var(--text-muted);
}

/* NAV */
.nav{
padding:15px;
flex:1;
}

.label{
font-size:11px;
color:var(--text-muted);
margin:10px 0;
letter-spacing:1px;
}

.item{
display:flex;
align-items:center;
justify-content:space-between;
padding:12px;
border-radius:12px;
color:var(--text-muted);
text-decoration:none;
margin-bottom:5px;
}

.item:hover{
background:#2A2A3C;
color:white;
}

/* ACTIVE */
.item.active{
background:linear-gradient(135deg,#6C5CE7,#5A4BD1);
color:white;
}

/* BADGE */
.badge{
background:#00D2FF;
color:black;
font-size:11px;
padding:2px 8px;
border-radius:20px;
}

/* FOOTER */
.footer{
padding:15px;
border-top:1px solid #2f2f45;
}

.logout{
color:#FF6B6B;
text-decoration:none;
display:flex;
gap:10px;
}

/* MAIN */
.main{
margin-left:260px;
padding:30px;
}

/* BOTON */
.btn{
display:inline-block;
margin-bottom:20px;
padding:10px 15px;
background:#6C5CE7;
color:white;
border-radius:8px;
text-decoration:none;
}

/* GRID */
.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
gap:20px;
}

/* CARD PROFESIONAL */
.card{
background:white;
padding:18px;
border-radius:12px;
text-decoration:none;
color:#2D2D3F;
border:1px solid #e4e6ef;
box-shadow:0 2px 6px rgba(0,0,0,0.05);
display:flex;
flex-direction:column;
gap:10px;
transition:0.25s;
}

.card:hover{
transform:translateY(-4px);
box-shadow:0 8px 18px rgba(0,0,0,0.08);
}

/* HEADER CARD */
.card__header{
display:flex;
justify-content:space-between;
}

.card__empresa{
font-size:13px;
color:#888;
}

.card__tipo{
font-size:11px;
background:#eef2ff;
color:#6C5CE7;
padding:3px 7px;
border-radius:6px;
}

/* TITULO */
.card__titulo{
font-weight:bold;
font-size:16px;
}

/* DESCRIPCION */
.card__desc{
font-size:13px;
color:#777;
}

/* SALARIO */
.card__salario{
font-size:13px;
color:#555;
}

/* FOOTER */
.card__footer{
font-size:12px;
color:#6C5CE7;
}

/* RESPONSIVE */
@media (max-width:768px){

.sidebar{
width:100%;
height:auto;
position:relative;
flex-direction:row;
overflow-x:auto;
}

.item{
flex:1;
justify-content:center;
font-size:13px;
}

.main{
margin-left:0;
padding:15px;
}

.cards{
grid-template-columns:1fr;
}
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="user">

        <div class="avatar">
    <?= $iniciales ?: 'U' ?>
</div>
<strong>
<?php if($usuario): ?>
    <?= htmlspecialchars($usuario['nombre']); ?>
<?php else: ?>
    Invitado
<?php endif; ?>
</strong>
    </div>

    <div class="nav">

        <div class="label">PRINCIPAL</div>

        <a href="dashboard.php" class="item active">Inicio</a>
        <a href="#" class="item">Perfil</a>

        <a href="#" class="item">
            Currículum
            <span class="badge">Nuevo</span>
        </a>

        <div class="label">SISTEMA</div>

        <a href="#" class="item">Configuraciones</a>

    </div>

    <div class="footer">
        <a href="#" class="logout">Cerrar sesión</a>
    </div>

</div>

<!-- MAIN -->
<div class="main">

<a href="/TalentoSV/index.php?pagina=inicio" class="btn">← Volver</a>

<div class="cards">

<?php foreach($ofertas as $oferta): ?>

<a class="card" href="detalle_oferta.php?id=<?php echo $oferta['id_oferta']; ?>">

    <div class="card__header">
     <span class="card__empresa">
    Empresa - <?= htmlspecialchars($oferta['empresa'] ?? 'Sin empresa'); ?>
</span>


        <span class="card__tipo">
            <?php echo htmlspecialchars($oferta['tipo_contrato'] ?? 'Tiempo completo'); ?>
        </span>
    </div>

    <div class="card__titulo">
        <?php echo htmlspecialchars($oferta['titulo']); ?>
    </div>

    <div class="card__desc">
        <?php echo htmlspecialchars($oferta['descripcion'] ?? 'Sin descripción'); ?>
    </div>

    <div class="card__salario">
        💰 <?php echo htmlspecialchars($oferta['salario'] ?? 'No especificado'); ?>
    </div>

    <div class="card__footer">
        Ver detalles →
    </div>

</a>

<?php endforeach; ?>

</div>

</div>

</body>
</html>