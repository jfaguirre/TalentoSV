<?php
namespace App\Request;

use App\models\Experiencia;

class ExperienciaRequest {

    static public function validacion(Experiencia $experiencia)
    {            
        $errores = [];          

        $empresaPattern = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s,\.\-\(\)\#\&]{3,150}$/";
        $puestoPattern = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s,\.\-\(\)\#]{3,150}$/";        
        
        // empresa
        if(empty($experiencia->empresa)){
            $errores['empresa'] =  'El campo nombre de la empresa no debe ir vacío.';
        } else {
            if(!preg_match($empresaPattern, $experiencia->empresa)){
                $errores['empresa'] =  'La empresa debe tener entre 3 y 150 caracteres válidos.';
            }
        }
               
        // puesto
        if(empty($experiencia->puesto)){
            $errores['puesto'] =  'El campo puesto no debe ir vacío.';
        } else {
            if(!preg_match($puestoPattern, $experiencia->puesto)){
                $errores['puesto'] =  'El puesto debe tener entre 3 y 150 caracteres válidos.';
            }
        }
                   
        // descripcion
        if(empty($experiencia->descripcion)){
            $errores['descripcion'] =  'El campo descripción no debe ir vacío.';
        } elseif (strlen($experiencia->descripcion) < 3) {
            $errores['descripcion'] =  'Por favor, ingrese una descripción válida (mínimo 3 caracteres).';
        }
               
        // fecha_inicio
        if(empty($experiencia->fecha_inicio)){
            $errores['fecha_inicio'] =  'El campo fecha de inicio no debe ir vacío.';
        } 

        // fecha_fin es opcional (para trabajos actuales)
                            
        return $errores;
    }
}