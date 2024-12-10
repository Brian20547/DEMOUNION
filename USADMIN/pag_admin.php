<?php 
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html'); // Redirigir al inicio de sesión si no hay sesión iniciada
    exit;
}

// Datos de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nombre_de_la_base_de_datos"; // Cambia esto por el nombre de tu base de datos real

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los usuarios
$sql = "SELECT * FROM login";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Usuarios</title>
  <link rel="stylesheet" href="assets/css/style.css"> <!-- Asegúrate de que la ruta del CSS sea correcta -->
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
      margin-top: 20px;
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
  </style>
</head>
<body>
  <header>
    <nav>
      <div class="logo">Admin Panel</div>
      <ul>
        <li><a href="pag_admin.php">Inicio</a></li>
        <li><a href="pag_codigo.php">Códigos</a></li>
        <li><a href="../../UNION/factura1.php">panel</a></li>
        <li><a href="pag_producto.php">Producto</a></li>
        <li><a href="../../UNION/aggproductoX.html">Agregar Producto</a></li>
      </ul>
    </nav>
    <!-- Mostrar el nombre del usuario que ha iniciado sesión -->
    <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</p>
  </header>

  <main>
    <section class="hero-section">
      <div class="hero-content">
        <h1>Usuarios Registrados</h1>
        <p>Lista de usuarios registrados en la base de datos.</p>
      </div>
    </section>

    <section class="product-section">
      <div class="product-container">
        <?php
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                    </tr>";

            // Salida de cada fila de datos
            while ($fila = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($fila["usuario"]) . "</td>
                        <td>" . htmlspecialchars($fila["pass"]) . "</td>
                        <td>" . htmlspecialchars($fila["rol"]) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay usuarios disponibles.</p>";
        }
        ?>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2024 Lista de Usuarios. Todos los derechos reservados.</p>
  </footer>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
