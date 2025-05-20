<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST["nombre"]);
    $email = htmlspecialchars($_POST["email"]);
    $mensaje = htmlspecialchars($_POST["mensaje"]);

    // Aquí podrías guardar en la base de datos o enviar por correo (solo mostramos el mensaje por ahora)
    echo "<h2>Gracias por contactarnos, $nombre</h2>";
    echo "<p><strong>Correo:</strong> $email</p>";
    echo "<p><strong>Mensaje:</strong><br>" . nl2br($mensaje) . "</p>";
} else {
    echo "Acceso no permitido.";
}
?>
