<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y validar los datos del formulario
    $nombre = $_POST['nombre'];
    $tarjeta = $_POST['tarjeta'];
    $fecha = $_POST['fecha'];
    $cvv = $_POST['cvv'];

    // Aquí puedes agregar lógica para validar el pago,
    // como llamar a una API de pago (por ejemplo, Stripe, PayPal, etc.)

    // Simulación de un pago exitoso
    $pago_exitoso = true; // Cambia esto según la lógica real de validación

    if ($pago_exitoso) {
        // Aquí se generaría la factura
        // Se pueden enviar datos a una página que genera la factura PDF

        // Por ejemplo, puedes redirigir a una página de éxito
        header("Location: factura_pdf.php");
        exit;
    } else {
        echo "Error al procesar el pago. Por favor, intenta nuevamente.";
    }
} else {
    header("Location: carrito.php"); // Redirigir si no se accede a esta página correctamente
    exit;
}
?>