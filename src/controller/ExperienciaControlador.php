<?php
namespace App\controller;

use App\models\Experiencia;
use App\Request\ExperienciaRequest;
use App\helpers\Alert;

class ExperienciaControlador
{
    // CRUD Experiencia controlador

    // Crear experiencia
    public function crearExperiencia()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['empresa']))
        {
            $id_usuario = $_SESSION['userAuth']['id'] ?? (isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0);
            $empresa = $_POST['empresa'];
            $puesto = $_POST['puesto'];
            $descripcion = $_POST['descripcion'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];

            $experiencia = new Experiencia(
                $id_usuario,
                $empresa,
                $puesto,
                $descripcion,
                $fecha_inicio,
                $fecha_fin
            );

            $validacion = ExperienciaRequest::validacion($experiencia);

            if(empty($validacion))
            {
                // Enviamos los datos al modelo                
                $respuesta = $experiencia->crearExperiencia($experiencia);

                if($respuesta)
                {                                        
                    echo '
                        <script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }
                            setTimeout(function(){
                                window.location.href = "index.php?pagina=perfil";
                            }, 2000);
                        </script>
                    ';                                          
                    Alert::success('Perfil de usuario', "Experiencia de trabajo agregada correctamente."); 
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

    // Mostrar experiencia
    public static function mostrarExperiencias()
    {
        $id_usuario = $_SESSION['userAuth']['id'] ?? null;
        $experiencias = Experiencia::mostrarExperiencias($id_usuario);
        return $experiencias;
    }

    // Eliminar experiencia
    public function eliminarExperiencia()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_experiencia']))
        {
            $id = (int)$_POST['id_experiencia'];

            $respuesta = Experiencia::eliminarExperiencia($id);

            if($respuesta)
            {
                return true;
            }            
        }
    }

    // Actualizar experiencia
    public function actualizarExperiencia(int $id_experiencia)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['empresa']))
        {
            $id_usuario = $_SESSION['userAuth']['id'] ?? (isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0);
            $empresa = $_POST['empresa'];
            $puesto = $_POST['puesto'];
            $descripcion = $_POST['descripcion'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];

            $experiencia = new Experiencia(
                $id_usuario,
                $empresa,
                $puesto,
                $descripcion,
                $fecha_inicio,
                $fecha_fin
            );
            $validacion = ExperienciaRequest::validacion($experiencia);

            if(empty($validacion))
            {
                // Enviamos los datos al modelo                
                $respuesta = Experiencia::actualizarExperiencia($experiencia, $id_experiencia);

                if($respuesta)
                {                                        
                    echo '
                        <script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }
                            setTimeout(function(){
                                window.location.href = "index.php?pagina=perfil";
                            }, 2000);
                        </script>
                    ';                                          
                    Alert::success('Perfil de usuario', "Los datos se actualizaron correctamente."); 
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