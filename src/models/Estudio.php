<?php
namespace App\models;

use PDO;
use App\helpers\Alert;

class Estudio
{    
    public function __construct(
        public ?int $id_usuario,
        public ?string $nivel_academico,        
        public ?string $titulo,
        public ?string $institucion,
        public ?string $fecha_logro,
        public ?string $estado,
        public ?string $descripcion,
        public ?int $id_estudio = null
    ) {
        $this->id_usuario = $id_usuario;
        $this->nivel_academico = $nivel_academico;
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
            $id_perfil = Usuario::obtenerIdPerfil($estudio->id_usuario);
            if (!$id_perfil) {
                return false;
            }
            $conexion->beginTransaction();

            $consultaSQL = $conexion->prepare("
                INSERT INTO estudios(id_perfil, nivel_academico, titulo, institucion, fecha_logro, estado, descripcion)        
                VALUES(:id_perfil, :nivel_academico, :titulo, :institucion, :fecha_logro, :estado, :descripcion)
            ");

            $consultaSQL->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);
            $consultaSQL->bindParam(":nivel_academico", $estudio->nivel_academico, PDO::PARAM_STR);
            $consultaSQL->bindParam(":titulo", $estudio->titulo, PDO::PARAM_STR);
            $consultaSQL->bindParam(":institucion", $estudio->institucion, PDO::PARAM_STR);
            
            if ($estudio->fecha_logro === '' || $estudio->fecha_logro === null) {
                $consultaSQL->bindValue(":fecha_logro", null, PDO::PARAM_NULL);
            } else {
                $consultaSQL->bindParam(":fecha_logro", $estudio->fecha_logro, PDO::PARAM_STR);
            }
            
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
        if ($id_usuario === null) {
            return [];
        }
        $id_perfil = Usuario::obtenerIdPerfil($id_usuario);
        if (!$id_perfil) {
            return [];
        }
        $sql = "SELECT * FROM estudios WHERE id_perfil = :id_perfil";
        
        $consultaSQL = Conexion::conexion()->prepare($sql);
        $consultaSQL->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);

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
                nivel_academico = :nivel_academico,
                titulo = :titulo,
                institucion = :institucion,
                fecha_logro = :fecha_logro,
                estado = :estado,
                descripcion = :descripcion
            WHERE id_estudio = :id_estudio
        ");

        $consultaSQL->bindParam(":id_estudio", $id_estudio, PDO::PARAM_INT);
        $consultaSQL->bindParam(":nivel_academico", $estudio->nivel_academico, PDO::PARAM_STR);
        $consultaSQL->bindParam(":titulo", $estudio->titulo, PDO::PARAM_STR);
        $consultaSQL->bindParam(":institucion", $estudio->institucion, PDO::PARAM_STR);
        
        if ($estudio->fecha_logro === '' || $estudio->fecha_logro === null) {
            $consultaSQL->bindValue(":fecha_logro", null, PDO::PARAM_NULL);
        } else {
            $consultaSQL->bindParam(":fecha_logro", $estudio->fecha_logro, PDO::PARAM_STR);
        }
        
        $consultaSQL->bindParam(":estado", $estudio->estado, PDO::PARAM_STR);
        $consultaSQL->bindParam(":descripcion", $estudio->descripcion, PDO::PARAM_STR);
        
        if ($consultaSQL->execute()) {
            return true;
        }
        return false;
    }    
}