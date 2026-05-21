<?php

namespace App\controller;

use App\Request\UsuarioRequest;
use App\helpers\Alert;
use App\controller\AuthControlador;
use App\models\Usuario;
use App\Request\LoginRequest;

class UsuarioControlador {

    // Metodo para crear usuario
    public function crearUsuario() 
    {   
    
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombreUsuario']))
        {            
        
            $usuario = new Usuario(
                $_POST['nombreUsuario'],
                $_POST['apellidoUsuario'],
                $_POST['correoUsuario'],
                $_POST['passwordUsuario']
            );                      

            
            // Validamos que los datos sean correctos
            $validacion = UsuarioRequest::validacion($usuario);               
                                                
            if(empty($validacion))
            {
                // Aqui enviamos los datos al modelo
                $respuesta = Usuario::crearUsuario($usuario);

                if($respuesta)
                {                                        
                    echo '
                        <script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }                 
                        </script>
                    ';                                          
                    header("Refresh: 2; url=index.php?pagina=ingreso");
                    Alert::success('Usuario', "Registro creado con exito."); 
                    exit;
                }

                return [];
            }
            else
            {
                // Mensaje de error para el formulario                
                return $validacion;
            }
        }

    return [];
    }


    // Metodo para iniciar sesion
    public function login()
    {     

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['correoUsuario'])){

            $usuario = new Usuario( 
                $nombre = Null,
                $apellido = Null,
                $correo = $_POST['correoUsuario'],
                $password = $_POST['passwordUsuario']
            );
                                                
            $validacion = LoginRequest::validacion($usuario);            
            
            if(empty($validacion)){
                
                // Solicitamos la informacion al modelo
                $respuesta = Usuario::autenticar($usuario);
                        
                if(isset($respuesta['correo'])){
                        if($respuesta['correo'] == $usuario->correo && $respuesta['password'] == $usuario->password){                                                 

                        // Consultamos el rol del usuario                        
                        $user_role = AuthControlador::checkRole($respuesta);  
                                                                                                
                        $_SESSION['userAuth'] = [
                            'id' => $respuesta['id_usuario'],
                            'nombre' => $respuesta['nombre'],
                            'correo' => $respuesta['correo'],
                            'rol' => $user_role['rol'],
                            'modo' => 'usuario',
                            'empresa_id' => null
                        ];                       
                                                
                            header("Refresh: 2; url=index.php?pagina=ingreso");
                            exit;
                                                                            
                        } else {

                            $validacion['error_credenciales'] = 'El correo o password es incorrectos.';                   
                            return $validacion;
                        }
                } else {       

                        $validacion['error_credenciales'] = 'El correo o password es incorrectos.';                   
                        return $validacion;
                }
            } else {                
                return $validacion;                
            }
        }
    }


    // Metodo para mostrar todos los usuarios
    public function mostrarUsuarios()
    {            
        // Solicitamos los usuarios al modelo
        // $usuarios = Usuario::mostrarUsuarios();
        // return $usuarios;
    }        


    // Metodo para mostrar un solo usuario
    public function mostrarUsuario(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $id > 0) {
            
            // Solicitamos el usuario al modelo
            // $usuario = Usuario::mostrarUsuario($id);    
            // return $usuario;
        }

    return false;             
    }
 

    // Metodo para actualizar usuario
    public function actualizarUsuario(int $id)
    {
        

    }


    // Metodo para eliminar usuario
    public function eliminarUsuario(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id > 0) {

            // Solicitamos la eliminacion al modelo
            // return Usuario::eliminarUsuario($id);
        }

        return false;
    }

}