<?php
$base_path = (strpos($_SERVER['SCRIPT_NAME'], 'views/') !== false) ? '../../' : '';

$titulo = "TalentoSV";
$is_auth_page = false;

if (isset($_GET['pagina'])) {
    if ($_GET['pagina'] === 'ingreso') {
        $titulo = "Iniciar Sesión — TalentoES";
        $is_auth_page = true;
    } elseif ($_GET['pagina'] === 'registro') {
        $titulo = "Registrarse — TalentoES";
        $is_auth_page = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>    

    <!-- Estilos -->
    <?php if ($is_auth_page): ?>
        <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/auth.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/registro.css">
        <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/inicio.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?php endif; ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="<?php echo $base_path; ?>assets/js/sweetalert2.all.min.js"></script>

</head>
<body>

<?php if (!$is_auth_page): ?>
<header>
    <!-- <?php include 'views/componentes/menu.php'; ?> -->
</header>
<?php endif; ?>

<main>
    <section class="contenido">
        <!-- Contenido -->        
        <?php             
            // Páginas permitidas
            $paginasPermitidas = 
            [
                'inicio',
                'registro',
                'ingreso',
                'salir',
                'error404'
            ];                        
            
            $pagina = $_GET['pagina'] ?? 'inicio';                       
                        
            if (in_array($pagina, $paginasPermitidas, true)) {
                include "views/paginas/{$pagina}.php";
            } else {
                include 'views/paginas/error404.php';
            }            
        ?>

    </section>
</main>
    
</body>
</html>