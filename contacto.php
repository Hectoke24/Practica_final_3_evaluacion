<?php
// 1. Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "tu_base_de_datos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 2. Consulta a la tabla de contactos (ajusta el nombre según tu base)
$sql = "SELECT nombre, email, mensaje FROM contactos";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="padding-top: 80px;"> <!-- espacio para navbar fijo -->

<?php include("menu.html"); ?> <!-- Si usas menú separado -->

<div class="container mt-4">
    <h2>Mensajes de Contacto</h2>

    <!-- Botón para volver a tienda.html -->
    <a href="tienda.html" class="btn btn-secondary mb-3">Volver a Inicio</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['mensaje']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay mensajes.</td></tr>";
            }
            $conexion->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
