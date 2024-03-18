<?php
require_once('conexion.php');
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
$sql = "SELECT id_producto, nombre_producto, precio_producto, descripcion,imagen FROM productos";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Productos disponibles</title>
    <link rel="stylesheet" href="css/productos.css?v=<?php echo(rand()); ?>">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Ir al inicio</a></li>
            </ul>
        </nav>
    </header>
    <h1>PRODUCTOS DISPONIBLES</h1>
    <div class= "fondo">
        <img src="imagenes/fondo3.jpg" alt="Postres">
    </div>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["nombre_producto"] . "</td>";
                echo "<td>$" . $fila["precio_producto"] . "</td>";
                echo "<td>" . $fila["descripcion"] . "</td>";
                echo "<td class='fotos'><img src='" . $fila["imagen"] . "' alt='Imagen' ></td>";
                echo "<td class='botones'>
                    <form method='post' action='realizar_pedidos.php'>
                        <input type='hidden' name='Comprar' value='" . $fila["id_producto"] . "'>
                        <input type='submit' value='Comprar'>
                    </form>
                </td>";
                echo "</tr>";
                
            }
        } else {
            echo "No hay registros en la base de datos.";
        }
        ?>
        
        </tbody>
    </table>
    <a href="cerrar_sesion.php"> Cerrar sesión</a>
</body>
</html>
