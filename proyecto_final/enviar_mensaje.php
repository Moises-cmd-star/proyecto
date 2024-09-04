<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Configuración del correo electrónico
    $to = "tu-email@dominio.com";  // Cambia esto a tu dirección de correo electrónico
    $subject = "Nuevo mensaje de contacto";
    $body = "Nombre: $nombre\nEmail: $email\nMensaje: $mensaje";

    // Enviar el correo
    if (mail($to, $subject, $body)) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Error al enviar el mensaje.";
    }
} else {
    echo "Método no permitido.";
}
?>
