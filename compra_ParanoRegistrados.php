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
            const isRegistered = false; // Cambia a true si el usuario está registrado

            if (!isRegistered) {
                alert("Tienes que ser registrado o estar logiado para ver este contenido.");
                window.location.href = "./registro.html"; // URL de tu página de registro
            } else {
                const productUrl = event.target.getAttribute('href');
                window.location.href = productUrl;
            }
        }

        function showAlert() {
            alert("No tienes productos añadidos.");
            // Aquí puedes redirigir al usuario si deseas
            // window.location.href = "./index.html"; // Ejemplo de redirección
        }
    </script>
</head>
<body>

<header>
    <button onclick="location.href='./index.html'">Volver</button>
    <h1>Carrito De Compras</h1>
    <a href="#" onclick="showAlert()" title="Ver carrito de compra"> 
        <img src="./imagenes/carrito.png" alt="Carrito de Compras" style="float:right; width: 50px; height: 50px;"> 
    </a>
</header>

<section>
    <?php
    include 'conexionpro.php';
    // seleccionamos a todos los registros de la base
    $resultado = mysqli_query($con, "SELECT * FROM productos") or die(mysqli_error($con));

    while ($f = mysqli_fetch_array($resultado)) {
    ?>
        <div class="producto">
            <center>
                <!-- mostramos cada registro -->
                <img src="./productos/<?php echo $f['imagen']; ?>"><br>
                <span><?php echo $f['nombre']; ?></span><br>
                <!-- Llamamos a la función checkRegistration cuando se hace clic en "ver" -->
                <a href="./detalles.php?id=<?php echo $f['id']; ?>" onclick="checkRegistration(event)">ver</a>
            </center>
        </div>
    <?php
    }
    ?>
</section>
</body>
</html>