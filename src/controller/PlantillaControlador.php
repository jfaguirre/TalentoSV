<?php

namespace App\controller;

use App\controller\AuthControlador;

class PlantillaControlador
{
    public function plantilla()
    {        
        if (isset($_GET['pagina']) && $_GET['pagina'] === 'salir') {
            AuthControlador::logout();
            header('Location: index.php');
            exit;
        }
        
        if(!isset($_SESSION['userAuth']))
        {
            include 'views/layouts/plantilla.php';
            return;
        }
                
        $rol = $_SESSION['userAuth']['rol'];
        $modo = $_SESSION['userAuth']['modo'];
        

        // Admin
        if($rol === 'admin')
        {        
            include 'views/layouts/admin.php';            
            return;
        }

        // Modo empresa
        if($modo === 'empresa')
        {
            include 'views/layouts/empresa.php';
            return;
        }

        // Modo usuario
        include 'views/layouts/usuarios.php';
    }
}