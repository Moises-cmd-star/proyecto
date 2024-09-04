<?php
session_start();
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Cambia los nombres de las columnas según tu estructura de base de datos
    $sql = "SELECT * FROM usuarios WHERE username = '$usuario' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario autenticado exitosamente
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Tu Tienda</title>
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

        .register {
            text-align: center;
            margin-top: 20px;
        }

        .register a {
            color: #007bff;
            text-decoration: none;
        }

        .register a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Iniciar Sesión</button>
            <div class="register">
                <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
            </div>
        </form>
    </div>
</body>
</html>




