<?php

class UsuarioControlador {

    public function 
    __construct(        
        public string $nombre, 
        public string $apellido,
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
                // Aqui guardamos los datos en el modelo
            }
            else
            {
                // Mensaje de error del formulario
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
        
    }        

    // Mostrar un solo usuario
    public function mostrar_usuario()
    {

    }

    // Actualizar usuario
    public function actualizar_usuario()
    {

    }

    // Eliminar usuario
    public function eliminar_usuario()
    {

    }

    // Iniciar sesion
    public function login()
    {

    }

    // Cerrar sesion
    public function logout()
    {
        
    }
}