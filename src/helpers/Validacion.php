<?php
namespace App\helpers;

use App\models\Usuario;

class Validacion {

    static public function validacion(Usuario $usuario)
    {            
        $errores = [];

        $nombre = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,50}$/";
        $apellido = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,50}$/";
        // $telefono = "/^\d{8,15}$/";
        $correo = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $password = "/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+\-=\[\]{};:\"\\|,.<>\/?]{8,}$/";

        // nombre
        if(isset($usuario->nombre)){
            if(empty($usuario->nombre)){
                $errores['nombre'] =  'El campo nombre no debe ir vacío.';
            } else {
                if(!preg_match($nombre, $usuario->nombre)){
                    $errores['nombre'] =  'Solo se aceptan letras y un minimo 3 caracteres-';
                }
            }
        }       

        // apellido
        if(isset($usuario->apellido)){
            if(empty($usuario->apellido)){
                $errores['apellido'] =  'El campo apellido no debe ir vacío.';
            } else {
                if(!preg_match($apellido, $usuario->apellido)){
                    $errores['apellido'] =  'Solo se aceptan letras y un minimo 3 caracteres-';
                }
            }
        }       

        // telefono
        // if(isset($datos->telefono)){
        //     if(empty($datos->telefono)){
        //         $errores['telefono'] =  'El campo telefono no debe ir vacío.';
        //     } else {
        //         if(!preg_match($telefono, $datos->telefono)){
        //             $errores['telefono'] =  'Solo se aceptan numeros y un minimo 8 numeros.';
        //         }
        //     }
        // }       

        // correo
        if(isset($usuario->correo)){
            if(empty($usuario->correo)){
                $errores['correo'] =  'El campo correo no debe ir vacío.';
            } else {
                if(!preg_match($correo, $usuario->correo)){
                    $errores['correo'] =  'Por favor, ingrese un correo valido.';
                }
            }
        }       

        // password
        if(isset($usuario->password)){
            if(empty($usuario->password)){
                $errores['password'] =  'El campo password no debe ir vacío.';
            } else {
                if(!preg_match($password, $usuario->password)){
                    $errores['password'] =  'Password ingresada no es correcta.';
                }
            }
        }
            
    return $errores;
    }
}