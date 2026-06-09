<?php
namespace App\models;

use App\models\Conexion;
use PDO;

class Oferta {

    // recibe los datos de la oferta
    public function __construct(
        public ?int $id_empresa,
        public ?string $titulo,
        public ?string $descripcion,
        public ?string $tipo_contrato
    ){}

 
    // Inserta una nueva oferta en la base de datos
    public static function crearOferta(Oferta $oferta)
    {

        $perfil_empresa = Empresa::obtenerPerfil($oferta->id_empresa);

        $sql = Conexion::conexion()->prepare("
            INSERT INTO oferta_empleos 
            (id_empresa, titulo, descripcion, tipo_contrato, id_departamento, id_distrito, id_municipio)
            VALUES (:id_empresa, :titulo, :descripcion, :tipo, :id_departamento, :id_distrito, :id_municipio)
        ");

        $sql->bindParam(":id_empresa", $oferta->id_empresa);
        $sql->bindParam(":titulo", $oferta->titulo);
        $sql->bindParam(":descripcion", $oferta->descripcion);
        $sql->bindParam(":tipo", $oferta->tipo_contrato);
        $sql->bindParam(":id_departamento", $perfil_empresa['id_departamento']);
        $sql->bindParam(":id_distrito", $perfil_empresa['id_distrito']);
        $sql->bindParam(":id_municipio", $perfil_empresa['id_municipio']);

        return $sql->execute();
    }

  
    // Devuelve todas las ofertas registradas
    public static function obtenerLista()
    {
        $sql = Conexion::conexion()->prepare("SELECT * FROM oferta_empleos ORDER BY id_oferta DESC");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    // Modifica los datos de una oferta existente
    public static function actualizarOferta($id_oferta, Oferta $oferta)
    {
        $sql = Conexion::conexion()->prepare("
            UPDATE oferta_empleos 
            SET id_empresa = :id_empresa,
                titulo = :titulo,
                descripcion = :descripcion,
                tipo_contrato = :tipo
            WHERE id_oferta = :id_oferta
        ");

        $sql->bindParam(":id_empresa", $oferta->id_empresa);
        $sql->bindParam(":titulo", $oferta->titulo);
        $sql->bindParam(":descripcion", $oferta->descripcion);
        $sql->bindParam(":tipo", $oferta->tipo_contrato);
        $sql->bindParam(":id_oferta", $id_oferta);

        return $sql->execute();
    }


    // Borra una oferta de la base de datos
    public static function eliminarOferta($id_oferta)
    {
        $sql = Conexion::conexion()->prepare("
            DELETE FROM oferta_empleos WHERE id_oferta = :id_oferta
        ");

        $sql->bindParam(":id_oferta", $id_oferta);
        return $sql->execute();
    }

    // Obtener las ofertas de una empresa específica
    public static function obtenerListaPorEmpresa(int $id_empresa)
    {
        $sql = Conexion::conexion()->prepare("
            SELECT * FROM oferta_empleos 
            WHERE id_empresa = :id_empresa 
            ORDER BY id_oferta DESC
        ");
        $sql->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    // Obtener una oferta por su ID
    public static function obtenerPorId(int $id_oferta)
    {
        $sql = Conexion::conexion()->prepare("
            SELECT * FROM oferta_empleos 
            WHERE id_oferta = :id_oferta 
            LIMIT 1
        ");
        $sql->bindParam(":id_oferta", $id_oferta, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

 
    // Obtener ofertas por departamentos
    public static function obtenerOfertasDepartamento(){

         $sql = Conexion::conexion()->prepare("
            SELECT
                d.id_departamento,
                d.departamento,
                COUNT(o.id_oferta) AS total_ofertas
            FROM departamentos d
            LEFT JOIN oferta_empleos o
                ON d.id_departamento = o.id_departamento
            GROUP BY d.id_departamento, d.departamento
            HAVING COUNT(o.id_oferta) > 0
            ORDER BY d.departamento
        ");

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    // Obtener ofertas por distrito
    public static function obtenerOfertasDistritos(int $id_distrito)
    {
        $sql = Conexion::conexion()->prepare("
           SELECT
                d.id_distrito,
                d.distrito,
                COUNT(o.id_oferta) AS total_ofertas
            FROM distritos d
            LEFT JOIN oferta_empleos o
                ON d.id_distrito = o.id_distrito
            GROUP BY d.id_distrito, d.distrito
            HAVING COUNT(o.id_oferta) > 0
            ORDER BY d.distrito
        ");
        
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


     // Obtener ofertas por municipio
    public static function obtenerOfertasMunicipios(int $id_municipio)
    {
        $sql = Conexion::conexion()->prepare("
            SELECT
                m.id_municipio,
                m.municipio,
            COUNT(o.id_oferta) AS total_ofertas
            FROM municipios m
            LEFT JOIN oferta_empleos o
                ON m.id_municipio = o.id_municipio
            GROUP BY m.id_municipio, m.municipio
            HAVING COUNT(o.id_oferta) > 0
            ORDER BY m.municipio;
        ");
        
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    // Obtener ofertas por municipio con detalles de la empresa
    public static function obtenerOfertasEmpleo(int $id_municipio)
    {
        $sql = Conexion::conexion()->prepare("
            SELECT 
                o.id_oferta,
                o.titulo,
                o.descripcion,
                o.tipo_contrato,
                e.nombre_empresa AS empresa
            FROM oferta_empleos o
            LEFT JOIN empresas e 
                ON o.id_empresa = e.id_empresa
            WHERE o.id_municipio = :id
            ORDER BY o.id_oferta DESC
        ");

        $sql->bindParam(":id", $id_municipio, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
   
    // Aqui podes agregar más métodos relacionados con las ofertas, como buscar por título, filtrar por tipo de contrato, etc.
    

}
