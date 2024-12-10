<?php
session_start();
require('fpdf/fpdf.php');
include './conexionpro.php'; // Conexión a la base de datos

// Si no hay carrito, redirigir al catálogo
if (!isset($_SESSION['carrito'])) {
    header("Location: compra.php");
    exit();
}

// Generar un código único para la factura
$codigo_factura = strtoupper(uniqid('FAC')); // Código tipo 'FAC1234abcd'
$fecha = date('Y-m-d H:i:s'); // Fecha actual

// Calcular el total
$total = 0;
$datos = $_SESSION['carrito'];

// Almacenar detalles de los productos
$producto_ids = []; // Para almacenar los IDs de los productos
$estado = 'pendiente'; // Estado de la factura

// Calcular el total de la compra y recopilar IDs de productos
foreach ($datos as $producto) {
    $total += $producto['precio'] * $producto['cantidad'];
    $producto_ids[] = $producto['id']; // Suponiendo que el producto tiene un campo 'id'
}

// Convertir el array de IDs a una cadena separada por comas (opcional)
$producto_id_str = implode(',', $producto_ids);

// Insertar la factura en la base de datos
$sql = "INSERT INTO facturas (codigo, total, fecha, usuario, producto_id, estado) 
        VALUES ('$codigo_factura', '$total', '$fecha', '{$_SESSION['usuario']}', '$producto_id_str', '$estado')";

// Ejecutar la consulta para guardar en la base de datos
if (!mysqli_query($con, $sql)) {
    die("Error al guardar la factura en la base de datos: " . mysqli_error($con));
}

// Crear el PDF de la factura
class PDF extends FPDF
{
    // Encabezado de la factura
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Verificacion de Compra', 0, 1, 'C');
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Instanciar la clase PDF y agregar una página
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Mostrar el código de la factura y fecha
$pdf->Cell(0, 10, 'Codigo: ' . $codigo_factura, 0, 1, 'R');
$pdf->Cell(0, 10, 'Fecha: ' . $fecha, 0, 1, 'R');
$pdf->Ln(10);

// Mensaje sobre la importancia de la factura
$pdf->SetFont('Arial', 'I', 10);
$pdf->MultiCell(0, 10, "No pierda esta Verificacion, ya que con el Codigo  usted realiza la compra.", 0, 'C');
$pdf->Ln(5);

// Cambiar a la fuente normal para los detalles de la compra
$pdf->SetFont('Arial', '', 12);

// Encabezado de la tabla
$pdf->Cell(50, 10, 'Producto', 1);
$pdf->Cell(40, 10, 'Precio Unitario', 1);
$pdf->Cell(30, 10, 'Cantidad', 1);
$pdf->Cell(40, 10, 'Total Producto', 1);
$pdf->Ln();

// Desglose de los productos
foreach ($datos as $producto) {
    $subtotal = $producto['precio'] * $producto['cantidad'];
    $pdf->Cell(50, 10, $producto['nombre'], 1);
    $pdf->Cell(40, 10, '$' . number_format($producto['precio'], 2), 1);
    $pdf->Cell(30, 10, $producto['cantidad'], 1);
    $pdf->Cell(40, 10, '$' . number_format($subtotal, 2), 1);
    $pdf->Ln();
}

// Total de la factura
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Total a Pagar: $' . number_format($total, 2), 0, 1, 'R');

// Agregar detalles del usuario si está registrado
if (isset($_SESSION['usuario'])) {
    $nombre_usuario = $_SESSION['usuario']; // Suponiendo que el nombre del usuario se guarda en la sesión
    $pdf->Ln(5);
    $pdf->Cell(0, 10, 'Usuario: ' . $nombre_usuario, 0, 1);
} else {
    $pdf->Cell(0, 10, 'Usuario: No registrado', 0, 1);
}

// Salida del PDF al navegador
$pdf->Output();
?>