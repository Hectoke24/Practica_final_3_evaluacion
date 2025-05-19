<?php
// login.php
session_start();

// Conexión a base de datos (ejemplo usando MySQLi)
$host = "localhost";
$user = "root";
$password = "";
$database = "tienda_zapatillas";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del POST
$usuario = trim($_POST['usuario']);
$clave = trim($_POST['password']);

// Validación de campos vacíos
if (empty($usuario) || empty($clave)) {
    echo "Por favor completa todos los campos.";
    exit();
}

// Buscar el usuario en la base de datos
$sql = "SELECT * FROM usuarios WHERE usuario = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $clave);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $_SESSION['usuario'] = $usuario;
    header("Location: tienda.php"); // Página principal de la tienda
} else {
    echo "Usuario o contraseña incorrectos.";
}

$stmt->close();
$conn->close();
?>
