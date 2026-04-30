<?php

namespace App\helpers;

class Validacion {

    static public function validacion($datos){
        
    $errores = [];

        $nombre = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,50}$/";
        $apellido = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,50}$/";
        $telefono = "/^\d{8,15}$/";
        $correo = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $password = "/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+\-=\[\]{};:\"\\|,.<>\/?]{8,}$/";

        // nombre
        if(isset($datos->nombre)){
            if(empty($datos->nombre)){
                $errores['nombre'] =  'El campo nombre no debe ir vacío.';
            } else {
                if(!preg_match($nombre, $datos->nombre)){
                    $errores['nombre'] =  'Solo se aceptan letras y un minimo 3 caracteres-';
                }
            }
        }       

        // apellido
        if(isset($datos->apellido)){
            if(empty($datos->apellido)){
                $errores['apellido'] =  'El campo apellido no debe ir vacío.';
            } else {
                if(!preg_match($apellido, $datos->apellido)){
                    $errores['apellido'] =  'Solo se aceptan letras y un minimo 3 caracteres-';
                }
            }
        }       

        // telefono
        if(isset($datos->telefono)){
            if(empty($datos->telefono)){
                $errores['telefono'] =  'El campo telefono no debe ir vacío.';
            } else {
                if(!preg_match($telefono, $datos->telefono)){
                    $errores['telefono'] =  'Solo se aceptan numeros y un minimo 8 numeros.';
                }
            }
        }       

        // correo
        if(isset($datos->correo)){
            if(empty($datos->correo)){
                $errores['correo'] =  'El campo correo no debe ir vacío.';
            } else {
                if(!preg_match($correo, $datos->correo)){
                    $errores['correo'] =  'Por favor, ingrese un correo valido.';
                }
            }
        }       

        // correo
        if(isset($datos->password)){
            if(empty($datos->password)){
                $errores['password'] =  'El campo password no debe ir vacío.';
            } else {
                if(!preg_match($password, $datos->password)){
                    $errores['password'] =  'Password ingresada no es correcta.';
                }
            }
        }
        
    return $errores;
    }
}