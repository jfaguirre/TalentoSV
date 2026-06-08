<?php
$base_path = (strpos($_SERVER['SCRIPT_NAME'], 'views/') !== false) ? '../../' : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empresa — TalentoES</title>    

    <!-- Estilos -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/dashboard_empresa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    // Bootstrap 
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="<?php echo $base_path; ?>assets/js/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="dashboard-container">
    <header>
        <?php include 'views/componentes/menu_empresa.php'; ?>
    </header>

    <main class="main-content">
        <?php             
            // Páginas permitidas
            $paginasPermitidas = 
            [
                'inicio',
                'perfil',
                'ofertas',
                'configuracion',
            ];                        
            
            $pagina = $_GET['pagina'] ?? 'inicio';                       
                        
            if (in_array($pagina, $paginasPermitidas, true)) {
                include "views/empresas/{$pagina}.php";
            } else {
                include 'views/paginas/error404.php';
            }            
        ?>
    </main>
</div>
    
</body>
</html>
