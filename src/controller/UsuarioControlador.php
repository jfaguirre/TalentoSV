<?php

namespace App\controller;

use App\helpers\Validacion;
use App\helpers\Alert;

class UsuarioControlador {

    public function 
    __construct(        
        public ?string $nombre, 
        public ?string $apellido,
        public string $correo,
        public string $password        
    )
    {        
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;        
        $this->password = $password;                       
    }


    // Crear usuario
    public function crear_usuario() 
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre_usuario']))
        {
            $tabla = "usuarios";

            $nombre = $_POST['nombre_usuario'];
            $apellido = $_POST['apellido_usuario'];
            $correo = $_POST['correo_usuario'];
            $password = $_POST['password_usuario'];

            $datos = new UsuarioControlador(
                $nombre,
                $apellido,
                $correo,
                $password
            );

            // Validamos que los datos sean correctos
            $validacion = Validacion::validacion($datos);

            if(empty($validacion))
            {
                // Aqui enviamos los datos al modelo
                $respuesta = Usuario::crear_usuario($datos, $tabla);

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
        else
        {
            // Mensaje de error
        }
    }


    // Mostrar usuarios
    public function mostrar_usuarios()
    {            
        // Solicitamos los usuarios al modelo
        $usuarios = Usuario::mostrar_usuarios();
        return $usuarios;
    }        


    // Mostrar un solo usuario
    public function mostrar_usuario(int $id)
    {
        
    }


    // Actualizar usuario
    public function actualizar_usuario(int $id)
    {

    }


    // Eliminar usuario
    public function eliminar_usuario(int $id)
    {

    }


    // Iniciar sesion
    public function login()
    {     

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingreso_correo'])){

            $tabla = 'usuarios';
            $correo = $_POST['ingreso_correo'];
            $password = $_POST['ingreso_password'];

            $datos = new UsuarioControlador(null, null, $correo, $password);

            $validacion = Validacion::validacion($datos);            
            
            if(empty($validacion)){
                
              // Solicitamos la informacion al modelo
                $respuesta = Usuario::iniciar_sesion($tabla, $datos);
                        
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


    // Cerrar sesion
    public function logout()
    {
        
    }
}