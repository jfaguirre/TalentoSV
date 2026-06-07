<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

use App\controller\PlantillaControlador;
use App\helpers\UbicacionGeorafica;

// Cargar Departamentos, Distritos y Municipios
UbicacionGeorafica::ubicacionGeorafica();

$plantilla = new PlantillaControlador();
$plantilla->plantilla();