<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ferreteria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = htmlspecialchars($_POST['username']);
    $pass = htmlspecialchars($_POST['password']);
    
    $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['usuario'] = $user;
        header('Location: productos.php');
    } else {
        echo "Usuario o contraseña incorrectos.";
    }

    $stmt->close();
}
$conn->close();
?>
