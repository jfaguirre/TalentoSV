<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configuraciones</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: system-ui, sans-serif;
        }

        .config-container {
            max-width: 800px;
            margin: 30px auto;
        }

        .config-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 25px;
        }

        .config-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            border-left: 5px solid #0d6efd;
        }

        .config-card h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #0d6efd;
        }

        .config-card label {
            font-weight: 600;
            color: #444;
        }

        .config-card input {
            border-radius: 8px;
            padding: 10px;
        }

        .btn-save {
            background: #0d6efd;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 18px;
            transition: 0.2s;
        }

        .btn-save:hover {
            background: #0b5ed7;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 18px;
            transition: 0.2s;
        }

        .btn-delete:hover {
            background: #bb2d3b;
        }

        .warning-text {
            color: #dc3545;
            font-weight: 600;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<div class="container config-container">

    <h2 class="config-title">Configuraciones</h2>

    <!-- ============================
         CONFIGURAR PERFIL
    =============================== -->
    <div class="config-card">
        <h4>Configurar Perfil</h4>

        <form method="POST" action="">
            <input type="hidden" name="actualizar_config" value="perfil">
            <input type="hidden" name="id_usuario" value="<?= $_SESSION['userAuth']['id'] ?>">

            <label>Nuevo correo</label>
            <input type="email" name="correo" class="form-control mb-3"
                   value="<?= $_SESSION['userAuth']['correo'] ?>" required>

            <label>Nueva contraseña (opcional)</label>
            <input type="password" name="password" class="form-control mb-3">

            <button class="btn btn-save">Guardar cambios</button>
        </form>
    </div>

    <!-- ============================
         ELIMINAR CUENTA
    =============================== -->
    <div class="config-card">
        <h4>Eliminar Cuenta</h4>

        <p class="warning-text">Esta acción es permanente. No podrás recuperar tu información.</p>

        <form method="POST" action="">
            <input type="hidden" name="eliminar_cuenta" value="1">
            <input type="hidden" name="id_usuario" value="<?= $_SESSION['userAuth']['id'] ?>">

            <button class="btn btn-delete"
                    onclick="return confirm('¿Seguro que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')">
                Eliminar mi cuenta
            </button>
        </form>
    </div>

</div>

</body>
</html>
