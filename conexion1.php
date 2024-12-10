<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nombre_de_la_base_de_datos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $stock = intval($_POST['stock']); // Convertir a entero el stock

    // Manejo de la imagen
    $target_dir1 = __DIR__ . "/imagen/";
    $target_dir2 = __DIR__ . "/productos/";
    
    $target_file1 = $target_dir1 . basename($nuevo_nombre) . ".jpg";
    $target_file2 = $target_dir2 . basename($nuevo_nombre) . ".jpg";
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
    $mensaje = "";

    // Verificar si la imagen es un archivo real
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $mensaje = "El archivo no es una imagen.";
            $uploadOk = 0;
        }
    }

    // Verificar si el archivo ya existe en la primera carpeta
    if (file_exists($target_file1)) {
        $mensaje = "Lo siento, el archivo ya existe en la primera carpeta.";
        $uploadOk = 0;
    }

    // Limitar el tamaño del archivo (5MB)
    if ($_FILES["imagen"]["size"] > 5000000) {
        $mensaje = "Lo siento, tu archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de archivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $mensaje = "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    // Verificar si $uploadOk está en 0
    if ($uploadOk == 0) {
        mostrarMensaje($mensaje, "error");
    } else {
        // Subir el archivo a la primera carpeta
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file1)) {
            // Copiar el archivo a la segunda carpeta
            if (copy($target_file1, $target_file2)) {
                // Guardar la información en la base de datos
                $sql = "INSERT INTO productos (nombre, precio, descripcion, imagen, stock) 
                        VALUES ('$nombre', '$precio', '$descripcion', '" . basename($nuevo_nombre) . ".jpg', '$stock')";
                if ($conn->query($sql) === TRUE) {
                    mostrarMensaje("Nuevo producto agregado exitosamente.", "exito");
                } else {
                    mostrarMensaje("Error: " . $sql . "<br>" . $conn->error, "error");
                }
            } else {
                mostrarMensaje("Error al copiar la imagen a la segunda carpeta.", "error");
            }
        } else {
            mostrarMensaje("Hubo un error al subir tu archivo a la primera carpeta.", "error");
        }
    }
}

$conn->close();

/**
 * Muestra un mensaje estilizado y un botón para regresar.
 *
 * @param string $mensaje El mensaje a mostrar.
 * @param string $tipo Puede ser "exito" o "error".
 */
function mostrarMensaje($mensaje, $tipo) {
    $color = $tipo === "exito" ? "#2dc653" : "#e63946"; // Verde para éxito, rojo para error.
    $botonColor = $tipo === "exito" ? "#005f73" : "#b00020"; // Botón azul oscuro o rojo.
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultado</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #121212;
                color: #ffffff;
                text-align: center;
                margin: 0;
                padding: 20px;
            }
            .mensaje {
                margin-top: 20px;
                padding: 20px;
                background-color: $color;
                border-radius: 8px;
                display: inline-block;
                color: white;
                font-size: 18px;
                max-width: 80%;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }
            .boton-volver {
                margin-top: 20px;
                background-color: $botonColor;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
            }
            .boton-volver:hover {
                background-color: #0a9396;
            }
        </style>
    </head>
    <body>
        <div class="mensaje">
            $mensaje
        </div>
        <br>
        <a class="boton-volver" href="javascript:history.back()">Volver</a>
    </body>
    </html>
    HTML;
}
?>
