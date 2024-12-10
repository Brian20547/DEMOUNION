<?php
// Incluir conexión a la base de datos
include './conexionpro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $latitud = isset($_POST['latitud']) ? trim($_POST['latitud']) : '';
    $longitud = isset($_POST['longitud']) ? trim($_POST['longitud']) : '';
    $lugar_envio = isset($_POST['lugar_envio']) ? trim($_POST['lugar_envio']) : '';

    // Verificar que todos los campos estén llenos
    if ($latitud !== '' && $longitud !== '' && $lugar_envio !== '') {
        // Preparar la consulta para insertar en la base de datos
        $sql = "INSERT INTO ubicacion (Latitud, Longitud, Lugar_de_Envio) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);

        if ($stmt) {
            // Vincular los parámetros
            $stmt->bind_param('sss', $latitud, $longitud, $lugar_envio);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Redirigir a la página de confirmación con el nuevo mensaje
                header("Location: confirmar_ubicacion.php?mensaje=Compra en línea, comuníquese por WhatsApp");
                exit(); // Asegurarse de que el script se detenga después de redirigir
            } else {
                echo "Error al guardar la ubicación: " . $stmt->error;
            }

            // Cerrar el statement
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $con->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

// Cerrar la conexión
$con->close();
?>
