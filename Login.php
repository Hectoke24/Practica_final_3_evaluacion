<?php
echo "DEBUG: login.php versión actual"; exit();
session_start();
require_once("conexion.php");

// Obtener datos del POST
$usuario = trim($_POST['usuario']);
$clave = trim($_POST['password']);

// Validar campos vacíos
if (empty($usuario) || empty($clave)) {
    echo "Por favor completa todos los campos.";
    exit();
}

// Buscar el usuario en la base de datos (solo por nombre de usuario)
$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $fila = $result->fetch_assoc();

    // Verificar contraseña encriptada
    if (password_verify($clave, $fila['contrasena'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: tienda.php"); // Página principal de la tienda
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}

$stmt->close();
$conn->close();
?>
