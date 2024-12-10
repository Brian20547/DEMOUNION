listo aqui le agregas el nombre de x registrado - <?php
session_start();

// Datos de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nombre_de_la_base_de_datos"; // Cambia esto por tu base de datos real

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Eliminar producto si se ha solicitado
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Obtener el ID del producto a eliminar
    $delete_sql = "DELETE FROM productos WHERE id = $delete_id";

    if ($conn->query($delete_sql) === TRUE) {
        echo "Producto eliminado correctamente.";
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}

// Consulta para obtener todos los productos
$sql = "SELECT * FROM productos"; // Asegúrate de que la tabla se llama 'productos'
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Productos</title>
  <link rel="stylesheet" href="../assets/css/style.css"> <!-- Asegúrate de que la ruta sea correcta -->
  <style>
    /* Estilos CSS para la página */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 20px;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
    }

    nav ul li {
      margin-left: 20px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
    }

    .hero-section {
      background-color: #f5f5f5;
      padding: 60px 20px;
      text-align: center;
    }

    .hero-content {
      max-width: 800px;
      margin: 0 auto;
    }

    .product-section {
      padding: 40px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f5f5f5;
    }

    footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 20px;
    }

    img {
      max-width: 100px; /* Tamaño de la imagen en la tabla */
      height: auto;     /* Mantiene la proporción */
    }
  </style>
</head>
<body>
  <header>
    <nav>
      <div class="logo">Lista de Productos</div>
      <ul>
      <li><a href="pag_admin.php">Inicio</a></li>
        <li><a href="pag_codigo.php">Códigos</a></li>
        <li><a href="../../UNION/factura1.php">panel</a></li>
        <li><a href="pag_producto.php">Producto</a></li>
        <li><a href="../../UNION/aggproductoX.html">Agregar Producto</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="hero-section">
      <div class="hero-content">
        <h1>Productos Registrados</h1>
        <p>Lista de productos de la base de datos.</p>
      </div>
    </section>

    <section class="product-section">
      <div class="product-container">
        <?php
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>";

            // Salida de cada fila de datos
            while ($fila = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($fila["id"]) . "</td>
                        <td>" . htmlspecialchars($fila["nombre"]) . "</td>
                        <td>$" . htmlspecialchars($fila["precio"]) . "</td>
                        <td><img src='../productos/" . htmlspecialchars($fila["imagen"]) . "' alt='" . htmlspecialchars($fila["nombre"]) . "'></td>
                        <td>" . htmlspecialchars($fila["descripcion"]) . "</td>
                        <td>
                            <a href='?delete_id=" . htmlspecialchars($fila["id"]) . "' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este producto?');\">Eliminar</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No hay productos disponibles.";
        }
        ?>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2024 Lista de Productos. Todos los derechos reservados.</p>
  </footer>
</body>
</html>