<?php
namespace App\models;

use PDO;
use App\helpers\Alert;

class Habilidad
{
    public function __construct(
        public ?int $id_usuario,
        public string $habilidad,
        public ?int $id_habilidad = null
    ) {
        $this->id_usuario = $id_usuario;
        $this->habilidad = $habilidad;
        $this->id_habilidad = $id_habilidad;
    }

    // CRUD Habilidades controlador
    
    // Crear habilidad
    public function crearHabilidad(Habilidad $habilidad)
    {
        try {   
            $conexion = Conexion::conexion();
            $conexion->beginTransaction();

            $consultaSQL = $conexion->prepare("
                INSERT INTO habilidades(id_usuario, habilidad)        
                VALUES(:id_usuario, :habilidad)
            ");

            $consultaSQL->bindParam(":id_usuario", $habilidad->id_usuario, PDO::PARAM_INT);
            $consultaSQL->bindParam(":habilidad", $habilidad->habilidad, PDO::PARAM_STR);
            $consultaSQL->execute();  
            
            $conexion->commit();
            return true;      
        } catch (\Throwable $th) {
            Conexion::conexion()->rollBack();            
            Alert::success('Ups!', 'Al parecer hubo un error. Intenta de nuevo.');            
            return 'Error: '.$th->getMessage();
        }            
    }

    // Mostrar habilidades
    public static function mostrarHabilidades(?int $id_usuario = null)
    {
        $sql = "SELECT * FROM habilidades";
        if ($id_usuario !== null) {
            $sql .= " WHERE id_usuario = :id_usuario";
        }
        
        $consultaSQL = Conexion::conexion()->prepare($sql);
        if ($id_usuario !== null) {
            $consultaSQL->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        }

        if ($consultaSQL->execute()) {
            return $consultaSQL->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    // Eliminar habilidad
    public static function eliminarHabilidad(int $id_habilidad)
    {
        $consultaSQL = Conexion::conexion()
            ->prepare("DELETE FROM habilidades WHERE id_habilidad = :id_habilidad");
            
        $consultaSQL->bindParam(":id_habilidad", $id_habilidad, PDO::PARAM_INT);
        
        if ($consultaSQL->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar habilidad
    public static function actualizarHabilidad(Habilidad $habilidad, int $id_habilidad)
    {
        $consultaSQL = Conexion::conexion()->prepare("
            UPDATE habilidades
            SET
                id_usuario = :id_usuario,
                habilidad = :habilidad
            WHERE id_habilidad = :id_habilidad
        ");

        $consultaSQL->bindParam(":id_habilidad", $id_habilidad, PDO::PARAM_INT);
        $consultaSQL->bindParam(":id_usuario", $habilidad->id_usuario, PDO::PARAM_INT);
        $consultaSQL->bindParam(":habilidad", $habilidad->habilidad, PDO::PARAM_STR);
        
        if ($consultaSQL->execute()) {
            return true;
        }
        return false;
    }    
}
