<?php
namespace App\controller;

use App\models\Postulaciones;
use App\helpers\Alert;

class PostulacionesControlador {

    // Procesa la postulación cuando el usuario confirma la aplicación
    public static function procesarPostulacion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'aplicar') {
            
            // Verificar si el usuario está autenticado
            if (!isset($_SESSION['userAuth'])) {
                Alert::error('Acceso denegado', 'Debes iniciar sesión para postularte a esta vacante.');
                echo '
                    <script>
                        setTimeout(function() {
                            window.location.href = "index.php?pagina=ingreso";
                        }, 1500);
                    </script>
                ';
                exit;
            }

            $id_usuario = intval($_SESSION['userAuth']['id']);
            $id_oferta = intval($_POST['id_oferta']);

            if ($id_usuario <= 0 || $id_oferta <= 0) {
                Alert::error('Error', 'Datos de postulación no válidos.');
                return false;
            }

            // Verificar si ya se postuló
            $yaPostulado = Postulaciones::verificarPostulacion($id_usuario, $id_oferta);
            if ($yaPostulado) {
                Alert::info('Información', 'Ya te has postulado anteriormente a esta oferta de empleo.');
                return false;
            }

            // Crear la postulación
            $res = Postulaciones::crearPostulacion($id_usuario, $id_oferta);
            if ($res) {
                echo '
                    <script>
                        if(window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }                 
                    </script>
                ';
                Alert::success('Postulación Exitosa', 'Te has postulado correctamente a esta oferta de empleo.');
                echo '
                    <script>
                        setTimeout(function() {
                            window.location.href = "index.php?pagina=postulaciones";
                        }, 2000);
                    </script>
                ';
                exit;
            } else {
                Alert::error('Error', 'Hubo un error al procesar tu postulación. Intenta de nuevo.');
                return false;
            }
        }
        return false;
    }

    // Obtiene el historial de postulaciones del usuario en sesión
    public static function obtenerHistorialUsuario()
    {
        if (!isset($_SESSION['userAuth'])) {
            return [];
        }

        $id_usuario = intval($_SESSION['userAuth']['id']);
        return Postulaciones::obtenerPostulacionesPorUsuario($id_usuario);
    }
}
