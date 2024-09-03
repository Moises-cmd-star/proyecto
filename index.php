<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Tu Tienda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1><a href="index.php">FERRETERIA</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li><a href="productos.php">Productos</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="login.php">Iniciar Sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="bienvenida">
            <h1>Bienvenido a Nuestra Tienda</h1>
            <p>Explora nuestros productos y servicios. Inicia sesión para realizar compras.</p>
        </section>

        <section class="productos">
            <h2>Productos Destacados</h2>
            <div class="producto-lista">
                <?php
                // Conectar a la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ferreteria";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM productos LIMIT 6";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="producto">';
                        echo '<img src="' . $row["imagen"] . '" alt="' . $row["nombre"] . '">';
                        echo '<h3>' . $row["nombre"] . '</h3>';
                        echo '<p>Precio: $' . $row["precio"] . '</p>';
                        echo '<form action="procesar_compra.php" method="POST">';
                        echo '<input type="hidden" name="producto_id" value="' . $row["id"] . '">';
                        echo '<button type="submit" class="btn">Comprar</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No hay productos disponibles.</p>';
                }

                $conn->close();
                ?>
            </div>
        </section>

    </main>

    <footer>
        <p>&copy; 2024 Tu Tienda. Todos los derechos reservados.</p>
    </footer>
</body>
</html>



