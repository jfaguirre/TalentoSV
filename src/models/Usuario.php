<?php
namespace App\models;

use App\models\Conexion;
use App\helpers\Alert;
use PDO;

class Usuario {

    public function 
    __construct(        
        public string $nombre, 
        public string $apellido,
        public string $correo,
        public string $password        
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
}