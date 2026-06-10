<?php
namespace App\Request;

use App\models\Experiencia;

class ExperienciaRequest {

    static public function validacion(Experiencia $experiencia)
    {            
        $errores = [];          

        $empresa = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9]+(?: [A-Za-zÁÉÍÓÚáéíóúÑñ0-9]+)*$/";
        $puesto = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9]+(?: [A-Za-zÁÉÍÓÚáéíóúÑñ0-9]+)*$/";        
        $descripcion = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9]+(?: [A-Za-zÁÉÍÓÚáéíóúÑñ0-9]+)*$/";        
        
        // empresa
        if(empty($experiencia->empresa)){
            $errores['empresa'] =  'El campo nombre de la empresa no debe ir vacío.';
        } else {
            if(!preg_match($empresa, $experiencia->empresa)){
                $errores['empresa'] =  'Solo se aceptan letras y un minimo 3 caracteres.';
            }
        }
               
        // puesto
        if(empty($experiencia->puesto)){
            $errores['puesto'] =  'El campo puesto no debe ir vacío.';
        } else {
            if(!preg_match($puesto, $experiencia->puesto)){
                $errores['puesto'] =  'Solo se aceptan letras y un minimo 3 caracteres.';
            }
        }
                   
        // descripcion
        if(empty($experiencia->descripcion)){
            $errores['descripcion'] =  'El campo descripcion no debe ir vacío.';
        } else {
            if(!preg_match($descripcion, $experiencia->descripcion)){
                $errores['descripcion'] =  'Por favor, ingrese un descripcion valida.';
            }
        }
              
        // fecha_inicio
        if(empty($experiencia->fecha_inicio)){
            $errores['fecha_inicio'] =  'El campo fecha de inicio no debe ir vacío.';
        } 

        // fecha_fin
        if(empty($experiencia->fecha_fin)){
            $errores['fecha_fin'] =  'El campo fecha de fin no debe ir vacío.';
        } 
                            
    return $errores;
    }
}