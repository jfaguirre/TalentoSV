<?php

namespace App\controller;

use App\controller\AuthControlador;
use App\models\Empresa;

class PlantillaControlador
{
    public function plantilla()
    {        
        // Iniciar sesión si no se ha iniciado
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Manejar cierre de sesión
        if (isset($_GET['pagina']) && $_GET['pagina'] === 'salir') {
            AuthControlador::logout();
            header('Location: index.php');
            exit;
        }

        // Manejar cambio de modo (candidato <-> empresa)
        if (isset($_GET['cambiar_modo']) && isset($_SESSION['userAuth'])) {
            $nuevoModo = $_GET['cambiar_modo'];
            if ($nuevoModo === 'usuario') {
                $_SESSION['userAuth']['modo'] = 'usuario';
                $_SESSION['userAuth']['empresa_id'] = null;
                header('Location: index.php?pagina=inicio');
                exit;
            } elseif ($nuevoModo === 'empresa') {
                $id_usuario = $_SESSION['userAuth']['id'];
                // Buscar si el usuario ya tiene empresa
                $empresa = Empresa::obtenerPorUsuario($id_usuario);
                
                if (!$empresa) {
                    // Si no existe, no creamos automáticamente, redirigimos al registro
                    header('Location: index.php?pagina=registrar_empresa');
                    exit;
                } else {
                    $empresa_id = $empresa['id_empresa'];
                }

                if ($empresa_id) {
                    $_SESSION['userAuth']['modo'] = 'empresa';
                    $_SESSION['userAuth']['empresa_id'] = $empresa_id;
                }
                header('Location: index.php?pagina=inicio');
                exit;
            }
        }
        
        if(!isset($_SESSION['userAuth']))
        {
            include 'views/layouts/plantilla.php';
            return;
        }
                
        $rol = $_SESSION['userAuth']['rol'];
        $modo = $_SESSION['userAuth']['modo'] ?? 'usuario';
        

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