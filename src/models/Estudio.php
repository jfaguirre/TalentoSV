<?php
namespace App\models;

use PDO;
use App\helpers\Alert;

class Estudio
{    
    public function __construct(
        public ?int $id_usuario,
        public ?int $id_nivel_academico,        
        public ?string $titulo,
        public ?string $institucion,
        public ?string $fecha_logro,
        public ?string $estado,
        public ?string $descripcion,
        public ?int $id_estudio = null
    ) {
        $this->id_usuario = $id_usuario;
        $this->id_nivel_academico = $id_nivel_academico;
        $this->titulo = $titulo;
        $this->institucion = $institucion;
        $this->fecha_logro = $fecha_logro;
        $this->estado = $estado;
        $this->descripcion = $descripcion;
        $this->id_estudio = $id_estudio;
    }

    // CRUD Estudio controlador

    // Crear estudio
    public function crearEstudio(Estudio $estudio)
    {
        try {   
            $conexion = Conexion::conexion();
            $conexion->beginTransaction();

            $consultaSQL = $conexion->prepare("
                INSERT INTO estudios(id_usuario, id_nivel_academico, titulo, institucion, fecha_logro, estado, descripcion)        
                VALUES(:id_usuario, :id_nivel_academico, :titulo, :institucion, :fecha_logro, :estado, :descripcion)
            ");

            $consultaSQL->bindParam(":id_usuario", $estudio->id_usuario, PDO::PARAM_INT);
            if ($estudio->id_nivel_academico === null) {
                $consultaSQL->bindValue(":id_nivel_academico", null, PDO::PARAM_NULL);
            } else {
                $consultaSQL->bindParam(":id_nivel_academico", $estudio->id_nivel_academico, PDO::PARAM_INT);
            }
            $consultaSQL->bindParam(":titulo", $estudio->titulo, PDO::PARAM_STR);
            $consultaSQL->bindParam(":institucion", $estudio->institucion, PDO::PARAM_STR);
            $consultaSQL->bindParam(":fecha_logro", $estudio->fecha_logro, PDO::PARAM_STR);
            $consultaSQL->bindParam(":estado", $estudio->estado, PDO::PARAM_STR);
            $consultaSQL->bindParam(":descripcion", $estudio->descripcion, PDO::PARAM_STR);
            $consultaSQL->execute();  
            
            $conexion->commit();
            return true;      
            
        } catch (\Throwable $th) {
            Conexion::conexion()->rollBack();            
            Alert::success('Ups!', 'Al parecer hubo un error. Intenta de nuevo.');            
            return 'Error: '.$th->getMessage();
        }            
    }

    // Mostrar estudios
    public static function mostrarEstudios(?int $id_usuario = null)
    {
        $sql = "SELECT * FROM estudios";
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
        
    // Eliminar estudio
    public static function eliminarEstudio(int $id_estudio)
    {
        $consultaSQL = Conexion::conexion()
            ->prepare("DELETE FROM estudios WHERE id_estudio = :id_estudio");
            
        $consultaSQL->bindParam(":id_estudio", $id_estudio, PDO::PARAM_INT);
        
        if ($consultaSQL->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar estudio
    public static function actualizarEstudio(Estudio $estudio, int $id_estudio)
    {
        $consultaSQL = Conexion::conexion()->prepare("
            UPDATE estudios
            SET
                id_usuario = :id_usuario,
                id_nivel_academico = :id_nivel_academico,
                titulo = :titulo,
                institucion = :institucion,
                fecha_logro = :fecha_logro,
                estado = :estado,
                descripcion = :descripcion
            WHERE id_estudio = :id_estudio
        ");

        $consultaSQL->bindParam(":id_estudio", $id_estudio, PDO::PARAM_INT);
        $consultaSQL->bindParam(":id_usuario", $estudio->id_usuario, PDO::PARAM_INT);
        if ($estudio->id_nivel_academico === null) {
            $consultaSQL->bindValue(":id_nivel_academico", null, PDO::PARAM_NULL);
        } else {
            $consultaSQL->bindParam(":id_nivel_academico", $estudio->id_nivel_academico, PDO::PARAM_INT);
        }
        $consultaSQL->bindParam(":titulo", $estudio->titulo, PDO::PARAM_STR);
        $consultaSQL->bindParam(":institucion", $estudio->institucion, PDO::PARAM_STR);
        $consultaSQL->bindParam(":fecha_logro", $estudio->fecha_logro, PDO::PARAM_STR);
        $consultaSQL->bindParam(":estado", $estudio->estado, PDO::PARAM_STR);
        $consultaSQL->bindParam(":descripcion", $estudio->descripcion, PDO::PARAM_STR);
        
        if ($consultaSQL->execute()) {
            return true;
        }
        return false;
    }    
}