<?php
namespace App\models;

use App\models\Conexion;
use PDO;

class Oferta {

    // recibe los datos de la oferta
    public function __construct(
        public ?int $id_empresa,
        public ?int $id_salario,
        public ?string $titulo,
        public ?string $descripcion,
        public ?string $tipo_contrato
    ){}

 
    // Inserta una nueva oferta en la base de datos
    public static function crearOferta(Oferta $oferta)
    {
        $sql = Conexion::conexion()->prepare("
            INSERT INTO oferta_empleo 
            (id_empresa, id_salario, titulo, descripcion, tipo_contrato)
            VALUES (:id_empresa, :id_salario, :titulo, :descripcion, :tipo)
        ");

        $sql->bindParam(":id_empresa", $oferta->id_empresa);
        $sql->bindParam(":id_salario", $oferta->id_salario);
        $sql->bindParam(":titulo", $oferta->titulo);
        $sql->bindParam(":descripcion", $oferta->descripcion);
        $sql->bindParam(":tipo", $oferta->tipo_contrato);

        return $sql->execute();
    }

  
    // Devuelve todas las ofertas registradas
    public static function obtenerLista()
    {
        $sql = Conexion::conexion()->prepare("SELECT * FROM oferta_empleo");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    // Modifica los datos de una oferta existente
    public static function actualizarOferta($id_oferta, Oferta $oferta)
    {
        $sql = Conexion::conexion()->prepare("
            UPDATE oferta_empleo 
            SET id_empresa = :id_empresa,
                id_salario = :id_salario,
                titulo = :titulo,
                descripcion = :descripcion,
                tipo_contrato = :tipo
            WHERE id_oferta = :id_oferta
        ");

        $sql->bindParam(":id_empresa", $oferta->id_empresa);
        $sql->bindParam(":id_salario", $oferta->id_salario);
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
            DELETE FROM oferta_empleo WHERE id_oferta = :id_oferta
        ");

        $sql->bindParam(":id_oferta", $id_oferta);
        return $sql->execute();
    }
}