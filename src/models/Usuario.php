<?php
namespace App\models;

use App\models\Conexion;
use App\helpers\Alert;


use PDO;

class Usuario {

    public function 
    __construct(        
        public ?string $nombre, 
        public ?string $apellido,
        public ?string $correo,
        public ?string $password        
    )
    {        
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;        
        $this->password = $password;                       
    }


    // Metodo para crear un nuevo usuario
public static function crearUsuario(Usuario $usuario)
{
    $conexion = null;

    try {

        $conexion = Conexion::conexion();
        $conexion->beginTransaction();

        // Crear usuario
        $consultaSQL = $conexion->prepare("
            INSERT INTO usuarios(
                nombre,
                apellido,
                correo,
                password,
                id_rol
            )
            VALUES(
                :nombre,
                :apellido,
                :correo,
                :password,
                :id_rol
            )
        ");

        $consultaSQL->bindParam(":nombre", $usuario->nombre, PDO::PARAM_STR);
        $consultaSQL->bindParam(":apellido", $usuario->apellido, PDO::PARAM_STR);
        $consultaSQL->bindParam(":correo", $usuario->correo, PDO::PARAM_STR);
        $consultaSQL->bindParam(":password", $usuario->password, PDO::PARAM_STR);
        $consultaSQL->bindValue(":id_rol", 2, PDO::PARAM_INT);

        $consultaSQL->execute();

        // Obtener el ID del usuario recién creado
        $idUsuario = $conexion->lastInsertId();

        // Crear automáticamente el perfil del usuario
        $consultaPerfil = $conexion->prepare("
            INSERT INTO perfil_usuario(id_usuario)
            VALUES(:id_usuario)
        ");

        $consultaPerfil->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);
        $consultaPerfil->execute();

        $conexion->commit();

        return true;

    } catch (\Throwable $th) {

        if ($conexion && $conexion->inTransaction()) {
            $conexion->rollBack();
        }

        Alert::success(
            'Ups!',
            'Al parecer hubo un error. Intenta de nuevo.'
        );

        return 'Error: ' . $th->getMessage();
    }
}


    // Metodo para iniciar sesion de usuario
    static public function autenticar(Usuario $usuario){

        try {
        
            // Valida si el correo existe en la base de datos
            $consultaSQL = Conexion::conexion()
            ->prepare("SELECT * FROM usuarios WHERE correo = :correo");
            $consultaSQL->bindParam(":correo", $usuario->correo, PDO::PARAM_STR);

            if($consultaSQL->execute()){                
                return $consultaSQL->fetch();
            } else {                
                
                return 'false';
            }

        } catch (\Throwable $th) {                      
            return 'Error: '.$th->getMessage();
        }
    }

    // altualizar informaciondel usuario
    public static function actualizarUsuario(int $id_usuario, Usuario $usuario)
    {
        try {
            $consultaSQL = Conexion::conexion()
            ->prepare("UPDATE usuarios 
                SET nombre = :nombre,
                    apellido = :apellido,
                    correo = :correo,
                    password = :password
                WHERE id_usuario = :id_usuario");

            $consultaSQL->bindParam(":nombre", $usuario->nombre, PDO::PARAM_STR);
            $consultaSQL->bindParam(":apellido", $usuario->apellido, PDO::PARAM_STR);
            $consultaSQL->bindParam(":correo", $usuario->correo, PDO::PARAM_STR);
            $consultaSQL->bindParam(":password", $usuario->password, PDO::PARAM_STR);
            $consultaSQL->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

            return $consultaSQL->execute();

        } catch (\Throwable $th) {
            return 'Error: '.$th->getMessage();
        }
    }


    // para eiminar usuario
    public static function eliminarUsuario(int $id_usuario)
    {
        try {
            $consultaSQL = Conexion::conexion()
            ->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");

            $consultaSQL->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

            return $consultaSQL->execute();

        } catch (\Throwable $th) {
            return 'Error: '.$th->getMessage();
        }
    }

    // este esta penado para que se inserte en la tabla perfil_usuarios, son los que vienen la vista del formulario CV
    public static function crearPerfil(array $data)
    {
        try {
            $consultaSQL = Conexion::conexion()->prepare("
                INSERT INTO perfil_usuarios
                (id_usuario, id_departamento, id_zona_id_municipios, id_profesion, id_experiencia, id_habilidades, nacionalidad, telefono, foto, genero)
                VALUES
                (:id_usuario, :id_departamento, :id_municipio, :id_profesion, :id_experiencia, :id_habilidad, :nacionalidad, :telefono, :foto, :genero)
            ");

            return $consultaSQL->execute($data);


        } catch (\Throwable $th) {
            return 'Error: '.$th->getMessage();
        }
    }
    
    // Para determinar que role tiene el usuario
    static public function checkRole(array $respuesta)
    {        
        try {
            $consultaSQL = Conexion::conexion()->prepare(
                "SELECT 
                    u.nombre, 
                    r.rol 
                FROM usuarios u
                JOIN roles r ON u.id_rol = r.id_rol
                WHERE u.id_usuario = :id_usuario"
            );

            $consultaSQL->bindParam(":id_usuario", $respuesta['id_usuario'], PDO::PARAM_INT);     
                        
            if($consultaSQL->execute()){                        
                return $consultaSQL->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (\Throwable $th) {            
            return 'Error: '.$th->getMessage();
        }
    }

    public static function mostrarUsuarios()
    {

    $consultaSQL = Conexion::conexion()
            ->prepare("SELECT * FROM usuarios");
            $consultaSQL->execute();
            return $consultaSQL->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener id_perfil a partir de id_usuario
    public static function obtenerIdPerfil(int $id_usuario): ?int
    {
        try {
            $db = Conexion::conexion();
            $sql = $db->prepare("SELECT id_perfil FROM perfil_usuario WHERE id_usuario = :id_usuario LIMIT 1");
            $sql->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sql->execute();
            $res = $sql->fetch(PDO::FETCH_ASSOC);
            return $res ? (int)$res['id_perfil'] : null;
        } catch (\Throwable $th) {
            return null;
        }
    }

    // Actualizar perfil completo transaccionalmente
    public static function actualizarPerfilCompleto(int $id_usuario, array $data)
    {
        $conexion = null;
        try {
            $conexion = Conexion::conexion();
            $conexion->beginTransaction();

            // 1. Actualizar tabla usuarios
            if (!empty($data['password'])) {
                $sqlUser = $conexion->prepare("
                    UPDATE usuarios
                    SET nombre = :nombre, apellido = :apellido, correo = :correo, password = :password
                    WHERE id_usuario = :id_usuario
                ");
                $sqlUser->bindParam(":password", $data['password'], PDO::PARAM_STR);
            } else {
                $sqlUser = $conexion->prepare("
                    UPDATE usuarios
                    SET nombre = :nombre, apellido = :apellido, correo = :correo
                    WHERE id_usuario = :id_usuario
                ");
            }
            $sqlUser->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
            $sqlUser->bindParam(":apellido", $data['apellido'], PDO::PARAM_STR);
            $sqlUser->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $sqlUser->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sqlUser->execute();

            // 2. Obtener o crear id_perfil
            $id_perfil = self::obtenerIdPerfil($id_usuario);
            if (!$id_perfil) {
                $sqlCreatePerfil = $conexion->prepare("INSERT INTO perfil_usuario(id_usuario) VALUES(:id_usuario)");
                $sqlCreatePerfil->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
                $sqlCreatePerfil->execute();
                $id_perfil = $conexion->lastInsertId();
            }

            // 3. Actualizar tabla perfil_usuario
            $sqlPerfil = $conexion->prepare("
                UPDATE perfil_usuario
                SET telefono = :telefono,
                    nacionalidad = :nacionalidad,
                    genero = :genero,
                    id_departamento = :id_departamento,
                    id_distrito = :id_distrito,
                    id_municipio = :id_municipio
                WHERE id_perfil = :id_perfil
            ");

            $sqlPerfil->bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);
            $sqlPerfil->bindParam(":nacionalidad", $data['nacionalidad'], PDO::PARAM_STR);
            $sqlPerfil->bindParam(":genero", $data['genero'], PDO::PARAM_STR);
            
            $id_dep = $data['id_departamento'] ? (int)$data['id_departamento'] : null;
            $id_dist = $data['id_distrito'] ? (int)$data['id_distrito'] : null;
            $id_mun = $data['id_municipio'] ? (int)$data['id_municipio'] : null;

            if ($id_dep === null) $sqlPerfil->bindValue(":id_departamento", null, PDO::PARAM_NULL);
            else $sqlPerfil->bindParam(":id_departamento", $id_dep, PDO::PARAM_INT);

            if ($id_dist === null) $sqlPerfil->bindValue(":id_distrito", null, PDO::PARAM_NULL);
            else $sqlPerfil->bindParam(":id_distrito", $id_dist, PDO::PARAM_INT);

            if ($id_mun === null) $sqlPerfil->bindValue(":id_municipio", null, PDO::PARAM_NULL);
            else $sqlPerfil->bindParam(":id_municipio", $id_mun, PDO::PARAM_INT);

            $sqlPerfil->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);
            $sqlPerfil->execute();

            // 4. Actualizar tabla profesion
            if (isset($data['profesion'])) {
                $sqlCheck = $conexion->prepare("SELECT id_profesion FROM profesion WHERE id_perfil = :id_perfil LIMIT 1");
                $sqlCheck->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);
                $sqlCheck->execute();
                $prof_row = $sqlCheck->fetch(PDO::FETCH_ASSOC);

                if ($prof_row) {
                    $sqlUpdateProf = $conexion->prepare("
                        UPDATE profesion
                        SET profesion = :profesion
                        WHERE id_perfil = :id_perfil
                    ");
                    $sqlUpdateProf->bindParam(":profesion", $data['profesion'], PDO::PARAM_STR);
                    $sqlUpdateProf->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);
                    $sqlUpdateProf->execute();
                } else {
                    $sqlInsertProf = $conexion->prepare("
                        INSERT INTO profesion(id_perfil, profesion)
                        VALUES(:id_perfil, :profesion)
                    ");
                    $sqlInsertProf->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);
                    $sqlInsertProf->bindParam(":profesion", $data['profesion'], PDO::PARAM_STR);
                    $sqlInsertProf->execute();
                }
            }

            $conexion->commit();
            
            // Actualizar la sesión
            $_SESSION['userAuth']['nombre'] = $data['nombre'];
            $_SESSION['userAuth']['correo'] = $data['correo'];

            return true;
        } catch (\Throwable $th) {
            if ($conexion && $conexion->inTransaction()) {
                $conexion->rollBack();
            }
            return 'Error: ' . $th->getMessage();
        }
    }

    // Obtener perfil detallado del usuario (candidato) con ubicaciones y profesión
    public static function obtenerPerfilDetallado(int $id_usuario)
    {
        try {
            $db = Conexion::conexion();
            $sql = $db->prepare("
                SELECT u.nombre, u.apellido, u.correo, 
                       p.nacionalidad, p.telefono, p.foto, p.genero,
                       d.departamento, dist.distrito, m.municipio, 
                       prof.profesion, p.id_departamento, p.id_distrito, p.id_municipio, prof.id_profesion
                FROM usuarios u
                LEFT JOIN perfil_usuario p ON u.id_usuario = p.id_usuario
                LEFT JOIN departamentos d ON p.id_departamento = d.id_departamento
                LEFT JOIN distritos dist ON p.id_distrito = dist.id_distrito
                LEFT JOIN municipios m ON p.id_municipio = m.id_municipio
                LEFT JOIN profesion prof ON p.id_perfil = prof.id_perfil
                WHERE u.id_usuario = :id_usuario
                LIMIT 1
            ");
            $sql->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }

}