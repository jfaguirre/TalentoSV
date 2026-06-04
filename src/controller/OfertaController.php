<?php
namespace App\controller;

use App\models\Oferta;

class OfertaController{

    // 📊 Mostrar departamentos
    public static function mostrarDepartamentos(){
        return Oferta::getDepartamentos();
    }

    // 👤 Obtener usuario desde sesión
    public static function obtenerUsuario(){
        if(!isset($_SESSION['usuario'])){
            return null;
        }

        return $_SESSION['usuario'];
    }

   public static function obtenerIniciales($usuario){
    return strtoupper(
        substr($usuario['nombre'],0,1) .
        substr($usuario['apellido'],0,1)
    );
}


public static function getOfertasPorDepartamento(int $id_departamento)
{
    return \App\models\Oferta::obtenerPorDepartamento($id_departamento);
}

}

