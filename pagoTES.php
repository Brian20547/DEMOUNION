<?php
session_start();
include './conexionpro.php';  // Conexión a la base de datos

// Verificar si el usuario tiene la información de factura.
if (!isset($_SESSION['factura_id']) || !isset($_SESSION['total_factura'])) {
    echo "No se ha encontrado información de la factura.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario de ubicación
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $lugar_envio = $_POST['lugar_envio'];

    // Guardar la ubicación y lugar de envío en la base de datos
    $sql = "INSERT INTO ubicaciones_envio (factura_id, latitud, longitud, lugar_envio) VALUES (?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, "idss", $_SESSION['factura_id'], $latitud, $longitud, $lugar_envio);
        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='success-msg'>Ubicación de envío guardada con éxito. Redirigiendo a la página de pago...</div>";
            header("Refresh: 3; url=pago.php"); // Redirige después de 3 segundos
        } else {
            echo "<div class='error-msg'>Error al guardar la ubicación: " . mysqli_error($con) . "</div>";
        }
    } else {
        echo "<div class='error-msg'>Error al preparar la consulta: " . mysqli_error($con) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 70%;
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
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            margin-top: 5px;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .success-msg, .error-msg {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .success-msg {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #155724;
        }
        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Estilo para el modal */
        .modal {
            display: none;
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
    <h1>Proceso de Pago de Factura</h1>
    <p>Por favor, proporciona tu ubicación para continuar con el proceso de pago.</p>

    <!-- Botón para abrir el modal -->
    <button class="button" id="myBtn">Proveer Ubicación</button>
    
    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Ingresa tu ubicación y lugar de envío</h3>
            
            <form method="POST" action="pago.php">
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
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }

    // Cerrar el modal cuando se haga clic en la 'X'
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

    // Cerrar el modal si se hace clic fuera de él
    window.onclick = function(event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>