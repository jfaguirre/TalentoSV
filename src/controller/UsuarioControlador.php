<?php
namespace App\controller;

use App\models\Usuario;
use App\models\Conexion;

class UsuarioControlador
{
    // ============================================================
    // ACTUALIZAR PERFIL COMPLETO (usuarios + perfil_usuario)
    // ============================================================
    public function actualizarPerfil()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $id_usuario = (int)$_POST['id_usuario'];

        // ============================================================
        // 1. ACTUALIZAR TABLA usuarios
        // ============================================================
        $usuario = new Usuario(
            $_POST['nombre'],
            $_POST['apellido'],
            $_POST['correo'],
            $_POST['password'] ?: null
        );

        Usuario::actualizarUsuario($id_usuario, $usuario);

        // ============================================================
        // 2. VERIFICAR SI EXISTE PERFIL
        // ============================================================
        $db = Conexion::conexion()->prepare("
            SELECT id_usuario FROM perfil_usuario WHERE id_usuario = :id
        ");
        $db->execute([':id' => $id_usuario]);

        // ============================================================
        // 3. SI NO EXISTE → CREAR PERFIL
        // ============================================================
        if ($db->rowCount() == 0) {

            Usuario::crearPerfil([
                ':id_usuario'      => $id_usuario,
                ':id_departamento' => $_POST['id_departamento'] ?: null,
                ':id_distrito'     => $_POST['id_distrito'] ?: null,
                ':id_municipio'    => $_POST['id_municipio'] ?: null,
                ':id_profesion'    => $_POST['id_profesion'] ?: null,
                ':nacionalidad'    => $_POST['nacionalidad'] ?: '',
                ':telefono'        => $_POST['telefono'] ?: '',
                ':foto'            => '', // si luego agregas foto, aquí se cambia
                ':genero'          => $_POST['genero'] ?: ''
            ]);
        }

        // ============================================================
        // 4. SI YA EXISTE → ACTUALIZAR PERFIL
        // ============================================================
        $sql = Conexion::conexion()->prepare("
            UPDATE perfil_usuario SET
                nacionalidad = :nacionalidad,
                telefono = :telefono,
                genero = :genero,
                id_departamento = :id_departamento,
                id_distrito = :id_distrito,
                id_municipio = :id_municipio,
                id_profesion = :id_profesion
            WHERE id_usuario = :id_usuario
        ");

        $sql->execute([
            ':nacionalidad'    => $_POST['nacionalidad'],
            ':telefono'        => $_POST['telefono'],
            ':genero'          => $_POST['genero'],
            ':id_departamento' => $_POST['id_departamento'] ?: null,
            ':id_distrito'     => $_POST['id_distrito'] ?: null,
            ':id_municipio'    => $_POST['id_municipio'] ?: null,
            ':id_profesion'    => $_POST['id_profesion'] ?: null,

            ':id_usuario'      => $id_usuario
        ]);

        // ============================================================
        // 5. REDIRECCIÓN
        // ============================================================
        header("Location: index.php?pagina=perfil");
        exit;
    }

    public function actualizarConfiguracion()
{
    if ($_POST['actualizar_config'] !== 'perfil') return;

    $id = $_POST['id_usuario'];
    $correo = $_POST['correo'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    $db = Conexion::conexion()->prepare("
        UPDATE usuarios SET correo = :correo " . 
        ($password ? ", password = :password " : "") . "
        WHERE id_usuario = :id
    ");

    $db->bindParam(':correo', $correo);
    $db->bindParam(':id', $id);

    if ($password) {
        $db->bindParam(':password', $password);
    }

    $db->execute();

    $_SESSION['userAuth']['correo'] = $correo;

    header("Location: index.php?pagina=configuraciones");
    exit;
}

}
