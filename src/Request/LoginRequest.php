<?php
namespace App\Request;

use App\models\Usuario;

class LoginRequest {

    static public function validacion(Usuario $usuario)
    {            
        $errores = [];          
       
        $correo = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $password = "/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+\-=\[\]{};:\"\\|,.<>\/?]{8,}$/";              

        // correo
        if(empty($usuario->correo)){
            $errores['correo'] =  'El campo correo no debe ir vacío.';
        } else {
            if(!preg_match($correo, $usuario->correo)){
                $errores['correo'] =  'Por favor, ingrese un correo valido.';
            }
        }
              

        // password
        if(empty($usuario->password)){
            $errores['password'] =  'El campo password no debe ir vacío.';
        } else {
            if(!preg_match($password, $usuario->password)){
                $errores['password'] =  'Password ingresada no es correcta.';
            }
        }
                            
    return $errores;
    }
}