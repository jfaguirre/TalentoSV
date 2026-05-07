<?php

namespace App\controller;

class Auth {

    // Para determinar que role tiene el usuario
    static public function checkRole(array $datos)
    {            

        return $datos;
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

