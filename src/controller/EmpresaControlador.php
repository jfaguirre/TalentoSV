<?php
namespace App\controller;

use App\models\Empresa;
use App\models\Oferta;
use App\models\Usuario;
use App\models\Conexion;
use App\helpers\Alert;

class EmpresaControlador {

    // Obtener estadísticas y datos del inicio de la empresa
    public function obtenerDatosInicio(int $id_empresa)
    {
        $postulaciones = Empresa::obtenerPostulaciones($id_empresa);
        $ofertas = Oferta::obtenerListaPorEmpresa($id_empresa);
        $entrevistas = Empresa::obtenerEntrevistas($id_empresa);

        $totalOfertas = count($ofertas);
        $totalPostulaciones = count($postulaciones);
        
        $pendientes = 0;
        $aceptadas = 0;
        foreach ($postulaciones as $p) {
            if ($p['estado'] === 'pendiente') {
                $pendientes++;
            } elseif ($p['estado'] === 'aceptada') {
                $aceptadas++;
            }
        }

        return [
            'totalOfertas' => $totalOfertas,
            'totalPostulaciones' => $totalPostulaciones,
            'pendientes' => $pendientes,
            'aceptadas' => $aceptadas,
            'postulaciones' => $postulaciones,
            'entrevistas' => $entrevistas
        ];
    }

