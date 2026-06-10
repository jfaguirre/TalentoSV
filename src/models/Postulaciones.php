<?php
namespace App\models;

use App\models\Conexion;
use PDO;

class Postulaciones {

    public function __construct(
        public ?int $id_usuario,
        public ?int $id_oferta,
        public ?string $fecha_postulacion = null,
        public ?string $estado = 'pendiente',
        public ?int $id_postulacion = null
    ){}

    // Inserta una nueva postulación en la base de datos
    public static function crearPostulacion(int $id_usuario, int $id_oferta)
    {
        try {
            $db = Conexion::conexion();
            $sql = $db->prepare("
                INSERT INTO postulaciones (id_usuario, id_oferta, estado)
                VALUES (:id_usuario, :id_oferta, 'pendiente')
            ");
            $sql->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sql->bindParam(":id_oferta", $id_oferta, PDO::PARAM_INT);
            return $sql->execute();
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Verifica si un usuario ya se postuló a una oferta específica
    public static function verificarPostulacion(int $id_usuario, int $id_oferta)
    {
        try {
            $db = Conexion::conexion();
            $sql = $db->prepare("
                SELECT id_postulacion FROM postulaciones 
                WHERE id_usuario = :id_usuario AND id_oferta = :id_oferta 
                LIMIT 1
            ");
            $sql->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sql->bindParam(":id_oferta", $id_oferta, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC) !== false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Obtiene todas las postulaciones de un usuario con detalles de la oferta, empresa y entrevistas
    public static function obtenerPostulacionesPorUsuario(int $id_usuario)
    {
        try {
            $db = Conexion::conexion();
            $sql = $db->prepare("
                SELECT p.*, o.titulo, o.tipo_contrato, e.nombre_empresa AS empresa,
                       ent.fecha_hora AS entrevista_fecha, ent.tipo AS entrevista_tipo, ent.estado AS entrevista_estado
                FROM postulaciones p
                INNER JOIN oferta_empleos o ON p.id_oferta = o.id_oferta
                INNER JOIN empresas e ON o.id_empresa = e.id_empresa
                LEFT JOIN entrevistas ent ON p.id_postulacion = ent.id_postulacion AND ent.estado = 'programada'
                WHERE p.id_usuario = :id_usuario
                ORDER BY p.fecha_postulacion DESC
            ");
            $sql->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return [];
        }
    }
}
