<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentoSV</title>    

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
    <?php include 'views/layouts/menu.php'; ?>
</header>

<main>
    <section class="contenido">
        <!-- Contenido -->
        <?php             
            if(isset($_GET['pagina'])){
                if($_GET['pagina'] == 'inicio'   ||
                   $_GET['pagina'] == 'registro' ||
                   $_GET['pagina'] == 'ingreso'  ||
                   $_GET['pagina'] == 'salir'    
                   
                ){                                    
                    include "views//paginas/".$_GET['pagina'].".php";
                } else {
                    include "views/paginas/error404.php";
                }
            } else {
                include 'views/paginas/inicio.php';
            }            
        ?>

    </section>
</main>
    
</body>
</html>