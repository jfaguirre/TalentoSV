<?php
namespace App\Request;

use App\models\Referencia;

class ReferenciaRequest {

    static public function validacion(Referencia $referencia)
    {            
        $errores = [];          

        $nombrePattern = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.]{3,100}$/";
        $telefonoPattern = "/^[0-9\-\+\s\(\)]{8,20}$/";
        $correoPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

        // nombre_referencia
        if(empty($referencia->nombre_referencia)){
            $errores['nombre_referencia'] = 'El campo nombre de referencia no debe ir vacío.';
        } else {
            if(!preg_match($nombrePattern, $referencia->nombre_referencia)){
                $errores['nombre_referencia'] = 'Solo se aceptan letras y un mínimo de 3 caracteres.';
            }
        }
               
        // telefono_contacto
        if(!empty($referencia->telefono_contacto)){
            if(!preg_match($telefonoPattern, $referencia->telefono_contacto)){
                $errores['telefono_contacto'] = 'El número de teléfono no es válido.';
            }
        }
                    
        // correo_contacto
        if(!empty($referencia->correo_contacto)){
            if(!preg_match($correoPattern, $referencia->correo_contacto)){
                $errores['correo_contacto'] = 'El correo electrónico no es válido.';
            }
        }
                             
        return $errores;
    }
}
