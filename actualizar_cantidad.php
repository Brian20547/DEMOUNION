<?php
session_start();

if (isset($_GET['id']) && isset($_GET['cantidad'])) {
    $id = $_GET['id'];
    $cantidad = (int)$_GET['cantidad'];

    if ($cantidad > 0 && isset($_SESSION['carrito'])) {
        $arreglo = $_SESSION['carrito'];

        // Buscar el producto por su ID y actualizar la cantidad
        for ($i = 0; $i < count($arreglo); $i++) {
            if ($arreglo[$i]['id'] == $id) {
                $arreglo[$i]['cantidad'] = $cantidad;
                $_SESSION['carrito'] = $arreglo;
                echo "Cantidad actualizada";
                break;
            }
        }
    } else {
        echo "Error: Cantidad no válida o carrito no existente.";
    }
} else {
    echo "Error: Falta ID o cantidad.";
}
?>