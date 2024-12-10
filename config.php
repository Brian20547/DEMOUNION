<?php
$host = "localhost"; // Nombre del servidor de base de datos
$dbname = "nombre_de_la_base_de_datos"; // Nombre de tu base de datos
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos (en XAMPP suele estar en blanco)

try {
    // Crear la conexión con PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar manejo de errores
} catch (PDOException $e) {
    // Si no se puede conectar, muestra el mensaje de error
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>