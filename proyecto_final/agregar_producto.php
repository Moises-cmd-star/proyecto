<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad']; // Agregado para cantidad
    $imagen = $_FILES['imagen'];

    // Ruta para subir la imagen
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen real
    $check = getimagesize($imagen["tmp_name"]);
    if ($check !== false) {
        // Subir el archivo
        if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
            // Insertar los datos del producto en la base de datos
            $sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$cantidad', '$target_file')";
            if ($conn->query($sql) === TRUE) {
                $success = "Producto agregado exitosamente.";
            } else {
                $error = "Error al guardar el producto: " . $conn->error;
            }
        } else {
            $error = "Error al subir la imagen.";
        }
    } else {
        $error = "El archivo no es una imagen.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Agregar Producto</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Nuevo Producto</h2>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
            <form action="agregar_producto.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" required></textarea>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" required>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" required>
                </div>
                <button type="submit" class="btn">Guardar Producto</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Tu Sitio Web</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>





