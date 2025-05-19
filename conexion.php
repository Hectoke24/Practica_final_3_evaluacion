<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; // Sin contraseña por defecto
$base_de_datos = "tienda_virtual";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// establecer codificación
$conn->set_charset("utf8");
?>
