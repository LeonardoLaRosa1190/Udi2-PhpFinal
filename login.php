<?php
require('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Verificar si el usuario existe y obtener su contraseña hash
    $sql = "SELECT id_usuario, usuario, contrasena,correo_electronico FROM usuarios WHERE usuario = '$usuario'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row['contrasena'])) {
            session_start();
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['correo_electronico'] = $row['correo_electronico'];
            header("Location: productos.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuarios</title>
    <link rel="stylesheet" href="css/login.css?v=<?php echo(rand()); ?>">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Ir al inicio</a></li>
            </ul>
        </nav>
    </header>
    <h2>INICIAR SESIÓN</h2>
    <div class= "fondo">
        <img src="imagenes/fondo.jpg" alt="Postres">
    </div>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    <form method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required><br>

        <input type="submit" value="Iniciar sesión">
    </form>
    <p>¿No tenes una cuenta?</p>
    <a href="registro.php"> ¡Registrate acá!</a>
</body>
</html>
