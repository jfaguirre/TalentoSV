<?php
namespace App\models;

use PDO;
use App\helpers\Alert;

class Experiencia
{
    public function __construct(        
        public ?int $id_usuario,
        public string $empresa,
        public string $puesto,
        public string $descripcion,
        public ?string $fecha_inicio,
        public ?string $fecha_fin,
    ) {        
        $this->id_usuario = $id_usuario;
        $this->empresa = $empresa;
        $this->puesto = $puesto;
        $this->descripcion = $descripcion;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    // CRUD Experiencia controlador

    // Crear experiencia
    public function crearExperiencia(Experiencia $experiencia)
    {
        try {   
            $conexion = Conexion::conexion();
            $id_perfil = Usuario::obtenerIdPerfil($experiencia->id_usuario);
            if (!$id_perfil) {
                return false;
            }
            $conexion->beginTransaction();

            $consultaSQL = $conexion->prepare("
                INSERT INTO experiencia(id_perfil, empresa, puesto, descripcion, fecha_inicio, fecha_fin)        
                VALUES(:id_perfil, :empresa, :puesto, :descripcion, :fecha_inicio, :fecha_fin)
            ");

            $consultaSQL->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);
            $consultaSQL->bindParam(":empresa", $experiencia->empresa, PDO::PARAM_STR);
            $consultaSQL->bindParam(":puesto", $experiencia->puesto, PDO::PARAM_STR);
            $consultaSQL->bindParam(":descripcion", $experiencia->descripcion, PDO::PARAM_STR);
            $consultaSQL->bindParam(":fecha_inicio", $experiencia->fecha_inicio, PDO::PARAM_STR);
            
            if ($experiencia->fecha_fin === '' || $experiencia->fecha_fin === null) {
                $consultaSQL->bindValue(":fecha_fin", null, PDO::PARAM_NULL);
            } else {
                $consultaSQL->bindParam(":fecha_fin", $experiencia->fecha_fin, PDO::PARAM_STR);
            }
            
            $consultaSQL->execute();  
            
            $conexion->commit();
            return true;      
        } catch (\Throwable $th) {
            Conexion::conexion()->rollBack();            
            Alert::success('Ups!', 'Al parecer hubo un error. Intenta de nuevo.');            
            return 'Error: '.$th->getMessage();
        }            
    }

    // Mostrar experiencia
    public static function mostrarExperiencias(?int $id_usuario = null)
    {
        if ($id_usuario === null) {
            return [];
        }
        $id_perfil = Usuario::obtenerIdPerfil($id_usuario);
        if (!$id_perfil) {
            return [];
        }
        $sql = "SELECT * FROM experiencia WHERE id_perfil = :id_perfil";
        
        $consultaSQL = Conexion::conexion()->prepare($sql);
        $consultaSQL->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);

        if ($consultaSQL->execute()) {
            return $consultaSQL->fetchAll(PDO::FETCH_ASSOC);
        }                
        return [];
    }
        
    // Eliminar experiencia
    public static function eliminarExperiencia(int $id_experiencia)
    {
        $consultaSQL = Conexion::conexion()
            ->prepare("DELETE FROM experiencia WHERE id_experiencia = :id_experiencia");
            
        $consultaSQL->bindParam(":id_experiencia", $id_experiencia, PDO::PARAM_INT);
        
        if ($consultaSQL->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar experiencia
    public static function actualizarExperiencia(Experiencia $experiencia, int $id_experiencia)
    {
        $consultaSQL = Conexion::conexion()->prepare("
            UPDATE experiencia
            SET
                empresa = :empresa,
                puesto = :puesto,
                descripcion = :descripcion,
                fecha_inicio = :fecha_inicio,
                fecha_fin = :fecha_fin
            WHERE id_experiencia = :id_experiencia
        ");

        $consultaSQL->bindParam(":id_experiencia", $id_experiencia, PDO::PARAM_INT);
        $consultaSQL->bindParam(":empresa", $experiencia->empresa, PDO::PARAM_STR);
        $consultaSQL->bindParam(":puesto", $experiencia->puesto, PDO::PARAM_STR);
        $consultaSQL->bindParam(":descripcion", $experiencia->descripcion, PDO::PARAM_STR);
        $consultaSQL->bindParam(":fecha_inicio", $experiencia->fecha_inicio, PDO::PARAM_STR);
        
        if ($experiencia->fecha_fin === '' || $experiencia->fecha_fin === null) {
            $consultaSQL->bindValue(":fecha_fin", null, PDO::PARAM_NULL);
        } else {
            $consultaSQL->bindParam(":fecha_fin", $experiencia->fecha_fin, PDO::PARAM_STR);
        }
        
        if ($consultaSQL->execute()) {
            return true;
        }
        return false;
    }    
}