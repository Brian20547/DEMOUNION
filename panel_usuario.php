<?php
session_start();
include './conexionpro.php';

$codigo_factura = null; // Variable para almacenar el código de factura

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $sql = "SELECT * FROM facturas WHERE codigo='$codigo'"; // Obtener todos los datos de la factura
    $result = mysqli_query($con, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $factura = mysqli_fetch_assoc($result);
        $codigo_factura = $factura['codigo']; // Almacenar el código de factura
    } else {
        $mensaje_error = 'Factura no encontrada.';
    }

    // Redirigir a la página de confirmación si se encuentra la factura
    if (isset($codigo_factura)) {
        header("Location: confirmar_factura.php?codigo=$codigo_factura");
        exit(); // Terminar el script después de la redirección
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
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
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 50px;
        }
        label {
            font-size: 18px;
            margin-bottom: 10px;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 250px;
            margin-bottom: 20px;
            border: 2px solid #fff;
            border-radius: 5px;
            background-color: #2a3d56;
            color: #fff;
        }
        button {
            padding: 10px 20px;
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
        h2 {
            text-align: center;
            color: #ff3333;
        }
    </style>
</head>
<body>
    <h1>Panel de Usuario</h1>
    <form method="POST">
        <label for="codigo">Ingresa tu código de factura:</label>
        <input type="text" name="codigo" id="codigo" required>
        <button type="submit">Verificar Estado</button>
    </form>
    
    <?php if (isset($mensaje_error)): ?>
        <h2><?php echo $mensaje_error; ?></h2>
    <?php endif; ?>
</body>
</html>
