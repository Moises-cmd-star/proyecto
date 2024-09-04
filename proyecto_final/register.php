<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {
        // Cambia los nombres de las columnas según tu estructura de base de datos
        $sql = "INSERT INTO usuarios (username, password) VALUES ('$usuario', '$password')";
        if ($conn->query($sql) === TRUE) {
            header('Location: login.php');
            exit();
        } else {
            $error = "Error al registrar: " . $conn->error;
        }
    } else {
        $error = "Las contraseñas no coinciden.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Tu Tienda</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .container h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            display: block;
            width: 100%;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .login {
            text-align: center;
            margin-top: 20px;
        }

        .login a {
            color: #007bff;
            text-decoration: none;
        }

        .login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirmar Contraseña:</label>
                <input type="password" id="password_confirm" name="password_confirm" required>
            </div>
            <button type="submit" class="btn">Registrarse</button>
            <div class="login">
                <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </div>
        </form>
    </div>
</body>
</html>


