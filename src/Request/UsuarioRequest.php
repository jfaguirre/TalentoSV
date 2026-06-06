<?php
namespace App\Request;

use App\models\Usuario;

class UsuarioRequest {

    static public function validacion(Usuario $usuario)
    {            
        $errores = [];          

        $nombre = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,50}$/";
        $apellido = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,50}$/";        
        $correo = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $password = "/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+\-=\[\]{};:\"\\|,.<>\/?]{8,}$/";

        // nombre
        if(empty($usuario->nombre)){
            $errores['nombre'] =  'El campo nombre no debe ir vacío.';
        } else {
            if(!preg_match($nombre, $usuario->nombre)){
                $errores['nombre'] =  'Solo se aceptan letras y un minimo 3 caracteres.';
            }
        }
               

        // apellido
        if(empty($usuario->apellido)){
            $errores['apellido'] =  'El campo apellido no debe ir vacío.';
        } else {
            if(!preg_match($apellido, $usuario->apellido)){
                $errores['apellido'] =  'Solo se aceptan letras y un minimo 3 caracteres.';
            }
        }
                   

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
                $errores['password'] =  'Debe ingresar una contraseña segura.';
            }
        }
                            
    return $errores;
    }
}