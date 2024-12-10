<?php
session_start(); // Inicia la sesión
require 'conexion.php'; // Archivo de conexión a la base de datos

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redirige si no está autenticado
    exit();
}

// Manejo del cambio de contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Validar que las contraseñas coincidan
    if ($nueva_contrasena !== $confirmar_contrasena) {
        $mensaje_error = "Las contraseñas no coinciden.";
    } else {
        // Actualizar la contraseña en la base de datos
        $sql = "UPDATE login SET pass = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([password_hash($nueva_contrasena, PASSWORD_DEFAULT), $usuario_id]);
        
        // Mensaje de éxito
        $mensaje_exito = "Contraseña cambiada exitosamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 300px;
            margin: auto;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .mensaje {
            margin: 10px 0;
            color: red;
        }
        .exito {
            color: green;
        }
    </style>
</head>
<body>
    <h1>Cambiar Contraseña</h1>
    
    <?php if (isset($mensaje_error)): ?>
        <div class="mensaje"><?php echo htmlspecialchars($mensaje_error); ?></div>
    <?php endif; ?>
    
    <?php if (isset($mensaje_exito)): ?>
        <div class="exito"><?php echo htmlspecialchars($mensaje_exito); ?></div>
    <?php endif; ?>

    <form method="POST">
        <label for="nueva_contrasena">Nueva Contraseña:</label>
        <input type="password" name="nueva_contrasena" required>
        
        <label for="confirmar_contrasena">Confirmar Contraseña:</label>
        <input type="password" name="confirmar_contrasena" required>
        
        <input type="submit" value="Cambiar Contraseña">
    </form>
</body>
</html>