    // Gestionar acciones de la vista de inicio (cambiar estado o programar entrevista)
    public function procesarAccionesInicio()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['accion']) && $_POST['accion'] === 'cambiar_estado') {
                $id_postulacion = intval($_POST['id_postulacion']);
                $estado = $_POST['estado'];
                if ($id_postulacion > 0 && in_array($estado, ['pendiente', 'revisada', 'aceptada', 'rechazada'], true)) {
                    $res = Empresa::actualizarEstadoPostulacion($id_postulacion, $estado);
                    if ($res) {
                        Alert::success('Postulación', 'El estado del candidato ha sido actualizado.');
                        header("Refresh: 1.5; url=index.php?pagina=inicio");
                        exit;
                    } else {
                        Alert::error('Error', 'No se pudo actualizar el estado.');
                    }
                }
            }

            if (isset($_POST['accion']) && $_POST['accion'] === 'programar_entrevista') {
                $id_postulacion = intval($_POST['id_postulacion']);
                $id_empresa = intval($_SESSION['userAuth']['empresa_id']);
                $fecha_hora = $_POST['fecha_hora'];
                $tipo = $_POST['tipo'];

                if ($id_postulacion > 0 && !empty($fecha_hora) && !empty($tipo)) {
                    Empresa::actualizarEstadoPostulacion($id_postulacion, 'revisada');
                    $res = Empresa::programarEntrevista($id_empresa, $id_postulacion, $fecha_hora, $tipo);
                    if ($res) {
                        Alert::success('Entrevista', 'La entrevista ha sido programada con éxito.');
                        header("Refresh: 1.5; url=index.php?pagina=inicio");
                        exit;
                    } else {
                        Alert::error('Error', 'No se pudo programar la entrevista.');
                    }
                }
            }
        }
    }

    // Obtener y guardar perfil de la empresa
    public function gestionarPerfil(int $id_empresa)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_empresa'])) {
            $nombre = trim($_POST['nombre_empresa']);
            $correo = trim($_POST['correo_empresa']);
            $telefono = trim($_POST['telefono_empresa']);
            $sector = trim($_POST['sector']);
            $id_departamento = isset($_POST['id_departamento']) && $_POST['id_departamento'] !== '' ? (int)$_POST['id_departamento'] : null;
            $id_distrito = isset($_POST['id_distrito']) && $_POST['id_distrito'] !== '' ? (int)$_POST['id_distrito'] : null;
            $id_municipio = isset($_POST['id_municipio']) && $_POST['id_municipio'] !== '' ? (int)$_POST['id_municipio'] : null;
            $sitio_web = trim($_POST['sitio_web']);
            $descripcion = trim($_POST['descripcion']);

            if (empty($nombre) || empty($correo)) {
                Alert::error('Datos inválidos', 'El nombre y correo de la empresa son requeridos.');
            } else {
                $res = Empresa::actualizarPerfilEmpresa($id_empresa, $nombre, $correo, $telefono, $sector, $id_departamento, $id_distrito, $id_municipio, $sitio_web, $descripcion);
                if ($res) {
                    Alert::success('Perfil Actualizado', 'Los datos de la empresa se actualizaron correctamente.');
                    header("Refresh: 1.5; url=index.php?pagina=perfil");
                    exit;
                } else {
                    Alert::error('Error', 'Hubo un problema al actualizar el perfil.');
                }
            }
        }

        return Empresa::obtenerPerfil($id_empresa);
    }

    // Cargar y procesar ofertas
    public function gestionarOfertas(int $id_empresa)
    {
        // Crear Oferta
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'crear') {
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
            $tipo_contrato = $_POST['tipo_contrato'];

            if (empty($titulo) || empty($descripcion) || empty($tipo_contrato)) {
                Alert::error('Formulario incompleto', 'Por favor llena todos los campos de la oferta.');
            } else {
                $oferta = new Oferta($id_empresa, $titulo, $descripcion, $tipo_contrato);
                $res = Oferta::crearOferta($oferta);
                if ($res) {
                    Alert::success('Oferta Creada', 'La oferta de empleo ha sido publicada.');
                    header("Refresh: 1.5; url=index.php?pagina=ofertas");
                    exit;
                } else {
                    Alert::error('Error', 'No se pudo publicar la oferta.');
                }
            }
        }

        // Editar Oferta
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'editar') {
            $id_oferta = intval($_POST['id_oferta']);
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
            $tipo_contrato = $_POST['tipo_contrato'];

            if ($id_oferta > 0 && !empty($titulo) && !empty($descripcion) && !empty($tipo_contrato)) {
                $oferta = new Oferta($id_empresa, $titulo, $descripcion, $tipo_contrato);
                $res = Oferta::actualizarOferta($id_oferta, $oferta);
                if ($res) {
                    Alert::success('Oferta Editada', 'La oferta de empleo ha sido actualizada.');
                    header("Refresh: 1.5; url=index.php?pagina=ofertas");
                    exit;
                } else {
                    Alert::error('Error', 'No se pudo actualizar la oferta.');
                }
            }
        }

        // Eliminar Oferta
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'eliminar') {
            $id_oferta = intval($_POST['id_oferta']);
            if ($id_oferta > 0) {
                $res = Oferta::eliminarOferta($id_oferta);
                if ($res) {
                    Alert::success('Oferta Eliminada', 'La vacante se ha retirado.');
                    header("Refresh: 1.5; url=index.php?pagina=ofertas");
                    exit;
                } else {
                    Alert::error('Error', 'No se pudo eliminar la oferta.');
                }
            }
        }

        return Oferta::obtenerListaPorEmpresa($id_empresa);
    }

    // Gestionar la cuenta de usuario (configuración)
    public function gestionarConfiguracion(int $id_usuario)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombreUsuario'])) {
            $nombre = trim($_POST['nombreUsuario']);
            $apellido = trim($_POST['apellidoUsuario']);
            $correo = trim($_POST['correoUsuario']);
            $password = trim($_POST['passwordUsuario']);

            if (empty($nombre) || empty($apellido) || empty($correo)) {
                Alert::error('Campos requeridos', 'El nombre, apellido y correo son obligatorios.');
                return false;
            }

            // Si la contraseña está vacía, mantenemos la anterior
            if (empty($password)) {
                $db = Conexion::conexion();
                $stmt = $db->prepare("SELECT password FROM usuarios WHERE id_usuario = :id");
                $stmt->execute([':id' => $id_usuario]);
                $user = $stmt->fetch();
                $password = $user['password'];
            }

            $usuario = new Usuario($nombre, $apellido, $correo, $password);
            $res = Usuario::actualizarUsuario($id_usuario, $usuario);

            if ($res === true) {
                $_SESSION['userAuth']['nombre'] = $nombre;
                $_SESSION['userAuth']['correo'] = $correo;
                Alert::success('Cuenta Actualizada', 'Los datos de acceso han sido modificados.');
                header("Refresh: 1.5; url=index.php?pagina=configuracion");
                exit;
            } else {
                Alert::error('Error', 'No se pudieron guardar los cambios: ' . $res);
            }
        }

        // Consultar datos de usuario
        $db = Conexion::conexion();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id_usuario = :id LIMIT 1");
        $stmt->execute([':id' => $id_usuario]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
