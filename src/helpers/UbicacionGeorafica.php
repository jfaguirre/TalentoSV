<?php

namespace App\helpers;

use App\models\Ubicacion;

class UbicacionGeorafica {
      
    public static function ubicacionGeorafica() {
        if (isset($_GET['action'])) {
            header('Content-Type: application/json');
            $action = $_GET['action'];

            if ($action === 'get_departamentos') {
                echo json_encode(Ubicacion::obtenerDepartamentos());
                exit;
            } elseif ($action === 'get_distritos' && isset($_GET['id_departamento'])) {
                echo json_encode(Ubicacion::obtenerDistritos((int)$_GET['id_departamento']));
                exit;
            } elseif ($action === 'get_municipios' && isset($_GET['id_distrito'])) {
                echo json_encode(Ubicacion::obtenerMunicipios((int)$_GET['id_distrito']));
                exit;
            }
        }
    }
}
