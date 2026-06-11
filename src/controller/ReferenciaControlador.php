<?php
namespace App\controller;

use App\models\Referencia;
use App\Request\ReferenciaRequest;
use App\helpers\Alert;

class ReferenciaControlador
{
    // CRUD referencias controlador

    // Crear referencia
    public function crearReferencia()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre_referencia']))
        {
            $id_usuario = $_SESSION['userAuth']['id'] ?? (isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0);
            $nombre_referencia = $_POST['nombre_referencia'];
            $telefono_contacto = $_POST['telefono_contacto'] ?? null;
            $correo_contacto = $_POST['correo_contacto'] ?? null;

            $referencia = new Referencia(
                $id_usuario,
                $nombre_referencia,
                $telefono_contacto,
                $correo_contacto
            );

            $validacion = ReferenciaRequest::validacion($referencia);

            if(empty($validacion))
            {
                // Enviamos los datos al modelo                
                $respuesta = $referencia->crearReferencia($referencia);

                if($respuesta)
                {                                        
                    echo '
                        <script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }                 
                        </script>
                    ';                                          
                    header("Refresh: 2; url=index.php?pagina=perfil");
                    Alert::success('Perfil de usuario', "Referencia agregada correctamente."); 
                    exit;
                }

                return false;
            }
            else
            {
                // Errores en el formulario
                return $validacion;
            }            
        }
    }

    // Mostrar referencias
    public static function mostrarReferencias()
    {
        $id_usuario = $_SESSION['userAuth']['id'] ?? null;
        $referencias = Referencia::mostrarReferencias($id_usuario);
        return $referencias;
    }

    // Eliminar referencia
    public function eliminarReferencia()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_referencia']))
        {
            $id = (int)$_POST['id_referencia'];

            $respuesta = Referencia::eliminarReferencia($id);

            if($respuesta)
            {
                return true;
            }            
        }
    }

    // Actualizar referencia
    public function actualizarReferencia(int $id_referencia)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre_referencia']))
        {
            $id_usuario = $_SESSION['userAuth']['id'] ?? (isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0);
            $nombre_referencia = $_POST['nombre_referencia'];
            $telefono_contacto = $_POST['telefono_contacto'] ?? null;
            $correo_contacto = $_POST['correo_contacto'] ?? null;

            $referencia = new Referencia(
                $id_usuario,
                $nombre_referencia,
                $telefono_contacto,
                $correo_contacto
            );

            $validacion = ReferenciaRequest::validacion($referencia);

            if(empty($validacion))
            {
                // Enviamos los datos al modelo                
                $respuesta = Referencia::actualizarReferencia($referencia, $id_referencia);

                if($respuesta)
                {                                        
                    echo '
                        <script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }                 
                        </script>
                    ';                                          
                    header("Refresh: 2; url=index.php?pagina=perfil");
                    Alert::success('Perfil de usuario', "La referencia se actualizó correctamente."); 
                    exit;
                }

                return false;
            }
            else
            {
                // Errores en el formulario
                return $validacion;
            }            
        }
    }     
}
