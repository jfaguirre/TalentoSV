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
         try {
            
            $consultaSQL = Conexion::conexion()
            ->prepare("INSERT INTO usuarios(nombre, apellido, correo, password)        
            VALUES(:nombre, :apellido, :correo, :password)");

            $consultaSQL->bindParam(":nombre", $usuario->nombre, PDO::PARAM_STR);
            $consultaSQL->bindParam(":apellido", $usuario->apellido, PDO::PARAM_STR);
            $consultaSQL->bindParam(":correo", $usuario->correo, PDO::PARAM_STR);
            $consultaSQL->bindParam(":password", $usuario->password, PDO::PARAM_STR);

            if($consultaSQL->execute()){
                return 'true';
            } else {
                return 'false';
            }

        } catch (\Throwable $th) {
            
            Alert::success('Ups!', 'Al parecer hubo un error. Intenta de nuevo.');            
            return 'Error: '.$th->getMessage();
        }
    }


    // Metodo para iniciar sesion de usuario
    static public function login(Usuario $usuario){

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
    public static function actualizarUsuario($id_usuario, Usuario $usuario)
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
    public static function eliminarUsuario($id_usuario)
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
    public static function crearPerfil($data)
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