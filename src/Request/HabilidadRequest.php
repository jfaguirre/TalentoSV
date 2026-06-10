<?php
namespace App\Request;

use App\models\Habilidad;

class HabilidadRequest {

    static public function validacion(Habilidad $habilidad)
    {            
        $errores = [];          

        $habilidadPattern = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\+\#\-\.\(\)]{2,100}$/";

        // habilidad
        if(empty($habilidad->habilidad)){
            $errores['habilidad'] = 'El campo habilidad no debe ir vacío.';
        } else {
            if(!preg_match($habilidadPattern, $habilidad->habilidad)){
                $errores['habilidad'] = 'La habilidad debe tener al menos 2 caracteres y contener letras, números o símbolos comunes.';
            }
        }
                             
        return $errores;
    }
}
