<?php

namespace App\models;

use PDO;

class Conexion {
    private static ?PDO $instancia = null;

    static public function conexion(){
        
        if (self::$instancia === null) {
            // 1. nombre del servidor y nombre de la base de datos
            // 2. nombre del usuario
            // 3. password del usuario

            // Se creara una instancia para no estar recargando la conexion en cada peticion.
            self::$instancia = new PDO("mysql:host=localhost; dbname=bolsadb", "root", "");
            self::$instancia->exec("set names utf8");
            self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instancia;
    }
}
