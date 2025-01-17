<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - PC Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> <!-- Fuente de Google -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #111111;
            color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #1f1f1f;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 36px;
            font-weight: bold;
        }

        nav {
            text-align: center;
            background-color: #222222;
            padding: 10px;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        nav a:hover {
            color: #29a19c;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #181818;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .container h2 {
            color: #29a19c;
            font-size: 32px;
            text-align: center;
            margin-bottom: 20px;
        }

        .section-content {
            margin-top: 20px;
        }

        .section-content h3 {
            color: #ffffff;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .section-content p {
            color: #bbbbbb;
            font-size: 16px;
            line-height: 1.6;
        }

        .team {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .team-member {
            background-color: #222222;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 30%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .team-member img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .team-member h4 {
            color: #ffffff;
            margin-bottom: 5px;
            font-size: 20px;
        }

        .team-member p {
            color: #bbb;
        }

        footer {
            background-color: #1f1f1f;
            text-align: center;
            padding: 15px 0;
            color: #bbb;
            margin-top: 30px;
        }

        footer a {
            color: #29a19c;
            text-decoration: none;
        }

        footer a:hover {
            color: #ffffff;
        }

        .cta-button {
            display: inline-block;
            background-color: #29a19c;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            margin-top: 20px;
        }

        .cta-button:hover {
            background-color: #27a09a;
        }
    </style>
</head>
<body>

<header>
    <h1>PC Shop - Sobre Nosotros</h1>
</header>

<nav>
    <a href="pag_user.php">Inicio</a>
</nav>

<div class="container">
    <h2>Conoce nuestra historia</h2>

    <div class="section-content">
        <h3>¿Quiénes somos?</h3>
        <p>En PC Shop nos apasiona la tecnología y el mundo de las computadoras. Somos una tienda especializada en ofrecer equipos de alta calidad, tanto para uso personal como profesional. Nuestra misión es brindar a nuestros clientes una experiencia única y personalizada, ayudándoles a encontrar El componente perfecta que se adapte a sus necesidades.</p>
    </div>

    <div class="section-content">
        <h3>Nuestra visión</h3>
        <p>Aspiramos a ser una de las principales tiendas de tecnología en el mercado, ofreciendo productos innovadores y soluciones tecnológicas de vanguardia. Nos comprometemos a brindar un servicio excepcional y productos que marquen la diferencia en la vida de nuestros clientes.</p>
    </div>

    <div class="section-content">
        <h3>Nuestro equipo</h3>
        <div class="team">
            <div class="team-member">
                <img src="assets/img/alex.jpg"  alt="Miembro 1">
                <h4>Juan Pérez</h4>
                <p>Fundador </p>
            </div>
            <div class="team-member">
                <img src="assets/img/Miguel.jfif"  alt="Miembro 2">
                <h4>Ana Gómez</h4>
                <p>Responsable de Soporte Técnico</p>
            </div>
            <div class="team-member">
                <img src="assets/img/seguro.jpg"  alt="Miembro 3">
                <h4>Carlos Martínez</h4>
                <p>Director de Ventas</p>
            </div>
        </div>
    </div>

</div>

<footer>
    <p>&copy; 2024 PC Shop. Todos los derechos reservados.</p>
    <p>Visítanos en <a href="https://www.instagram.com/pcshop" target="_blank">Instagram</a> | <a href="https://www.facebook.com/pcshop" target="_blank">Facebook</a></p>
</footer>

</body>
</html>
