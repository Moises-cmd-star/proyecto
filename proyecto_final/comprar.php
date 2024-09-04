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

// Obtener el ID del producto desde la URL
$id = $_GET['id'];

$sql = "SELECT * FROM productos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
} else {
    echo "Producto no encontrado.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar - <?php echo htmlspecialchars($producto['nombre']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1><a href="index.php">FERRETERIA</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="producto-detalle">
            <h2><?php echo htmlspecialchars($producto['nombre']); ?></h2>
            <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
            <p>Precio: $<?php echo htmlspecialchars($producto['precio']); ?></p>
            <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
            <form action="procesar_compra.php" method="post">
                <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                <button type="submit" class="btn">Confirmar Compra</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Tu Tienda. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
