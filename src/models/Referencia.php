<?php
namespace App\models;

use PDO;
use App\helpers\Alert;

class Referencia
{
    public function __construct(
        public ?int $id_usuario,
        public string $nombre_referencia,        
        public ?string $telefono_contacto = null,
        public ?string $correo_contacto = null,
        public ?int $id_referencias = null
    ) {
        $this->id_usuario = $id_usuario;
        $this->nombre_referencia = $nombre_referencia;        
        $this->telefono_contacto = $telefono_contacto;
        $this->correo_contacto = $correo_contacto;
        $this->id_referencias = $id_referencias;
    }

    // CRUD referencias controlador

    // Crear referencia
    public function crearReferencia(Referencia $referencia)
    {
        try {   
            $conexion = Conexion::conexion();
            $conexion->beginTransaction();

            $consultaSQL = $conexion->prepare("
                INSERT INTO referencias(id_usuario, nombre_referencia, telefono_contacto, correo_contacto)        
                VALUES(:id_usuario, :nombre_referencia, :telefono_contacto, :correo_contacto)
            ");

            $consultaSQL->bindParam(":id_usuario", $referencia->id_usuario, PDO::PARAM_INT);
            $consultaSQL->bindParam(":nombre_referencia", $referencia->nombre_referencia, PDO::PARAM_STR);
            $consultaSQL->bindParam(":telefono_contacto", $referencia->telefono_contacto, PDO::PARAM_STR);
            $consultaSQL->bindParam(":correo_contacto", $referencia->correo_contacto, PDO::PARAM_STR);
            $consultaSQL->execute();  
            
            $conexion->commit();
            return true;      
        } catch (\Throwable $th) {
            Conexion::conexion()->rollBack();            
            Alert::success('Ups!', 'Al parecer hubo un error. Intenta de nuevo.');            
            return 'Error: '.$th->getMessage();
        }            
    }

    // Mostrar referencias
    public static function mostrarReferencias(?int $id_usuario = null)
    {
        $sql = "SELECT * FROM referencias";
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
        
    // Eliminar referencia
    public static function eliminarReferencia(int $id_referencia)
    {
        $consultaSQL = Conexion::conexion()
            ->prepare("DELETE FROM referencias WHERE id_referencias = :id_referencia");
            
        $consultaSQL->bindParam(":id_referencia", $id_referencia, PDO::PARAM_INT);
        
        if ($consultaSQL->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar referencia
    public static function actualizarReferencia(Referencia $referencia, int $id_referencia)
    {
        $consultaSQL = Conexion::conexion()->prepare("
            UPDATE referencias
            SET
                id_usuario = :id_usuario,
                nombre_referencia = :nombre_referencia,
                telefono_contacto = :telefono_contacto,
                correo_contacto = :correo_contacto
            WHERE id_referencias = :id_referencia
        ");

        $consultaSQL->bindParam(":id_referencia", $id_referencia, PDO::PARAM_INT);
        $consultaSQL->bindParam(":id_usuario", $referencia->id_usuario, PDO::PARAM_INT);
        $consultaSQL->bindParam(":nombre_referencia", $referencia->nombre_referencia, PDO::PARAM_STR);
        $consultaSQL->bindParam(":telefono_contacto", $referencia->telefono_contacto, PDO::PARAM_STR);
        $consultaSQL->bindParam(":correo_contacto", $referencia->correo_contacto, PDO::PARAM_STR);
        
        if ($consultaSQL->execute()) {
            return true;
        }
        return false;
    }    
}