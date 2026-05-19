<?php

namespace App\controller;

use App\models\Usuario;

class AuthControlador {

    // Para determinar que role tiene el usuario
    static public function checkRole(array $respuesta)
    {
                
        $role = Usuario::checkRole($respuesta);

        die(var_dump($role));
        return $role;
    }

    // Para verificar si el usuario esta logeado
    static public function isLogin()
    {
        if (isset($_SESSION['user_auth'])) {
            return json_decode($_SESSION['user_auth'], true);
        }
        return null;
    }

    // Cerrar sesion
    static public function logout()
    {
        unset($_SESSION['user_auth']);
        session_destroy();
    }
}

