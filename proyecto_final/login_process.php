<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultar el usuario en la base de datos
    $sql = "SELECT password FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verificar la contraseña
    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Redirige al inicio después del inicio de sesión
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    $stmt->close();
    $conn->close();
}
?>
