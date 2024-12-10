<?php
session_start();
include './conexionpro.php'; // Conexión a la base de datos

// Verificar si el carrito existe
if (isset($_SESSION['carrito'])) {
    $total = 0;
    $carrito = $_SESSION['carrito'];

    // Calcular el total de la compra
    for ($i = 0; $i < count($carrito); $i++) {
        $total += $carrito[$i]['precio'] * $carrito[$i]['cantidad'];
    }

    // Generar un código único para la factura
    $codigo_factura = strtoupper(uniqid('FAC')); // Genera un código único, ej: FAC5f5b1f3a4e

    // Obtener la fecha actual
    $fecha = date('Y-m-d H:i:s');

    // Verificar si el usuario está registrado
    if (isset($_SESSION['usuario'])) {
        $nombre_usuario = $_SESSION['usuario']; // Suponiendo que el nombre del usuario se guarda en la sesión
    } else {
        $nombre_usuario = "No registrado"; // Si no hay usuario en la sesión
    }

    // Insertar los datos de la factura en la base de datos
    $sql = "INSERT INTO facturas (codigo, total, fecha, usuario) VALUES ('$codigo_factura', '$total', '$fecha', '$nombre_usuario')";

    // Ejecutar la consulta
    if (mysqli_query($con, $sql)) {
        // Factura generada y almacenada correctamente
        echo "<h2>Factura generada con éxito</h2>";
        echo "<p>Código de factura: <strong>$codigo_factura</strong></p>";
        echo "<p>Usuario: <strong>$nombre_usuario</strong></p>"; // Mostrar nombre del usuario
        echo "<p>Total a pagar: <strong>$$total</strong></p>";

        // Aquí podrías generar el PDF o continuar con el proceso
        // Redirigir o mostrar los detalles de la factura

    } else {
        // Si ocurre un error al guardar en la base de datos
        echo "<h2>Error al generar la factura</h2>";
        echo "Error: " . mysqli_error($con);
    }

} else {
    echo "<h2>No hay productos en el carrito</h2>";
}
?>