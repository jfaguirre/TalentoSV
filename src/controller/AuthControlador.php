<?php

namespace App\controller;

use App\models\Usuario;

class AuthControlador {

    // Para determinar que rol tiene el usuario
    static public function checkRole(array $respuesta)
    {
                
        $rol = Usuario::checkRole($respuesta);        
        return $rol;
    }

    // Para verificar si el usuario esta logeado
    static public function isLogin()
    {
        if (isset($_SESSION['userAuth'])) {
            return json_decode($_SESSION['userAuth'], true);
        }
        return null;
    }

    // Cerrar sesion
    static public function logout()
    {
        unset($_SESSION['userAuth']);
        session_destroy();
    }
}

