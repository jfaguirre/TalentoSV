<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard usuario</title>    

    <!-- Estilos -->
    <link rel="stylesheet" href="../../assets/css/registro.css">

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
<<<<<<< HEAD
        <?php             
            // Páginas permitidas
            $paginasPermitidas = 
            [
                'inicio',
                'perfil',
                'curriculum',
                'configuracion',
            ];                        
            
            $pagina = $_GET['pagina'] ?? 'inicio';                       
                        
            if (in_array($pagina, $paginasPermitidas, true)) {
                include "views/usuarios/{$pagina}.php";
            } else {
                include 'views/paginas/error404.php';
            }            
        ?>
             
=======
    <?php             
            if(isset($_GET['pagina'])){
                if($_GET['pagina'] == 'inicio'   ||
                   $_GET['pagina'] == 'perfil' ||
                   $_GET['pagina'] == 'curriculum'  ||
                   $_GET['pagina'] == 'configuraciones'    
                   
                ){                                    
                    include "views//usuarios/".$_GET['pagina'].".php";
                } else {
                    include "views/paginas/error404.php";
                }
            } else {
                include 'views/paginas/inicio.php';
            }            
        ?>

>>>>>>> 45275fce6be8a7d061cdcb0a518f5879f13b653f
    </section>
</main>
    
</body>
</html>