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
            INSERT INTO empresa (id_usuario, nombre_empresa, correo_empresa, telefono_empresa)
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
        $sql = Conexion::conexion()->prepare("SELECT * FROM empresa");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // actualizar perfil
    public static function actualizarPerfil($id_empresa, Empresa $empresa)
    {
        $sql = Conexion::conexion()->prepare("
            UPDATE empresa 
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
            DELETE FROM empresa WHERE id_empresa = :id_empresa
        ");

        $sql->bindParam(":id_empresa", $id_empresa);
        return $sql->execute();
    }
}