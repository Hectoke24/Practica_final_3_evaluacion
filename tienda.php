<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

require_once("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tienda de Zapatillas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .imagen-producto {
            height: 200px;
            object-fit: contain;
            width: 100%;
        }
    </style>

</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Bienvenido, <?php echo $_SESSION['usuario']; ?> 👟</h2>
        <a href="logout.php" class="btn btn-danger mb-4">Cerrar sesión</a>

        <div class="row">
            <?php
            $sql = "SELECT * FROM productos";
            $result = $conn->query($sql);

            while ($producto = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow d-flex flex-column">
                        <!-- Imagen del producto -->
                        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" class="card-img-top imagen-producto"
                            alt="<?php echo htmlspecialchars($producto['nombre']); ?>">

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                            </div>
                            <div class="mt-auto">
                                <p class="card-text">Referencia: <?php echo $producto['referencia']; ?></p>
                                <p class="card-text">Precio:
                                    <strong>€<?php echo number_format($producto['precio'], 2); ?></strong>
                                </p>
                                <a href="#" class="btn btn-primary w-100">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</body>

</html>