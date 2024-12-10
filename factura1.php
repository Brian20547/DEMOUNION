<?php
session_start();
include './conexionpro.php';

// Consultar todas las facturas
$sql_facturas = "SELECT * FROM facturas";
$result_facturas = mysqli_query($con, $sql_facturas);

// Obtener el nombre del usuario de la sesión
$nombre_usuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212; /* Fondo oscuro */
            color: #ffffff; /* Texto claro */
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #1e1e2f; /* Azul oscuro */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        h1, h2 {
            color: #f1f1f1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #444;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #292a3e; /* Azul más oscuro */
            color: #ffffff;
        }

        td {
            background-color: #212131; /* Azul oscuro */
        }

        .boton-volver {
            background-color: #005f73; /* Azul oscuro */
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
        }

        .boton-volver:hover {
            background-color: #0a9396; /* Azul más claro */
        }

        .estado-pendiente {
            color: orange;
            font-weight: bold;
        }

        .estado-confirmado {
            color: #00b4d8;
            font-weight: bold;
        }

        .estado-pagado {
            color: #2dc653;
            font-weight: bold;
        }

        .estado-cancelado {
            color: #e63946;
            font-weight: bold;
        }

        button {
            background-color: #005f73; /* Azul oscuro */
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0a9396; /* Azul más claro */
        }

        p {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Facturas</h1>
        
        <h2>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?>!</h2>

        <!-- Botones -->
        <a class="boton-volver" href="http://localhost/UNION/USADMIN/pag_admin.php">Volver al Panel de Usuario</a>
        <a class="boton-volver" href="http://localhost/UNION/panel_usuario.php">Buscar factura</a>

        <?php if (mysqli_num_rows($result_facturas) > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Producto ID</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                <?php while ($factura = mysqli_fetch_assoc($result_facturas)): ?>
                    <tr>
                        <td><?php echo $factura['id']; ?></td>
                        <td><?php echo $factura['codigo']; ?></td>
                        <td><?php echo $factura['total']; ?></td>
                        <td><?php echo $factura['fecha']; ?></td>
                        <td><?php echo $factura['usuario']; ?></td>
                        <td><?php echo $factura['producto_id']; ?></td>
                        <td class="<?php echo 'estado-' . strtolower($factura['estado']); ?>">
                            <?php echo ucfirst($factura['estado']); ?>
                        </td>
                        <td>
                            <?php if ($factura['estado'] == 'pendiente'): ?>
                                <form action="procesar_confirmacion.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="codigo" value="<?php echo $factura['codigo']; ?>">
                                    <button type="submit" name="accion" value="confirmar">Confirmar</button>
                                </form>
                                <form action="procesar_confirmacion.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="codigo" value="<?php echo $factura['codigo']; ?>">
                                    <button type="submit" name="accion" value="denegar">Denegar</button>
                                </form>
                            <?php else: ?>
                                <span>Acción no disponible</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No hay facturas registradas.</p>
        <?php endif; ?>
    </div>
</body>
</html>
