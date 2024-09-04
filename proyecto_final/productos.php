<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Tu Tienda</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin: 0 10px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        main {
            flex: 1;
            padding: 2rem;
        }
        .producto-lista {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .producto {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 1rem;
            width: 300px;
            text-align: center;
            box-sizing: border-box;
        }
        .producto img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .producto h3 {
            margin: 0.5rem 0;
        }
        .producto p {
            margin: 0.5rem 0;
            font-size: 14px;
            color: #555;
        }
        .producto .btn-comprar {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
        }
        .producto .btn-comprar:hover {
            background-color: #218838;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1><a href="index.php" style="color: white; text-decoration: none;">FERRETERIA</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Lista de Productos</h2>
            <div class="producto-lista">
                <?php
                include('db_connect.php');

                $sql = "SELECT id, nombre, descripcion, precio, imagen FROM productos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='producto'>";
                        if ($row["imagen"]) {
                            echo "<img src='" . $row["imagen"] . "' alt='" . $row["nombre"] . "'>";
                        }
                        echo "<h3>" . $row["nombre"] . "</h3>";
                        echo "<p>" . $row["descripcion"] . "</p>";
                        echo "<p>Precio: $" . $row["precio"] . "</p>";
                        // Formulario para comprar el producto
                        echo "<form action='procesar_compra.php' method='post'>";
                        echo "<input type='hidden' name='producto_id' value='" . $row["id"] . "'>";
                        echo "<button type='submit' class='btn-comprar'>Comprar</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No hay productos disponibles.</p>";
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




