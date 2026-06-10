<?php
namespace App\Request;

use App\models\Estudio;

class EstudioRequest {

    static public function validacion(Estudio $estudio)
    {            
        $errores = [];          

        // RegExp checks for text inputs
        $tituloPattern = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s,\.\-\(\)]{3,150}$/";
        $institucionPattern = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s,\.\-\(\)]{3,150}$/";

        // titulo
        if(empty($estudio->titulo)){
            $errores['titulo'] = 'El campo título no debe ir vacío.';
        } else {
            if(!preg_match($tituloPattern, $estudio->titulo)){
                $errores['titulo'] = 'El título debe tener entre 3 y 150 caracteres válidos.';
            }
        }
               
        // institucion
        if(empty($estudio->institucion)){
            $errores['institucion'] = 'El campo institución no debe ir vacío.';
        } else {
            if(!preg_match($institucionPattern, $estudio->institucion)){
                $errores['institucion'] = 'La institución debe tener entre 3 y 150 caracteres válidos.';
            }
        }
                    
        // fecha_logro
        if(empty($estudio->fecha_logro)){
            $errores['fecha_logro'] = 'El campo fecha de logro no debe ir vacío.';
        }
              
        // estado
        $estadosValidos = ['En curso', 'Finalizado', 'Suspendido'];
        if(empty($estudio->estado)){
            $errores['estado'] = 'El campo estado no debe ir vacío.';
        } else {
            if(!in_array($estudio->estado, $estadosValidos, true)){
                $errores['estado'] = 'El estado seleccionado no es válido.';
            }
        }
                             
        return $errores;
    }
}
