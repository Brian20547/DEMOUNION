<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Carrito de Compras</title>
    <link rel="stylesheet" type="text/css" href="./css/compra.css">
    <script type="text/javascript" src="./js/scripts0.js"></script>
    <script>
        function checkRegistration(event) {
            event.preventDefault();
            const productUrl = event.target.getAttribute('href');
            window.location.href = productUrl;
        }
    </script>
</head>
<body>

<header>
    <button onclick="location.href='./pag_user.php'">Volver</button>
    <h1>Carrito De Compras</h1>
    <a href="./carritodecompras.php" title="Ver carrito de compra"> 
        <img src="./imagenes/carrito.png" alt="Carrito de Compras" style="float:right; width: 50px; height: 50px;"> 
    </a>
    
    <!-- Formulario de Búsqueda centrado -->
    <form method="GET" action="" style="display: flex; flex-direction: column; align-items: center; margin-top: 5px;">
        <div style="display: flex; align-items: center; border: 1px solid #ccc; border-radius: 5px; padding: 5px;">
            <input type="text" name="busqueda" placeholder="Buscar producto..." style="padding: 5px; width: 300px; border: none; outline: none;">
        </div>
        <!-- Mensaje debajo de la barra de búsqueda -->
        <p style="font-size: 12px; color: gray; margin-top: 5px;">Presiona Enter para buscar</p>
    </form>
</header>

<section>
    <?php
    include 'conexionpro.php';

    // Verificar si se ha enviado un término de búsqueda
    $busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($con, $_GET['busqueda']) : '';

    // Consultar productos, filtrando si hay una búsqueda
    if ($busqueda) {
        $query = "SELECT * FROM productos WHERE nombre LIKE '%$busqueda%'";
    } else {
        $query = "SELECT * FROM productos";
    }

    $resultado = mysqli_query($con, $query) or die(mysqli_error($con));

    // Mostrar productos encontrados
    while ($f = mysqli_fetch_array($resultado)) {
    ?>
        <div class="producto">
            <center>
                <img src="./productos/<?php echo $f['imagen']; ?>" alt="<?php echo $f['nombre']; ?>"><br>
                <span><?php echo $f['nombre']; ?></span><br>
                <span>Stock: <?php echo $f['stock']; ?></span><br> <!-- Mostrar el stock -->
                <a href="./detalles.php?id=<?php echo $f['id']; ?>" onclick="checkRegistration(event)">Ver</a>
            </center>
        </div>
    <?php
    }

    // Si no se encuentran productos, mostrar un mensaje
    if (mysqli_num_rows($resultado) == 0) {
        echo "<p style='text-align: center;'>No se encontraron productos para '$busqueda'.</p>";
    }
    ?>
</section>

</body>
</html>
