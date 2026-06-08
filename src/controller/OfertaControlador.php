<?php
namespace App\controller;

use App\models\Oferta;

class OfertaControlador {

    // Mostrar departamentos
    public static function obtenerOfertasDepartamento()
    {                   
        return Oferta::obtenerOfertasDepartamento();
    }


    // Obtener ofertas por distrito
    public static function obtenerOfertasDestritos(int $id_departamento)
    {
        return Oferta::obtenerOfertasDistritos($id_departamento);
    }

     // Obtener ofertas por municipio
    public static function obtenerOfertasMunicipios(int $id_distrito)
    {
        return Oferta::obtenerOfertasMunicipios($id_distrito);
    }


    // Obtener usuario desde sesión
    public static function obtenerUsuario()
    {
        if(!isset($_SESSION['usuario'])){
            return null;
        }

        return $_SESSION['usuario'];
    }

    // Obtener iniciales del usuario
   public static function obtenerIniciales($usuario)
   {
        return strtoupper(
            substr($usuario['nombre'],0,1) .
            substr($usuario['apellido'],0,1)
        );
    }

    // Obtener ofertas por departamento
    // public static function getOfertasPorDepartamento(int $id_departamento)
    // {
    //     return \App\models\Oferta::obtenerPorDepartamento($id_departamento);
    // }

}

