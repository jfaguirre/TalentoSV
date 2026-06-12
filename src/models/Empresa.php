<?php
namespace App\models;

use App\models\Conexion;
use PDO;

class Empresa {

    public function __construct(
        public ?int $id_usuario,
        public ?string $nombre_empresa,
        public ?string $correo_empresa,
        public ?string $telefono_empresa
    ){}

    // creacion de la empresa 
    public static function crearEmpresa(Empresa $empresa)
    {
        $sql = Conexion::conexion()->prepare("
            INSERT INTO empresas (id_usuario, nombre_empresa, correo_empresa, telefono_empresa)
            VALUES (:id_usuario, :nombre, :correo, :telefono)
        ");

        $sql->bindParam(":id_usuario", $empresa->id_usuario);
        $sql->bindParam(":nombre", $empresa->nombre_empresa);
        $sql->bindParam(":correo", $empresa->correo_empresa);
        $sql->bindParam(":telefono", $empresa->telefono_empresa);

        return $sql->execute();
    }

    // Obtener la lista de empresas
    public static function obtenerListaEmpresas()
    {
        $sql = Conexion::conexion()->prepare("SELECT * FROM empresas");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // actualizar perfil (compatibilidad básica)
    public static function actualizarPerfil($id_empresa, Empresa $empresa)
    {
        $sql = Conexion::conexion()->prepare("
            UPDATE empresas 
            SET nombre_empresa = :nombre,
                correo_empresa = :correo,
                telefono_empresa = :telefono
            WHERE id_empresa = :id_empresa
        ");

        $sql->bindParam(":nombre", $empresa->nombre_empresa);
        $sql->bindParam(":correo", $empresa->correo_empresa);
        $sql->bindParam(":telefono", $empresa->telefono_empresa);
        $sql->bindParam(":id_empresa", $id_empresa);

        return $sql->execute();
    }

    public static function eliminarEmpresaa($id_empresa)
    {
        $sql = Conexion::conexion()->prepare("
            DELETE FROM empresas WHERE id_empresa = :id_empresa
        ");

        $sql->bindParam(":id_empresa", $id_empresa);
        return $sql->execute();
    }

    // DASHBOARD ---

    // Obtener la empresa por id_usuario
    public static function obtenerPorUsuario(int $id_usuario)
    {
        $sql = Conexion::conexion()->prepare("SELECT * FROM empresas WHERE id_usuario = :id_usuario LIMIT 1");
        $sql->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    // Crear empresa junto con su registro de perfil de empresa básico
    public static function crearEmpresaConPerfil(int $id_usuario, string $nombre, string $correo)
    {
        try {
            $db = Conexion::conexion();
            $db->beginTransaction();

            $sql = $db->prepare("
                INSERT INTO empresas (id_usuario, nombre_empresa, correo_empresa, telefono_empresa, estado)
                VALUES (:id_usuario, :nombre, :correo, '', 'activo')
            ");
            $sql->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sql->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $sql->bindParam(":correo", $correo, PDO::PARAM_STR);
            $sql->execute();

            $id_empresa = $db->lastInsertId();

            $sqlPerfil = $db->prepare("
                INSERT INTO perfil_empresa (id_empresa, descripcion, sector, sitio_web)
                VALUES (:id_empresa, '', '', '')
            ");
            $sqlPerfil->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
            $sqlPerfil->execute();

            $db->commit();
            return $id_empresa;
        } catch (\Throwable $th) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            return false;
        }
    }

    // Obtener perfil detallado de la empresa
    public static function obtenerPerfil(int $id_empresa)
    {
        $sql = Conexion::conexion()->prepare("
            SELECT e.*, p.descripcion, p.sector, p.id_departamento, p.id_distrito, p.id_municipio, p.sitio_web 
            FROM empresas e
            LEFT JOIN perfil_empresa p ON e.id_empresa = p.id_empresa
            WHERE e.id_empresa = :id_empresa 
            LIMIT 1
        ");
        $sql->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar datos de empresa y perfil
    public static function actualizarPerfilEmpresa(int $id_empresa, string $nombre, string $correo, string $telefono, string $sector, ?int $id_departamento, ?int $id_distrito, ?int $id_municipio, string $sitio_web, string $descripcion)
    {
        try {
            $db = Conexion::conexion();
            $db->beginTransaction();

            $sqlEmpresa = $db->prepare("
                UPDATE empresas 
                SET nombre_empresa = :nombre,
                    correo_empresa = :correo,
                    telefono_empresa = :telefono
                WHERE id_empresa = :id_empresa
            ");
            $sqlEmpresa->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $sqlEmpresa->bindParam(":correo", $correo, PDO::PARAM_STR);
            $sqlEmpresa->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $sqlEmpresa->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
            $sqlEmpresa->execute();

            $sqlCheck = $db->prepare("SELECT id_perfil_empresa FROM perfil_empresa WHERE id_empresa = :id_empresa LIMIT 1");
            $sqlCheck->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
            $sqlCheck->execute();
            $perfilExists = $sqlCheck->fetch();

            if ($perfilExists) {
                $sqlPerfil = $db->prepare("
                    UPDATE perfil_empresa 
                    SET sector = :sector,
                        id_departamento = :id_departamento,
                        id_distrito = :id_distrito,
                        id_municipio = :id_municipio,
                        sitio_web = :sitio_web,
                        descripcion = :descripcion
                    WHERE id_empresa = :id_empresa
                ");
            } else {
                $sqlPerfil = $db->prepare("
                    INSERT INTO perfil_empresa (id_empresa, sector, id_departamento, id_distrito, id_municipio, sitio_web, descripcion)
                    VALUES (:id_empresa, :sector, :id_departamento, :id_distrito, :id_municipio, :sitio_web, :descripcion)
                ");
            }
            $sqlPerfil->bindParam(":sector", $sector, PDO::PARAM_STR);
            $sqlPerfil->bindValue(":id_departamento", $id_departamento, $id_departamento === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
            $sqlPerfil->bindValue(":id_distrito", $id_distrito, $id_distrito === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
            $sqlPerfil->bindValue(":id_municipio", $id_municipio, $id_municipio === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
            $sqlPerfil->bindParam(":sitio_web", $sitio_web, PDO::PARAM_STR);
            $sqlPerfil->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $sqlPerfil->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
            $sqlPerfil->execute();

            $db->commit();
            return true;
        } catch (\Throwable $th) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            return false;
        }
    }

    // Obtener postulaciones recibidas
    public static function obtenerPostulaciones(int $id_empresa)
    {
        $sql = Conexion::conexion()->prepare("
            SELECT p.*, u.nombre, u.apellido, u.correo, o.titulo 
            FROM postulaciones p
            JOIN usuarios u ON p.id_usuario = u.id_usuario
            JOIN oferta_empleos o ON p.id_oferta = o.id_oferta
            WHERE o.id_empresa = :id_empresa
            ORDER BY p.fecha_postulacion DESC
        ");
        $sql->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Actualizar estado de una postulación
    public static function actualizarEstadoPostulacion(int $id_postulacion, string $estado)
    {

        // Si el estado es RECHAZADA entonces tambien eliminamos la entrevista

        if($estado == 'rechazada')
        {
            $consulta = Conexion::conexion()->prepare("
                DELETE FROM entrevistas
                WHERE id_postulacion = :id_postulacion
            ");

            $consulta->bindParam(":id_postulacion", $id_postulacion, PDO::PARAM_INT);
            $consulta->execute();
                
        }

        // Ahora cambiamos el estado.
        $sql = Conexion::conexion()->prepare("
            UPDATE postulaciones 
            SET estado = :estado 
            WHERE id_postulacion = :id_postulacion
        ");
        $sql->bindParam(":estado", $estado, PDO::PARAM_STR);
        $sql->bindParam(":id_postulacion", $id_postulacion, PDO::PARAM_INT);
        return $sql->execute();
    }

    // Programar entrevista
    public static function programarEntrevista(int $id_empresa, int $id_postulacion, string $fecha_hora, string $tipo)
    {    
        $sql = Conexion::conexion()->prepare("
            INSERT INTO entrevistas (id_empresa, id_postulacion, fecha_hora, tipo, estado)
            VALUES (:id_empresa, :id_postulacion, :fecha_hora, :tipo, 'programada')
        ");
        $sql->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $sql->bindParam(":id_postulacion", $id_postulacion, PDO::PARAM_INT);
        $sql->bindParam(":fecha_hora", $fecha_hora);
        $sql->bindParam(":tipo", $tipo);
        return $sql->execute();
    }

    // Obtener entrevistas programadas
    public static function obtenerEntrevistas(int $id_empresa)
    {
        $sql = Conexion::conexion()->prepare("
            SELECT ent.*, u.nombre, u.apellido, o.titulo 
            FROM entrevistas ent
            JOIN postulaciones p ON ent.id_postulacion = p.id_postulacion
            JOIN usuarios u ON p.id_usuario = u.id_usuario
            JOIN oferta_empleos o ON p.id_oferta = o.id_oferta
            WHERE ent.id_empresa = :id_empresa
            ORDER BY ent.fecha_hora ASC
        ");
        $sql->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
