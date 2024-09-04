<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - FERRETERIA</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            padding-bottom: 60px; /* Espacio suficiente para el footer */
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
        }

        header h1 {
            margin: 0;
        }

        header h1 a {
            color: #fff;
            text-decoration: none;
        }

        main {
            padding: 20px;
            max-width: 800px;
            margin: 60px auto 0; /* Ajusta el margen superior para que no quede detrás del header */
        }

        .contacto {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contacto h2 {
            margin-top: 0;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .contact-form textarea {
            resize: vertical;
            height: 150px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <main>
        <section class="contacto">
            <h2>Contacto</h2>
            <form action="enviar_mensaje.php" method="post" class="contact-form">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" required></textarea>
                </div>
                <button type="submit" class="btn">Enviar</button>
            </form>
        </section>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>



