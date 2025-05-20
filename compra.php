<?php
// compra.php
if (!isset($_GET['id'])) {
    echo "Producto no especificado.";
    exit;
}

$idProducto = intval($_GET['id']); // Sanitiza el ID recibido

// Aquí conectarías a la base de datos para buscar detalles del producto
require_once("conexion.php");

$sql = "SELECT * FROM productos WHERE id = $idProducto";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Producto no encontrado.";
    exit;
}

$producto = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra - <?php echo htmlspecialchars($producto['nombre']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Compra: <?php echo htmlspecialchars($producto['nombre']); ?></h2>
    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" style="max-width: 300px;">
    <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
    <p><strong>Precio: €<?php echo number_format($producto['precio'], 2); ?></strong></p>

    <!-- Aquí podrías poner un formulario para confirmar la compra -->
    <form action="procesar_compra.php" method="post">
        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
        <button type="submit" class="btn btn-success">Confirmar compra</button>
    </form>

    <a href="tienda.php" class="btn btn-secondary mt-3">Volver a la tienda</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
