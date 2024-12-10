<?php 
session_start();
include './conexionpro.php';

// Comprobamos si existe la variable de sesión
if (isset($_SESSION['carrito'])) {
    // Si se recibe un id para eliminar
    if (isset($_GET['id']) && isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {
        $arreglo = $_SESSION['carrito'];
        for ($i = 0; $i < count($arreglo); $i++) { 
            if ($arreglo[$i]['id'] == $_GET['id']) {
                unset($arreglo[$i]);
                $arreglo = array_values($arreglo);
                $_SESSION['carrito'] = $arreglo;
                break;
            }
        }
    }
    // Si se recibe un id para agregar
    else if (isset($_GET['id'])) {
        $arreglo = $_SESSION['carrito'];
        $encontro = false;     
        $numero = 0;

        // Recorremos el arreglo buscando si el producto ya estaba en el carrito
        for ($i = 0; $i < count($arreglo); $i++) { 
            if ($arreglo[$i]['id'] == $_GET['id']) {
                $encontro = true;
                $numero = $i;
            }
        }

        // Si el producto ya estaba en el carrito, incrementamos la cantidad
        if ($encontro) {
            $arreglo[$numero]['cantidad']++;
            $_SESSION['carrito'] = $arreglo;
        }
        // Si no estaba, lo ponemos en la sesión
        else {
            $nombre = "";
            $precio = 0;
            $imagen = "";
            $resultado = mysqli_query($con, "SELECT * FROM productos WHERE id =" . $_GET['id']);
            // Guardamos algunos datos del producto en variables
            while ($resulset = mysqli_fetch_array($resultado)) {
                $nombre = $resulset['nombre'];
                $precio = $resulset['precio'];
                $imagen = $resulset['imagen'];
            }
            $nuevoproducto = array(
                'id' => $_GET['id'],
                'nombre' => $nombre,
                'precio' => $precio,
                'imagen' => $imagen,
                'cantidad' => 1
            );
            array_push($arreglo, $nuevoproducto);
            $_SESSION['carrito'] = $arreglo;
        }
    }
} else {
    // Si no existe, comprobamos que recibimos un producto
    if (isset($_GET['id'])) {
        $nombre = "";
        $precio = 0;
        $imagen = "";
        $resultado = mysqli_query($con, "SELECT * FROM productos WHERE id =" . $_GET['id']);
        // Guardamos algunos datos del producto en variables
        while ($resulset = mysqli_fetch_array($resultado)) {
            $nombre = $resulset['nombre'];
            $precio = $resulset['precio'];
            $imagen = $resulset['imagen'];
        }
        $arreglo[] = array('id' => $_GET['id'],
                        'nombre' => $nombre,
                        'precio' => $precio,
                        'imagen' => $imagen,
                        'cantidad' => 1);
        $_SESSION['carrito'] = $arreglo;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 20px;
        }

        /* Estilo para el contenedor del carrito */
        section {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        /* Estilos para productos */
        .producto {
            display: inline-block;
            width: 250px;
            margin: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            transition: box-shadow 0.3s;
            background-color: #f9f9f9;
        }

        .producto:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        /* Estilo de las imágenes */
        .producto img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Estilo general de texto */
        .producto span {
            display: block;
            margin: 10px 0;
        }

        /* Estilos para botones y enlaces */
        .btn-pagar, .eliminar-producto {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 10px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-pagar:hover, .eliminar-producto:hover {
            background-color: #0056b3;
        }

        /* Estilos para el total */
        #total {
            font-size: 20px;
            font-weight: bold;
            color: #28a745;
            margin-top: 20px;
        }

        /* Estilo de los inputs */
        .cantidad {
            width: 50px;
            text-align: center;
            border: 1px solid #007bff;
            border-radius: 5px;
            padding: 5px;
        }
    </style>
</head>
<body>

<section>
    <?php  
        $total = 0;

        if (isset($_SESSION['carrito'])) {
            $total = 0;
            $datos = $_SESSION['carrito'];
            
            for ($i = 0; $i < count($datos); $i++) { 
    ?>     
            <div class="producto">
                <center>
                    <img src="./productos/<?php echo($datos[$i]['imagen']) ?>" alt="<?php echo($datos[$i]['nombre']) ?>"><br>
                    <span><?php echo($datos[$i]['nombre']) ?></span><br>
                    <span>Precio: $<?php echo($datos[$i]['precio']) ?></span><br>
                    <span>Cantidad:
                        <input type="number" value="<?php echo($datos[$i]['cantidad']) ?>" size='3' data-precio="<?php echo($datos[$i]['precio']) ?>" data-id="<?php echo($datos[$i]['id']) ?>" class="cantidad">
                    </span><br>
                    <span class="subtotal">Total Producto: $<span class="subtotal-valor"><?php echo($datos[$i]['cantidad'] * $datos[$i]['precio']) ?></span></span>
                    <br>
                    <a href="?id=<?php echo($datos[$i]['id']); ?>&accion=eliminar" class="eliminar-producto">Eliminar</a>
                </center>
            </div>    
    <?php    
            $total += $datos[$i]['precio'] * $datos[$i]['cantidad'];    
            }
        } else {
            echo "<center><h2>El Carrito de Compras está vacío</h2></center>";
        }
        echo "<center><h2 id='total'>Total Compra: $" . $total . "</h2></center><br>";


        // Verifica si el carrito tiene productos
if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    // Si el carrito tiene productos, permitir la descarga
} else {
    // Si el carrito está vacío, mostrar una notificación
    echo '<script>alert("No puedes descargar la verificación en PDF si no tienes productos en el carrito.");</script>';
}
    ?>    

    <center><a href="Verificacion.php" class="btn-pagar" target="_blank">Descargar Verificacion en PDF</a></center>

    <?php if ($total > 0) { ?>
        <center><a href="pago.php" class="btn-pagar">Proceder al Pago</a></center>
    <?php } ?>
    <center><a href="pag_user_compras.php" class="btn-pagar">Volver al catálogo</a></center>


</section>

<script>
document.querySelectorAll('.cantidad').forEach(input => {
    input.addEventListener('change', function() {
        const id = this.getAttribute('data-id');
        const cantidad = parseInt(this.value);
        const precio = parseFloat(this.getAttribute('data-precio'));
        
        // Validar que la cantidad sea un número y mayor a 0
        if (isNaN(cantidad) || cantidad < 1) {
            alert('Por favor, introduce una cantidad válida.');
            this.value = 1; // Restablecer a 1 si la cantidad es inválida
            return;
        }

        // Actualizar el subtotal en la interfaz
        const subtotal = cantidad * precio;
        this.closest('.producto').querySelector('.subtotal-valor').textContent = subtotal.toFixed(2);

        // Actualizar el total general
        let total = 0;
        document.querySelectorAll('.subtotal-valor').forEach(subtotalElem => {
            total += parseFloat(subtotalElem.textContent);
        });
        document.getElementById('total').textContent = 'Total Compra: $' + total.toFixed(2);

        // Enviar la nueva cantidad al servidor
        fetch(`actualizar_cantidad.php?id=${id}&cantidad=${cantidad}`)
            .then(response => response.text())
            .then(data => {
                console.log(data); // Manejar respuesta si es necesario
            })
            .catch(error => console.error('Error:', error));
    });
});
</script>

</body>
</html>