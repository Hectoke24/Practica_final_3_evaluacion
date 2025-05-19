<?php
require_once("conexion.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"]);
    $clave = trim($_POST["password"]);

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
            $stmt = $conn->prepare("INSERT INTO usuarios (usuario, password) VALUES (?, ?)");
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registro</title>
</head>
<body>
    <h2>Crear nuevo usuario</h2>
    <?php if($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="post">
        Usuario: <input type="text" name="usuario" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
