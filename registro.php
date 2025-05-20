<?php
require_once("conexion.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"]);
    $clave = trim($_POST["contrasena"]);

    // Validar usuario y contraseña mínimos (ejemplo)
    if (strlen($usuario) < 3 || strlen($clave) < 6) {
        $message = "Usuario debe tener al menos 3 caracteres y contraseña al menos 6.";
    } else {
        $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $message = "El usuario ya existe.";
        } else {
            $stmt = $conn->prepare(query: "INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)");
            $stmt->bind_param("ss", $usuario, $clave_encriptada);
            if ($stmt->execute()) {
                $message = "Usuario registrado correctamente.";
            } else {
                $message = "Error al registrar usuario.";
            }
        }

        $stmt->close();
    }

    $conn->close();
}
?>