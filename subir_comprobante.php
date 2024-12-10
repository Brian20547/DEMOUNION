<?php 
session_start();
include './conexionpro.php';  // Conexión a la base de datos

// Verificar si la sesión tiene el código de factura y el factura_id
if (!isset($_SESSION['factura_id']) || !isset($_SESSION['total_factura'])) {
    echo "No se ha encontrado información de la factura.";
    exit;
}

// Obtener el ID de la factura desde la sesión
$factura_id = $_SESSION['factura_id'];  // Usamos el factura_id almacenado en la sesión
$monto = $_SESSION['total_factura'];   // Monto de la factura
$fecha_pago = date('Y-m-d H:i:s');     // Fecha y hora actual del pago
$metodo_pago_id = 1;                   // Método de pago, ajusta este valor si el valor es diferente
$descripcion_pago = $_POST['descripcion_pago'];  // Descripción proporcionada por la cliente

// Verificar si se ha subido un archivo
if (isset($_FILES['comprobante_pago']) && $_FILES['comprobante_pago']['error'] == 0) {
    $comprobante = $_FILES['comprobante_pago'];

    // Definir la ruta de destino para el archivo subido
    $ruta_destino = 'comprobantes/' . basename($comprobante['name']);

    // Verificar si la carpeta de destino existe, si no, crearla
    if (!is_dir('comprobantes')) {
        mkdir('comprobantes', 0777, true);
    }

    // Intentar mover el archivo subido a la carpeta destino
    if (move_uploaded_file($comprobante['tmp_name'], $ruta_destino)) {
        // Si el archivo se mueve correctamente, insertar los datos en la base de datos

        // Preparar la consulta para insertar el pago
        $sql = "INSERT INTO pagos (factura_id, monto, fecha_pago, metodo_pago_id, descripcion) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind de los parámetros
            mysqli_stmt_bind_param($stmt, "idsss", $factura_id, $monto, $fecha_pago, $metodo_pago_id, $descripcion_pago);

            // Ejecutar la consulta
            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='success-msg'>Comprobante de pago subido exitosamente y pago registrado en la base de datos.</div>";
            } else {
                echo "<div class='error-msg'>Error al registrar el pago en la base de datos: " . mysqli_error($con) . "</div>";
            }
        } else {
            echo "<div class='error-msg'>Error al preparar la consulta: " . mysqli_error($con) . "</div>";
        }
    } else {
        echo "<div class='error-msg'>Error al mover el archivo a la carpeta de destino.</div>";
    }
} else {
    echo "<div class='error-msg'>No se ha subido ningún archivo o el archivo tiene un error.</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pago</title>
    <link rel="stylesheet" href="styles.css">  <!-- Vincula tu archivo de estilos aquí -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1, h3 {
            text-align: center;
            color: #333;
        }

        .error-msg, .success-msg {
            padding: 20px;
            background-color: #ffdddd;
            color: #d8000c;
            border: 1px solid #d8000c;
            border-radius: 5px;
            margin-top: 20px;
        }

        .success-msg {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #155724;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* Estilo para el modal */
        .modal {
            display: block; /* Para abrir el modal al cargar la página */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Confirmación de Comprobante de Pago</h1>
    <h3>Gracias por su pago</h3>

    <!-- Mensajes de éxito o error -->
    <?php 
        if (isset($message)) {
            echo $message;
        }
    ?>

    <a href="pago.php" class="button">Regresar a Pago</a>
</div>

<!-- Modal para ingresar la ubicación -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Ingresa tu ubicación y lugar de envío</h3>
        
        <form method="POST" action="subirCofin.php">
            <div class="form-group">
                <label for="latitud">Latitud:</label>
                <input type="text" id="latitud" name="latitud" readonly>
            </div>

            <div class="form-group">
                <label for="longitud">Longitud:</label>
                <input type="text" id="longitud" name="longitud" readonly>
            </div>

            <div class="form-group">
                <label for="lugar_envio">Lugar de Envío:</label>
                <textarea id="lugar_envio" name="lugar_envio" rows="4" placeholder="Escribe el lugar de envío aquí..." required></textarea>
            </div>

            <button type="submit" class="button">Enviar Ubicación</button>
        </form>

        <div id="error-msg" class="error-msg" style="display:none;"></div>
    </div>
</div>

<script>
    // Función para obtener la ubicación del usuario
    function obtenerUbicacion() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                // Mostrar las coordenadas en los campos de latitud y longitud
                document.getElementById('latitud').value = position.coords.latitude;
                document.getElementById('longitud').value = position.coords.longitude;
            }, function(error) {
                // En caso de error, mostrar un mensaje
                document.getElementById('error-msg').style.display = 'block';
                document.getElementById('error-msg').innerText = 'No se pudo obtener la ubicación. Por favor, asegúrate de habilitar la geolocalización.';
            });
        } else {
            alert("Geolocalización no está soportada por tu navegador.");
        }
    }

    // Mostrar el modal al cargar la página
    window.onload = function() {
        obtenerUbicacion();
    };

    // Cerrar el modal cuando el usuario hace clic en la "X"
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        // No redirigir ni cerrar, solo dejarlo ahí
        modal.style.display = "none";
    }

    // Cerrar el modal si el usuario hace clic fuera de la ventana modal
    window.onclick = function(event) {
        if (event.target == modal) {
            // No redirigir ni cerrar, solo dejarlo ahí
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>
