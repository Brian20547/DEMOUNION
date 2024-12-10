<?php
session_start();
include './conexionpro.php';

$codigo_factura = null;
$factura = null; // Variable para almacenar la información de la factura

if (isset($_GET['codigo'])) {
    $codigo_factura = $_GET['codigo'];

    // Obtener todos los datos de la factura con el código proporcionado
    $sql = "SELECT * FROM facturas WHERE codigo='$codigo_factura'";
    $result = mysqli_query($con, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $factura = mysqli_fetch_assoc($result); // Almacenar la información de la factura
    } else {
        $mensaje_error = 'Factura no encontrada.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Factura</title>
    <style>
        body {
            background-color: #0d1b2a; /* Color azul oscuro */
            color: #fff; /* Texto blanco */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            padding: 20px;
            color: #fff;
        }
        p {
            font-size: 18px;
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
            font-size: 16px;
            margin: 20px auto;
            max-width: 600px;
            text-align: left;
        }
        li {
            padding: 8px;
            background-color: #2a3d56;
            border-radius: 5px;
            margin: 5px 0;
        }
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 30px;
        }
        button {
            padding: 10px 20px;
            margin: 10px;
            background-color: #0066cc; /* Azul más claro */
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #004d99;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #00bfff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            color: #ff3333;
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Confirmar Factura</h1>
    
    <?php if ($codigo_factura !== null): ?>
        <p>Has ingresado el código de factura: <strong><?php echo $codigo_factura; ?></strong></p>
        
        <?php if ($factura !== null): ?>
            <p>Detalles de la factura:</p>
            <ul>
                <li>Código: <?php echo $factura['codigo']; ?></li>
                <li>Total: <?php echo $factura['total']; ?></li>
                <li>Fecha: <?php echo $factura['fecha']; ?></li>
                <li>Usuario: <?php echo $factura['usuario']; ?></li>
                <li>Producto ID: <?php echo $factura['producto_id']; ?></li>
                <li>Estado: <?php echo $factura['estado']; ?></li>
            </ul>
            
            <p>¿Deseas confirmar o denegar esta factura?</p>
            <form method="POST" action="procesar_confirmacion.php">
                <input type="hidden" name="codigo" value="<?php echo $codigo_factura; ?>">
                <button type="submit" name="accion" value="confirmar">Confirmar Factura</button>
                <button type="submit" name="accion" value="denegar">Denegar Factura</button>
            </form>
        <?php else: ?>
            <p class="error"><?php echo isset($mensaje_error) ? $mensaje_error : ''; ?></p>
        <?php endif; ?>
    <?php else: ?>
        <p class="error">No se proporcionó un código de factura.</p>
    <?php endif; ?>

    <a href="panel_usuario.php">Volver al Panel de Usuario</a>
</body>
</html>
