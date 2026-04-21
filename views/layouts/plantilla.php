<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentoSV</title>    
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