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
    <title>H-KICKS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .imagen-producto {
            height: 100px;
            object-fit: contain;
            width: 100%;
        }


        .btn {
            display: inline-block !important;
            background-color: #0d6efd !important;
            color: white !important;
            padding: 0.375rem 0.75rem !important;
            border-radius: 0.375rem !important;
            text-align: center !important;
            text-decoration: none !important;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-4">
        <h2 class="mb-4">Bienvenido, <?php echo $_SESSION['usuario']; ?> 👟</h2>

        <div class="row">
            <?php
            $sql = "SELECT * FROM productos";
            $result = $conn->query($sql);

            while ($producto = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4 mb-4 d-flex">
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

    <!-- Bootstrap JS para menú responsive -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>