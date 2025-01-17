<?php
session_start();
include './conexionpro.php';  // Conexión a la base de datos

$error_msg = "";
$estado_factura = "";  // Estado de la factura

// Limpiar las variables de sesión al recargar la página si no se ha verificado la factura
if (!isset($_SESSION['codigo_factura'])) {
    unset($_SESSION['codigo_factura']);
    unset($_SESSION['total_factura']);
    unset($_SESSION['factura_id']);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if 'codigo_factura' is set in $_POST
    if (isset($_POST['codigo_factura']) && !empty($_POST['codigo_factura'])) {
        // Recoger el código de la factura ingresado
        $codigo_factura = $_POST['codigo_factura'];

        // Consultar la base de datos para obtener el monto de la factura, el estado y el factura_id
        $sql = "SELECT * FROM facturas WHERE codigo = ?";
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $codigo_factura);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                // Factura encontrada
                $factura = mysqli_fetch_assoc($result);
                $factura_id = $factura['id'];  // Obtener el ID de la factura
                $total_factura = $factura['total'];
                $estado_factura = $factura['estado'];  // Obtener el estado de la factura
                
                // Guardar el ID de la factura y el total en la sesión
                $_SESSION['factura_id'] = $factura_id; // Guardar el ID de la factura
                $_SESSION['codigo_factura'] = $codigo_factura;  
                $_SESSION['total_factura'] = $total_factura;    
            } else {
                $error_msg = "Factura no encontrada o el código es incorrecto.";
            }
        } else {
            $error_msg = "Error al preparar la consulta.";
        }
    } else {
        $error_msg = "Por favor ingrese el código de la factura.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pago</title>
    <link rel="stylesheet" href="pago.css">  <!-- Vinculando el archivo CSS -->
    <!-- Agregar Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilo para los botones en la esquina inferior izquierda */
        .payment-buttons {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
        }

        .payment-buttons a {
            display: block;
            margin-bottom: 10px;
            font-size: 32px;  /* Tamaño de los íconos */
            color: #fff;
            padding: 15px;
            border-radius: 50%;
            background-color: #333;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .payment-buttons a:hover {
            transform: scale(1.1);
        }

        .whatsapp-icon {
            background-color: #25D366;  /* Verde de WhatsApp */
        }

        .paypal-icon {
            background-color: #0070ba;  /* Azul de PayPal */
        }

        .binance-icon {
            background-color: #F0B90B;  /* Amarillo de Binance */
        }
    </style>
</head>
<body>



<header>
    <h1>Proceso de Pago de Factura</h1>
</header>

<div class="container">
    <h3>Ingrese el código de su factura</h3>
    
    <!-- Formulario para ingresar el código de la factura -->
    <form action="pago.php" method="POST">
        <div class="form-group">
            <label for="codigo_factura">Código de Factura:</label>
            <input type="text" id="codigo_factura" name="codigo_factura" required>
        </div>
        <button type="submit">Verificar Factura</button>
    </form>

    <!-- Mostrar mensajes de error si no se encuentra la factura -->
    <?php if (!empty($error_msg)): ?>
        <div class="error-msg">
            <?php echo $error_msg; ?>
        </div>
    <?php endif; ?>

    <!-- Mostrar detalles de la factura si se encontró -->
    <?php if (isset($_SESSION['total_factura'])): ?>
        <div class="success-msg">
            <h3>Factura Verificada</h3>
            <p><strong>Código de Factura:</strong> <?php echo $_SESSION['codigo_factura']; ?></p>
            <p><strong>Total a Pagar:</strong> $<?php echo $_SESSION['total_factura']; ?></p>

            <div class="estado-factura">
                <strong>Estado de la factura:</strong>
                <?php
                    if ($estado_factura == 'pendiente') {
                        echo "<span class='estado-pendiente'>Pendiente</span>";
                    } elseif ($estado_factura == 'confirmado') {
                        echo "<span class='estado-confirmado'>Confirmado</span>";
                    } elseif ($estado_factura == 'pagada') {
                        echo "<span class='estado-pagada'>Pagada</span>";
                    } elseif ($estado_factura == 'cancelada') {
                        echo "<span class='estado-cancelada'>Cancelada</span>";
                    } else {
                        echo "<span style='color: gray;'>Estado desconocido</span>";
                    }
                ?>
            </div>

            <!-- Mostrar solo cuando la factura esté pendiente -->
            <?php if ($estado_factura == 'pendiente'): ?>
                <h4>Por favor, realiza el pago utilizando los siguientes métodos:</h4>
                <ul>
                    <li><strong>Pago Móvil:</strong> 0412-1234567 (CI-31042921)</li>
                    <li><strong>Transferencia Bancaria:</strong> Banco XYZ - Cuenta 123456789 (Juan perez)</li>
                </ul>
                <p>Una vez realizado el pago, por favor sube el comprobante de pago a nuestro sistema para confirmar la transacción.</p>

                <!-- Formulario para subir el comprobante de pago con descripción -->
                <form action="subir_comprobante.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="comprobante_pago">Subir comprobante de pago:</label>
                        <input type="file" id="comprobante_pago" name="comprobante_pago" required>
                    </div>

                    <!-- Campo para la descripción del pago -->
                    <div class="form-group">
                        <label for="descripcion_pago">Descripción del Pago:</label>
                        <textarea id="descripcion_pago" name="descripcion_pago" rows="4" placeholder="Escriba una descripción sobre el pago..." required></textarea>
                    </div>

                    <button type="submit">Subir Comprobante</button>
                </form>
            <?php elseif ($estado_factura == 'confirmado'): ?>
                <p><strong>La factura está confirmada. No es necesario realizar más acciones.</strong></p>
            <?php elseif ($estado_factura == 'pagada'): ?>
                <p><strong>Esta factura ya ha sido pagada. No se necesita realizar ningún pago.</strong></p>
            <?php elseif ($estado_factura == 'cancelada'): ?>
                <p><strong>Esta factura ha sido cancelada y no puede ser pagada.</strong></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Botones de pago en la esquina inferior izquierda -->
<div class="payment-buttons">
    <!-- Botón de PayPal -->
    <a href="https://www.paypal.com/paypalme/yourpaypalaccount" target="_blank" class="paypal-icon">
        <i class="fab fa-paypal"></i>
    </a>
    <!-- Enlace a WhatsApp -->
<a href="https://wa.me/04121234567" target="_blank" class="whatsapp-icon">
    <i class="fab fa-whatsapp"></i>
</a>
    <!-- Botón de Binance -->
    <a href="https://www.binance.com/en" target="_blank" class="binance-icon">
        <i class="fab fa-btc"></i>
    </a>
</div>

</body>
</html>
