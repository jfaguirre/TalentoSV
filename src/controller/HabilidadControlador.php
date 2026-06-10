<?php
namespace App\controller;

use App\models\Habilidad;
use App\Request\HabilidadRequest;
use App\helpers\Alert;

class HabilidadControlador
{
    // CRUD Habilidad controlador

    // Crear habilidad
    public function crearHabilidad()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['habilidad']))
        {
            $id_usuario = $_SESSION['userAuth']['id'] ?? (isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0);
            $habilidadNombre = $_POST['habilidad'];

            $habilidad = new Habilidad($id_usuario, $habilidadNombre);

            $validacion = HabilidadRequest::validacion($habilidad);

            if(empty($validacion))
            {
                // Enviamos los datos al modelo                
                $respuesta = $habilidad->crearHabilidad($habilidad);

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
                    Alert::success('Perfil de usuario', "Habilidad agregada correctamente."); 
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

    // Mostrar habilidades
    public static function mostrarHabilidades()
    {
        $id_usuario = $_SESSION['userAuth']['id'] ?? null;
        $habilidades = Habilidad::mostrarHabilidades($id_usuario);
        return $habilidades;
    }

    // Eliminar habilidad
    public function eliminarHabilidad()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_habilidad']))
        {
            $id = (int)$_POST['id_habilidad'];

            $respuesta = Habilidad::eliminarHabilidad($id);

            if($respuesta)
            {
                return true;
            }            
        }
    }

    // Actualizar habilidad
    public function actualizarHabilidad(int $id_habilidad)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['habilidad']))
        {
            $id_usuario = $_SESSION['userAuth']['id'] ?? (isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0);
            $habilidadNombre = $_POST['habilidad'];

            $habilidad = new Habilidad($id_usuario, $habilidadNombre);

            $validacion = HabilidadRequest::validacion($habilidad);

            if(empty($validacion))
            {
                // Enviamos los datos al modelo                
                $respuesta = Habilidad::actualizarHabilidad($habilidad, $id_habilidad);

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
                    Alert::success('Perfil de usuario', "La habilidad se actualizó correctamente."); 
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
