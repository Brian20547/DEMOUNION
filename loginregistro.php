<?php
include('conexion.php'); // Asegúrate de que este archivo contenga la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usu = $_POST["txtusuario"];
    $pass = $_POST["txtpassword"];
    $rol = $_POST["rol"];
    $correo = $_POST['txtcorreo'];
    $celular = $_POST['txtcelular'];

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO login (usuario, pass, rol, correo, celular) VALUES (?, ?, ?, ?, ?)");

    // Usamos "sssss" porque todos los parámetros son cadenas (strings)
    $stmt->bind_param("sssss", $usu, $pass, $rol, $correo, $celular);

    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso.'); window.location= 'index.html';</script>";
    } else {
        echo "<script>alert('Error al registrar.'); window.location= 'index.html';</script>";
    }

    $stmt->close();
}
?>
