<?php
$base_path = (strpos($_SERVER['SCRIPT_NAME'], 'views/') !== false) ? '../../' : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard usuario</title>    

    <!-- Estilos -->
    <link rel="stylesheet" href="../../assets/css/registro.css">

    
    
    <!-- Estilos -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/dashboard_usuario.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="../../assets/js/sweetalert2.all.min.js"></script>

</head>
<body>


<header>
    <?php include 'views/componentes/menu_usuario.php'; ?>
</header>

<main>
    <section class="contenido">
    <!-- Contenido -->
        <?php             
            // Páginas permitidas
            $paginasPermitidas = 
            [
                'inicio',
                'perfil',
                'curriculum',
                'configuracion',
                'registrar_empresa',
            ];                        
            
            $pagina = $_GET['pagina'] ?? 'inicio';                       
                        
            if (in_array($pagina, $paginasPermitidas, true)) {
                include "views/usuarios/{$pagina}.php";
            } else {
                include 'views/paginas/error404.php';
            }            
        ?>
             
    </section>
</main>
    
</body>
</html>