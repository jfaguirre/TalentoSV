<?php
namespace App\models;

use App\models\Conexion;
use App\helpers\Alert;
use PDO;

class Usuario {

    public function __construct(        
        public ?string $nombre, 
        public ?string $apellido,
        public ?string $correo,
        public ?string $password        
    ) {}

    // ============================================================
    // CREAR USUARIO
    // ============================================================
    public static function crearUsuario(Usuario $usuario)
    {                
        try {         
            $db = Conexion::conexion();
            $db->beginTransaction();
            
            $sql = $db->prepare("
                INSERT INTO usuarios(nombre, apellido, correo, password, id_rol)        
                VALUES(:nombre, :apellido, :correo, :password, 2)
            ");

            $sql->bindParam(":nombre", $usuario->nombre);
            $sql->bindParam(":apellido", $usuario->apellido);
            $sql->bindParam(":correo", $usuario->correo);
            $sql->bindParam(":password", $usuario->password);
            $sql->execute();
                        
            $db->commit();
            return true;
            
        } catch (\Throwable $th) {
            $db->rollBack();            
            return 'Error: '.$th->getMessage();
        }
    }

    // ============================================================
    // LOGIN
    // ============================================================
    public static function autenticar(Usuario $usuario)
    {
        try {
            $sql = Conexion::conexion()->prepare("
                SELECT * FROM usuarios WHERE correo = :correo
            ");
            $sql->bindParam(":correo", $usuario->correo);

            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);

        } catch (\Throwable $th) {                      
            return false;
        }
    }

    // ============================================================
    // ACTUALIZAR TABLA usuarios
    // ============================================================
    public static function actualizarUsuario(int $id_usuario, Usuario $usuario)
    {
        try {
            $sql = Conexion::conexion()->prepare("
                UPDATE usuarios 
                SET nombre = :nombre,
                    apellido = :apellido,
                    correo = :correo,
                    password = :password
                WHERE id_usuario = :id_usuario
            ");

            $sql->bindParam(":nombre", $usuario->nombre);
            $sql->bindParam(":apellido", $usuario->apellido);
            $sql->bindParam(":correo", $usuario->correo);
            $sql->bindParam(":password", $usuario->password);
            $sql->bindParam(":id_usuario", $id_usuario);

            return $sql->execute();

        } catch (\Throwable $th) {
            return false;
        }
    }

    // ============================================================
    // CREAR PERFIL (si no existe)
    // ============================================================
    public static function crearPerfil(array $data)
    {
        try {
            $sql = Conexion::conexion()->prepare("
                INSERT INTO perfil_usuario
                (id_usuario, id_departamento, id_distrito, id_municipio, id_profesion, nacionalidad, telefono, foto, genero)
                VALUES
                (:id_usuario, :id_departamento, :id_distrito, :id_municipio, :id_profesion, :nacionalidad, :telefono, :foto, :genero)
            ");

            return $sql->execute($data);

        } catch (\Throwable $th) {
            return false;
        }
    }

    // ============================================================
    // OBTENER PERFIL DETALLADO
    // ============================================================
    public static function obtenerPerfilDetallado(int $id_usuario)
    {
        try {
            $db = Conexion::conexion();
            $sql = $db->prepare("
                SELECT 
                    u.nombre, u.apellido, u.correo, 
                    p.nacionalidad, p.telefono, p.foto, p.genero,
                    d.departamento, dist.distrito, m.municipio, 
                    prof.profesion,
                    p.id_departamento, p.id_distrito, p.id_municipio, p.id_profesion
                FROM usuarios u
                LEFT JOIN perfil_usuario p ON u.id_usuario = p.id_usuario
                LEFT JOIN departamentos d ON p.id_departamento = d.id_departamento
                LEFT JOIN distritos dist ON p.id_distrito = dist.id_distrito
                LEFT JOIN municipios m ON p.id_municipio = m.id_municipio
                LEFT JOIN profesion prof ON p.id_profesion = prof.id_profesion
                WHERE u.id_usuario = :id_usuario
                LIMIT 1
            ");

            $sql->bindParam(":id_usuario", $id_usuario);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);

        } catch (\Throwable $th) {
            return false;
        }
    }

}
