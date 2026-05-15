<?php

namespace App\controller;

use App\helpers\Validacion;
use App\helpers\Alert;
use App\controller\Auth;
use App\models\Usuario;

class UsuarioControlador {

    // Crear usuario
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
            $validacion = Validacion::validacion($usuario);            

            if(empty($validacion))
            {
                // Aqui enviamos los datos al modelo
                $respuesta = Usuario::crearUsuario($usuario);

                if($respuesta)
                {
                    Alert::success('Crear usuario', "Registro creado con exito.");
                }
            }
            else
            {
                // Mensaje de error para el formulario
                return $validacion;
            }
        }
    }


    // Mostrar usuarios
    public function mostrarUsuarios()
    {            
        // Solicitamos los usuarios al modelo
        $usuarios = Usuario::mostrarUsuarios();
        return $usuarios;
    }        


    // Mostrar un solo usuario
    public function mostrarUsuario(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $id > 0) {
            
            // Solicitamos el usuario al modelo
            $usuario = Usuario::mostrarUsuario($id);    
            return $usuario;
        }

    return false;             
    }
 

    // Actualizar usuario
    public function actualizarUsuario(int $id)
    {
        

    }


    // Eliminar usuario
    public function eliminarUsuario(int $id)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id > 0) {

        // Solicitamos la eliminacion al modelo
        return Usuario::eliminarUsuario($id);
    }

    return false;
}


    // Iniciar sesion
    public function login()
    {     

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingreso_correo'])){

            $correo = $_POST['ingreso_correo'];
            $password = $_POST['ingreso_password'];

            $datos = new UsuarioControlador(null, null, $correo, $password);

            $validacion = Validacion::validacion($datos);            
            
            if(empty($validacion)){
                
              // Solicitamos la informacion al modelo
                $respuesta = Usuario::Login($datos);
                        
                if(isset($respuesta['correo'])){
                        if($respuesta['correo'] == $datos->correo && $respuesta['password'] == $datos->password){                                                 

                        // Consultamos el rol del usuario                        
                        $user_role = Auth::checkRole($respuesta);  
                         
                            // Usuario inicio sesion
                            if($user_role['role'] === 'admin') {                               
                                $_SESSION['user_auth'] = json_encode($user_role);
                            } else {
                                $_SESSION['user_auth'] = json_encode($respuesta);
                            }   

                        header('location: dashboard.php');
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
}