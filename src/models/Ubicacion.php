<?php
namespace App\Models;

use App\models\Conexion;
use PDO;

class Ubicacion {

    // Para obtener los departamentos.
    public static function obtenerDepartamentos(): array
     {
        $sql = Conexion::conexion()->prepare("
            SELECT id_departamento, departamento
            FROM departamentos
            ORDER BY departamento
        ");
                        
        $sql->execute();        
        return $sql->fetchAll(PDO::FETCH_ASSOC);        
    }

    // Para obtener los distritos.
   public static function obtenerDistritos(int $id_departamento): array
   {
        $sql = Conexion::conexion()->prepare("
            SELECT id_distrito, distrito
            FROM distritos
            WHERE id_departamento = ?
            ORDER BY distrito
        ");

        $sql->bindValue(1, $id_departamento, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    // Para obtener los municipios.
    public static function obtenerMunicipios(int $id_distrito): array {

        $sql = Conexion::conexion()->prepare("
            SELECT id_municipio, municipio
            FROM municipios
            WHERE id_distrito = ?
            ORDER BY municipio
        ");

        $sql->bindValue(1, $id_distrito, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}