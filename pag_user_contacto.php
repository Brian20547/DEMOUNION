<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Shop - Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        header {
            background-color: #003366; /* Azul oscuro */
            color: white;
            padding: 15px 20px;
            text-align: center;
        }
        main {
            padding: 20px;
        }
        .contact-form {
            max-width: 600px;
            width: 100%;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin: auto; /* Centra el formulario horizontalmente */
        }
        .contact-form h2 {
            margin-top: 0;
            color: #003366; /* Azul oscuro para el título */
        }
        .contact-form input,
        .contact-form textarea,
        .contact-form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .contact-form button {
            background-color: #003366; /* Azul oscuro para el botón */
            color: white;
            border: none;
            cursor: pointer;
        }
        .contact-form button:hover {
            background-color: #002244; /* Azul aún más oscuro para el hover */
        }
    </style>
</head>
<body>

<header>
    <h1>PC Shop</h1>
    <p>Tu mejor opción para computadoras y accesorios.</p>
</header>

<main>
    <div class="contact-form">
        <h2>Contáctanos</h2>
        <form action="pag_confi.php" method="POST">
            <input type="text" name="name" placeholder="Tu Nombre" required>
            <input type="text" name="telefono" placeholder="Tu Teléfono" required>
            <input type="email" name="email" placeholder="Tu Correo Electrónico" required>
            <textarea name="direccion" rows="5" placeholder="Tu Mensaje " required></textarea>
            <button type="submit">Enviar</button>
        </form>
    </div>
</main>

</body>
</html>
