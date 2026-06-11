<?php

namespace App\controller;

use App\controller\AuthControlador;
use App\models\Empresa;

// Controladores del perfil
use App\controller\ExperienciaControlador;
use App\controller\HabilidadControlador;
use App\controller\EstudioControlador;
use App\controller\ReferenciaControlador;
use App\controller\UsuarioControlador;

// Modelos para cargar listas
use App\models\Departamento;
use App\models\Distrito;
use App\models\Municipio;
use App\models\Profesion;
use App\models\Experiencia;
use App\models\Estudio;
use App\models\Habilidad;
use App\models\Referencia;
use App\models\Usuario;

class PlantillaControlador
{
    public function plantilla()
    {
        // Iniciar sesión si no se ha iniciado
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // ===============================
        // PROCESAR FORMULARIOS DEL PERFIL
        // ===============================

        // EXPERIENCIA
        if (isset($_POST['crear_experiencia'])) {
            (new ExperienciaControlador())->crearExperiencia();
        }

        if (isset($_POST['actualizar_experiencia'])) {
            (new ExperienciaControlador())->actualizarExperiencia((int)$_POST['id_experiencia']);
        }

        if (isset($_POST['id_experiencia']) && !isset($_POST['crear_experiencia']) && !isset($_POST['actualizar_experiencia'])) {
            (new ExperienciaControlador())->eliminarExperiencia();
        }

        // HABILIDAD
        if (isset($_POST['crear_habilidad'])) {
            (new HabilidadControlador())->crearHabilidad();
        }

        if (isset($_POST['actualizar_habilidad'])) {
            (new HabilidadControlador())->actualizarHabilidad((int)$_POST['id_habilidad']);
        }

        if (isset($_POST['id_habilidad']) && !isset($_POST['crear_habilidad']) && !isset($_POST['actualizar_habilidad'])) {
            (new HabilidadControlador())->eliminarHabilidad();
        }

        // ESTUDIO
        if (isset($_POST['crear_estudio'])) {
            (new EstudioControlador())->crearEstudio();
        }

        if (isset($_POST['actualizar_estudio'])) {
            (new EstudioControlador())->actualizarEstudio((int)$_POST['id_estudio']);
        }

        if (isset($_POST['id_estudio']) && !isset($_POST['crear_estudio']) && !isset($_POST['actualizar_estudio'])) {
            (new EstudioControlador())->eliminarEstudio();
        }

        // REFERENCIA
        if (isset($_POST['crear_referencia'])) {
            (new ReferenciaControlador())->crearReferencia();
        }

        if (isset($_POST['actualizar_referencia'])) {
            (new ReferenciaControlador())->actualizarReferencia((int)$_POST['id_referencia']);
        }

        if (isset($_POST['id_referencia']) && !isset($_POST['crear_referencia']) && !isset($_POST['actualizar_referencia'])) {
            (new ReferenciaControlador())->eliminarReferencia();
        }

        // PERFIL DE USUARIO
        if (isset($_POST['actualizar_perfil'])) {
            (new UsuarioControlador())->actualizarPerfil();
        }

        if (isset($_POST['actualizar_config'])) {
            (new UsuarioControlador())->actualizarConfiguracion();
        }

        if (isset($_POST['eliminar_cuenta'])) {
            (new UsuarioControlador())->eliminarCuenta();
        }


        // ===============================
        // FIN PROCESAMIENTO DE FORMULARIOS
        // ===============================


        // Cerrar sesión
        if (isset($_GET['pagina']) && $_GET['pagina'] === 'salir') {
            AuthControlador::logout();
            header('Location: index.php');
            exit;
        }

        // Cambiar modo usuario/empresa
        if (isset($_GET['cambiar_modo']) && isset($_SESSION['userAuth'])) {
            $nuevoModo = $_GET['cambiar_modo'];

            if ($nuevoModo === 'usuario') {
                $_SESSION['userAuth']['modo'] = 'usuario';
                $_SESSION['userAuth']['empresa_id'] = null;
                header('Location: index.php?pagina=inicio');
                exit;
            }

            if ($nuevoModo === 'empresa') {
                $id_usuario = $_SESSION['userAuth']['id'];
                $empresa = Empresa::obtenerPorUsuario($id_usuario);

                if (!$empresa) {
                    header('Location: index.php?pagina=registrar_empresa');
                    exit;
                }

                $_SESSION['userAuth']['modo'] = 'empresa';
                $_SESSION['userAuth']['empresa_id'] = $empresa['id_empresa'];

                header('Location: index.php?pagina=inicio');
                exit;
            }
        }

        // Si no hay sesión → plantilla pública
        if (!isset($_SESSION['userAuth'])) {
            include 'views/layouts/plantilla.php';
            return;
        }
        
        if (isset($_GET['pagina']) && $_GET['pagina'] === 'configuraciones') {
            $vista = 'views/usuarios/configuraciones.php';
            include 'views/layouts/usuarios.php';
            return;
        }


        $rol = $_SESSION['userAuth']['rol'];
        $modo = $_SESSION['userAuth']['modo'] ?? 'usuario';

        // Admin
        if ($rol === 'admin') {
            include 'views/layouts/admin.php';
            return;
        }

        // Empresa
        if ($modo === 'empresa') {
            include 'views/layouts/empresa.php';
            return;
        }

        // ===============================
        // CARGAR DATOS DEL PERFIL
        // ===============================

        $id_usuario = $_SESSION['userAuth']['id'];

        $perfil       = Usuario::obtenerPerfilDetallado($id_usuario);
        $experiencias = Experiencia::mostrarExperiencias($id_usuario);
        $estudios     = Estudio::mostrarEstudios($id_usuario);
        $habilidades  = Habilidad::mostrarHabilidades($id_usuario);
        $referencias  = Referencia::mostrarReferencias($id_usuario);


        // ===============================
        // MOSTRAR VISTA PERFIL
        // ===============================

        include 'views/layouts/usuarios.php';
    }
}
