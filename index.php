
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repostería La Rosa</title>
    <link rel="stylesheet" href="css/index.css?v=<?php echo(rand()); ?>">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <li><a href="productos.php">¡Hacenos tu pedido!</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="catalogo">
            <h1>Respostería La Rosa</h1>
            <p>¡Donde la tradición se fusiona con la creatividad para ofrecer experiencias irresistibles para los amantes del buen sabor!</p>
        </section>
        <section id="fotos">
            <div class="masas">
                <img src="imagenes/masas.jpg" alt="Masas Finas">
                <figcaption>Masas finas </figcaption>
                <p>Precio:<p2>$4200</p2> </p>
            </div>
            <div class="postres">
                <img src="imagenes/postre.jpg" alt="Postres">
                <figcaption>Postres artesanales</figcaption>
                <p>Precio:<p2>$3800</p2> </p>
            </div>
            <div class="tortas">
                <img src="imagenes/torta.jpg" alt="Tortas">
                <figcaption>Tortas</figcaption>
                <p>Precio:<p2>$3500</p2> </p>
            </div>
        </section>
    </main>

    <footer>
        <div id="datos-contacto">
            <p>Repostería La Rosa</p>
            <p>Dirección: Zuviría 5357, Rosario</p>
            <p>Teléfono: (341) 239-6398</p>
            <p>Correo Electrónico: pedidosreposterialarosa@gmail.com</p>
        </div>
    </footer>
</body>
</html>