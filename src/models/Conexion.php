
<?php

class Conexion {

    static public function conexion(){

        // 1. nombre del servidor y nombre de la base de datos
        // 2. nombre del usuario
        // 3. password del usuario

        $enlace = new PDO("mysql:host=localhost; dbname=bolsa_empleo", "root", "");
        $enlace->exec("set names utf8");

        return $enlace;

    }
}
