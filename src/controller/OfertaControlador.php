<?php
namespace App\controller;

use App\models\Oferta;

class OfertaControlador {

    /* ***************************************************************************
        OFERTAS DE EMPLEO
    //*************************************************************************** */
    
    // Obtener cantidad de ofertas por departamento
    public static function obtenerOfertasDepartamento()
    {                   
        return Oferta::obtenerOfertasDepartamento();
        
    }

    // Obtener cantidad de ofertas por distrito
    public static function obtenerOfertasDestritos($id_departamento = null)
    {                                         
        if ($id_departamento === null) {
            $id_departamento = $_GET['id_departamento'] ?? 0;
        }

        if ($id_departamento <= 0) {            
            return null;
        }        

        // Validamos que exista la oferta segun el id recibido
        return Oferta::obtenerOfertasDistritos((int)$id_departamento);
    }


     // Obtener cantidad de ofertas por municipio
    public static function obtenerOfertasMunicipios($id_distrito = null)
    {
        if ($id_distrito === null) {
            $id_distrito = $_GET['id_distrito'] ?? 0;
        }

        if ($id_distrito <= 0) {            
            return null;
        }

        // Validamos que exista la oferta segun el id recibido
        return Oferta::obtenerOfertasMunicipios((int)$id_distrito);
    }


    // Obtener cantidad de ofertas de empleo por municipio a detalle
    public static function obtenerOfertasEmpleo($id_municipio = null)
    {
        if ($id_municipio === null) {
            $id_municipio = $_GET['id_municipio'] ?? 0;
        }

        if ($id_municipio <= 0) {            
            return null;
        }

        // Validamos que exista la oferta segun el id recibido
        return Oferta::obtenerOfertasEmpleo((int)$id_municipio);
    }

    // Obtener detalle de la oferta selecionada oferta 
    public static function obtenerDetalleEmpleo($id_oferta = null)
    {
        if ($id_oferta === null) {
            $id_oferta = $_GET['id_oferta'] ?? 0;
        }

        if ($id_oferta <= 0) {            
            return null;
        }

        // Validamos que exista la oferta segun el id recibido
        $respuesta = Oferta::obtenerDetalleEmpleo((int)$id_oferta);
            
        return $respuesta;
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

}

