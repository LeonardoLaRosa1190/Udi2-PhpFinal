<?php
require('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $nombre_apellido = $_POST['nombre_apellido'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];
    // Verificar si el usuario ya existe
    $sql = "SELECT id_usuario FROM usuarios WHERE usuario = '$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error = "El usuario ya existe.";
    } else {
        // Hash de la contraseña
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (usuario, contrasena,nombre_apellido,telefono,correo_electronico) VALUES ('$usuario', '$contrasena_hash','$nombre_apellido','$telefono','$correo_electronico')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Usuario registrado con éxito.";
        } else {
            $error = "Error al registrar el usuario: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="css/registro.css?v=<?php echo(rand()); ?>">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Ir al inicio</a></li>
            </ul>
        </nav>
    </header>
    <h2>REGISTRAR USUARIO</h2>
        <div class= "fondo">
            <img src="imagenes/fondo2.jpg" alt="Postres">
        </div>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    <?php if (isset($mensaje)) { echo "<p class='success'>$mensaje</p>"; } ?>
    <form method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required><br>

        <label for="nombre_apellido">Nombre y Apellido:</label>
        <input type="text" name="nombre_apellido" required><br>

        <label for="telefono">Telefono:</label>
        <input type="tel" name="telefono" required><br>

        <label for="correo_electronico">Email:</label>
        <input type="email" name="correo_electronico" required><br>

        <input type="submit" value="Registrar">
    </form>
    <p>¿Tenes una cuenta?</p>
    <a href="login.php">Ingresá</a>
</body>
</html>
