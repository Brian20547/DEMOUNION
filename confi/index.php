<?php
require 'config/database.php';

$db = new Database();
$con = $db->conectar();

// Asegúrate de que las columnas que seleccionas existen en la tabla producto1
$sql = $con->prepare("SELECT id, nombre, descripcion FROM producto1 WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

// Mostrar resultados
foreach ($resultado as $producto) {
    echo "ID: " . $producto['id'] . " - Nombre: " . $producto['nombre'] . " - Descripción: " . $producto['descripcion'] . "<br>";
}
?>