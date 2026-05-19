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

    
    // Para determinar que role tiene el usuario
    static public function checkRole(array $respuesta)
    {
        try {

            $consultaSQL = Conexion::conexion()->prepare(
                "SELECT u.id, r.role
                FROM usuarios u
                JOIN roles_usuarios ur ON u.id = ur.usuario_id
                JOIN roles r ON ur.role_id = r.id
                WHERE u.id = :id"
            );

            $consultaSQL->bindParam(':id', $respuesta['id'], PDO::PARAM_INT);

            if($consultaSQL->execute()){

                return $consultaSQL->fetch(PDO::FETCH_ASSOC);

            } else {

                return null;

            }

        } catch (\Throwable $th) {

            return 'Error: ' . $th->getMessage();

        }
    }
}