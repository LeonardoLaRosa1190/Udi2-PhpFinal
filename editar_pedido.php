<?php
require_once('conexion.php');
session_start();

$idUsuario = $_SESSION['id_usuario'];

$sql = "SELECT id_pedido, cant_pedido, fecha_pedido, hora_pedido,observaciones, nombre_producto, precio_producto 
FROM pedidos 
INNER JOIN productos ON pedidos.id_producto = productos.id_producto 
WHERE id_usuario = '$idUsuario' ORDER BY id_pedido DESC LIMIT 1" ;
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pedido</title>
    <link rel="stylesheet" href="css/editar_pedido.css?v=<?php echo(rand()); ?>">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="pedidos_realizados.php">Volver al pedido</a></li>
            </ul>
        </nav>
    </header>
    <h1>EDITAR EL PEDIDO</h1>
    <div class= "fondo">
        <img src="imagenes/fondo6.jpg" alt="Postres">
    </div>
    <table>
        <thead>
        <tr>
            <th>Nombre del producto</th>
            <th>Precio</th>
        </tr>
        </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        $cant_pedido = $fila["cant_pedido"];
                        $fecha_pedido = $fila["fecha_pedido"];
                        $hora_pedido = $fila["hora_pedido"];
                        $observaciones = $fila["observaciones"];
                        echo "<tr>";
                        echo "<td>" . $fila["nombre_producto"] . "</td>";
                        echo "<td>$" . $fila["precio_producto"] . "</td>";
                        echo "</tr>";  
                    }
                }
                ?>
            </tbody>
    </table>     
    <form method="post" action="editar_pedido_guardar.php">
        <label for="cant_pedido">Cant en Kg:</label>
        <input type="number" name="cant_pedido" required min="0" max="10" step="0.25" value="<?php echo $cant_pedido; ?>" />

        <label for="fecha_pedido">Fecha de retiro:</label>
        <input type="date" name="fecha_pedido" required value="<?php echo $fecha_pedido; ?>"><br>

        <label for="hora_pedido">Horario de retiro:</label>
        <input type="time" name="hora_pedido" required value="<?php echo $hora_pedido; ?>"><br>
        
        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones" cols="40" rows="5" required placeholder="Ingresa tus observaciones aquí..."><?php echo $observaciones; ?></textarea>
        
        <input type='submit' value='Editar'>
    </form>
    <a href="borrar_pedido.php" class = "borrar">Cancelar pedido</a>
</body>
</html>
