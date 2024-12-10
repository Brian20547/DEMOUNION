<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Carrito de Compras</title>
    <script type="text/javascript" src="./js/scripts0.js"></script>
    <style>
        /* Estilos Generales */
        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Encabezado */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 20px;
            background-color: #0055a5;
            color: white;
        }

        .header h1 {
            margin: 0;
        }

        .back-button {
            background-color: #ffffff;
            color: #0055a5;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #e2e6e9;
        }

        .cart-icon img {
            width: 40px;
            height: auto;
        }

        /* Detalles del Producto */
        .product-details {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
        }

        .product-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .product-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .product-name {
            font-size: 24px;
            color: #0055a5;
            margin: 15px 0 10px;
        }

        .product-price {
            font-size: 20px;
            color: #333;
            font-weight: bold;
        }

        .product-description {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }

        /* Botones de Acción */
        .action-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .btn {
            text-decoration: none;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .catalog-button {
            background-color: #0077cc;
        }

        .catalog-button:hover {
            background-color: #0055a5;
        }

        .add-to-cart-button {
            background-color: #28a745;
        }

        .add-to-cart-button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <header class="header">
        <button class="back-button" onclick="location.href='./pag_user_compras.php'">Volver</button>
        <h1>Detalles del Producto</h1>
        <a href="./carritodecompras.php" title="Ver carrito de compras" class="cart-icon">
            <img src="./imagenes/carrito.png" alt="Carrito">
        </a>
    </header>

    <section class="product-details">
        <?php
            include 'conexionpro.php';
            $id = $_GET['id'];
            $resultado = mysqli_query($con, "SELECT * FROM productos WHERE id=" . $id) or die(mysqli_error($con));
            while ($f = mysqli_fetch_array($resultado)) {
        ?>
            <div class="product-card">
                <img src="./productos/<?php echo $f['imagen']; ?>" alt="Imagen del Producto" class="product-image">
                <h1 class="product-name"><?php echo $f['nombre']; ?></h1>
                <p class="product-price">Precio: $<?php echo $f['precio']; ?></p>
                <p class="product-description">Descripción: <?php echo $f['descripcion']; ?></p>
                <div class="action-buttons">
                    <a href="./pag_user_compras.php" class="btn catalog-button">Volver al Catálogo</a>
                    <a href="./carritodecompras.php?id=<?php echo $f['id'] ?>" class="btn add-to-cart-button">Añadir al carrito</a>
                </div>
            </div>
        <?php
            }
        ?>
    </section>
</body>
</html>
