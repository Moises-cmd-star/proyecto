<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar que las contraseñas coincidan
    if ($password != $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Cifrar la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
