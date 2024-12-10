<?php
session_start();
include './conexionpro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['codigo']) && isset($_POST['accion'])) {
        $codigo_factura = $_POST['codigo'];
        $accion = $_POST['accion'];

        // Escapar los valores para evitar inyecciones SQL
        $codigo_factura = mysqli_real_escape_string($con, $codigo_factura);
        $nuevo_estado = '';

        if ($accion === 'confirmar') {
            $nuevo_estado = 'Confirmada';
        } elseif ($accion === 'denegar') {
            $nuevo_estado = 'Denegada';
        } else {
            mostrarMensaje("Acción no válida.", "error");
            exit;
        }

        // Actualizar el estado de la factura en la base de datos
        $sql_update = "UPDATE facturas SET estado='$nuevo_estado' WHERE codigo='$codigo_factura'";
        if (mysqli_query($con, $sql_update)) {
            mostrarMensaje("Factura con código $codigo_factura ha sido $nuevo_estado.", "exito");
        } else {
            mostrarMensaje("Error al actualizar la factura: " . mysqli_error($con), "error");
        }
    } else {
        mostrarMensaje("Código de factura o acción no proporcionados.", "error");
    }
}

/**
 * Muestra un mensaje estilizado y un botón para regresar.
 *
 * @param string $mensaje El mensaje a mostrar.
 * @param string $tipo Puede ser "exito" o "error".
 */
function mostrarMensaje($mensaje, $tipo) {
    $color = $tipo === "exito" ? "#2dc653" : "#e63946"; // Verde para éxito, rojo para error.
    $botonColor = $tipo === "exito" ? "#005f73" : "#b00020"; // Botón azul oscuro o rojo.
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultado de Acción</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #121212;
                color: #ffffff;
                text-align: center;
                margin: 0;
                padding: 20px;
            }
            .mensaje {
                margin-top: 20px;
                padding: 20px;
                background-color: $color;
                border-radius: 8px;
                display: inline-block;
                color: white;
                font-size: 18px;
                max-width: 80%;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }
            .boton-volver {
                margin-top: 20px;
                background-color: $botonColor;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
            }
            .boton-volver:hover {
                background-color: #0a9396; /* Azul más claro */
            }
        </style>
    </head>
    <body>
        <div class="mensaje">
            $mensaje
        </div>
        <br>
        <a class="boton-volver" href="factura1.php">Volver</a>
    </body>
    </html>
    HTML;
}
?>
