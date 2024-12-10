<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Ubicación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            padding: 50px;
        }
        .message {
            font-size: 20px;
            color: #333;
            padding: 20px;
            background-color: #e7f4e4;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            display: inline-block;
        }
        .whatsapp {
            color: #25d366;
            font-size: 18px;
            text-decoration: none;
            display: block;
            margin-top: 15px;
        }
        .whatsapp:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="message">
        <?php
        if (isset($_GET['mensaje'])) {
            echo htmlspecialchars($_GET['mensaje']);
        } else {
            echo "No se recibió un mensaje.";
        }
        ?>
    </div>
    <a class="whatsapp" href="https://wa.me/1234567890" target="_blank">Comuníquese por WhatsApp</a>
</body>
</html>
