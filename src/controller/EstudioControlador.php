<?php
namespace App\controller;

use App\models\Estudio;
use App\Request\EstudioRequest;
use App\helpers\Alert;

class EstudioControlador
{
    // CRUD Estudio controlador

    // Crear estudio
    public function crearEstudio()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['titulo']))
        {
            $id_usuario = $_SESSION['userAuth']['id'] ?? (isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0);
            $id_nivel_academico = isset($_POST['id_nivel_academico']) && $_POST['id_nivel_academico'] !== '' ? (int)$_POST['id_nivel_academico'] : null;
            $titulo = $_POST['titulo'];
            $institucion = $_POST['institucion'];
            $fecha_logro = $_POST['fecha_logro'];
            $estado = $_POST['estado'];
            $descripcion = $_POST['descripcion'] ?? '';

            $estudio = new Estudio(
                $id_usuario,
                $id_nivel_academico,
                $titulo,
                $institucion,
                $fecha_logro,
                $estado,
                $descripcion
            );

            $validacion = EstudioRequest::validacion($estudio);

            if(empty($validacion))
            {
                // Enviamos los datos al modelo                
                $respuesta = $estudio->crearEstudio($estudio);

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
                    Alert::success('Perfil de usuario', "Estudio académico agregado correctamente."); 
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

    // Mostrar estudio
    public static function mostrarEstudios()
    {
        $id_usuario = $_SESSION['userAuth']['id'] ?? null;
        $estudios = Estudio::mostrarEstudios($id_usuario);
        return $estudios;
    }

    // Eliminar estudio
    public function eliminarEstudio()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_estudio']))
        {
            $id = (int)$_POST['id_estudio'];

            $respuesta = Estudio::eliminarEstudio($id);

            if($respuesta)
            {
                return true;
            }            
        }
    }

    // Actualizar estudio
    public function actualizarEstudio(int $id_estudio)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['titulo']))
        {
            $id_usuario = $_SESSION['userAuth']['id'] ?? (isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0);
            $id_nivel_academico = isset($_POST['id_nivel_academico']) && $_POST['id_nivel_academico'] !== '' ? (int)$_POST['id_nivel_academico'] : null;
            $titulo = $_POST['titulo'];
            $institucion = $_POST['institucion'];
            $fecha_logro = $_POST['fecha_logro'];
            $estado = $_POST['estado'];
            $descripcion = $_POST['descripcion'] ?? '';

            $estudio = new Estudio(
                $id_usuario,
                $id_nivel_academico,
                $titulo,
                $institucion,
                $fecha_logro,
                $estado,
                $descripcion
            );

            $validacion = EstudioRequest::validacion($estudio);

            if(empty($validacion))
            {
                // Enviamos los datos al modelo                
                $respuesta = Estudio::actualizarEstudio($estudio, $id_estudio);

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
                    Alert::success('Perfil de usuario', "Los datos del estudio se actualizaron correctamente."); 
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