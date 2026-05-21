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
            
            $consultaSQL = $conexion
            ->prepare("INSERT INTO usuarios(nombre, apellido, correo, password)        
            VALUES(:nombre, :apellido, :correo, :password)");

            $consultaSQL->bindParam(":nombre", $usuario->nombre, PDO::PARAM_STR);
            $consultaSQL->bindParam(":apellido", $usuario->apellido, PDO::PARAM_STR);
            $consultaSQL->bindParam(":correo", $usuario->correo, PDO::PARAM_STR);
            $consultaSQL->bindParam(":password", $usuario->password, PDO::PARAM_STR);
            $consultaSQL->execute();

            // Agregar el rol de usuario
            $id = $conexion->lastInsertId();                            
            $consultaRol = $conexion
                ->prepare("INSERT INTO roles_usuarios (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)");
                $consultaRol->bindParam(":id_usuario", $id, PDO::PARAM_INT);
                $consultaRol->bindValue(":id_rol", 2, PDO::PARAM_INT); 
                $consultaRol->execute();

            $conexion->commit();
            return true;
            

        } catch (\Throwable $th) {

            Conexion::conexion()->rollBack();            
            
            Alert::success('Ups!', 'Al parecer hubo un error. Intenta de nuevo.');            
            return 'Error: '.$th->getMessage();
        }
    }


    // Metodo para iniciar sesion de usuario
    static public function autenticar(Usuario $usuario){

        try {
            
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
                JOIN roles_usuarios ru ON u.id_usuario = ru.id_usuario
                JOIN roles r ON ru.id_rol = r.id_rol
                WHERE u.id_usuario = :id_usuario;"
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
}