<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ferreteria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el nombre de usuario desde la sesión
$usuario_nombre = $_SESSION['usuario'];

// Buscar el ID del usuario en la tabla de usuarios usando la columna 'username'
$sql = "SELECT id FROM usuarios WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario_nombre);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    $usuario_id = $usuario['id'];
} else {
    echo "Usuario no encontrado.";
    exit();
}

// Verificar si se ha enviado el formulario con el producto_id
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    // Obtener los detalles del producto
    $sql = "SELECT * FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();

        // Verificar si hay suficiente cantidad del producto
        if ($producto['cantidad'] > 0) {
            // Reducir la cantidad del producto en la base de datos
            $nueva_cantidad = $producto['cantidad'] - 1;
            $sql = "UPDATE productos SET cantidad = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $nueva_cantidad, $producto_id);
            if ($stmt->execute()) {
                // Registrar la compra en la tabla de compras
                $sql = "INSERT INTO compras (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $cantidad = 1; // La cantidad siempre es 1 en este caso
                $stmt->bind_param("iii", $usuario_id, $producto_id, $cantidad);
                if ($stmt->execute()) {
                    // Redirigir al usuario a una página de confirmación
                    header("Location: confirmacion.php");
                    exit();
                } else {
                    echo "Error al registrar la compra: " . $stmt->error;
                }
            } else {
                echo "Error al actualizar la cantidad: " . $stmt->error;
            }
        } else {
            echo "No hay suficiente cantidad del producto.";
        }
    } else {
        echo "Producto no encontrado.";
    }

    $stmt->close();
} else {
    echo "Solicitud no válida.";
}

$conn->close();
?>










