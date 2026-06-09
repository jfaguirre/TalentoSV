<?php

namespace App\Views\UsuarioControlador;
use App\controller\OfertaControlador;

$oferta = OfertaControlador::obtenerDetalleEmpleo($_GET['id_oferta'] ?? 0);

die(var_dump($oferta));


?>

<h1>Empleo</h1>