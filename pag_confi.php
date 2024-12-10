<?php
require 'config.php'; // Incluir la configuración de la base de datos

// Iniciar sesión para mostrar mensajes
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibimos los datos del formulario
    $nombre = isset($_POST['name']) ? trim($_POST['name']) : '';
    $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    // Validamos que los campos no estén vacíos
    if (!empty($nombre) && !empty($direccion) && !empty($telefono) && !empty($email)) {
        try {
            // Cambié el nombre de la tabla de "cliente" a "clientes"
            $sql = "INSERT INTO clientes (nombre, direccion, telefono, email) VALUES (:nombre, :direccion, :telefono, :email)";
            $stmt = $pdo->prepare($sql); // Preparamos la consulta

            // Ejecutamos la consulta con los datos del formulario
            $stmt->execute([
                ':nombre' => $nombre,
                ':direccion' => $direccion,
                ':telefono' => $telefono,
                ':email' => $email,
            ]);

            // Almacenamos el mensaje de éxito en la sesión
            $_SESSION['message'] = "Datos guardados correctamente.";

        } catch (Exception $e) {
            // Si ocurre un error, mostramos el mensaje de error
            $_SESSION['message'] = "Error al guardar los datos: " . $e->getMessage();
        }

    } else {
        // Si algún campo está vacío, mostramos el mensaje de error
        $_SESSION['message'] = "Todos los campos son obligatorios.";
    }

    // Redirigir a la página que muestra el resultado (por ejemplo, la misma página o una página de confirmación)
    header('Location: pag_user.php');
    exit();
}
?>