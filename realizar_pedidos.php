<?php
require_once('conexion.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Comprar'])) {
    $idProducto = $_POST['Comprar'];
}
$sql = "SELECT nombre_producto, precio_producto FROM productos WHERE id_producto = '$idProducto'";
$resultado2 = $conn->query($sql);
$_SESSION['idProducto'] = $idProducto;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar pedidos</title>
    <link rel="stylesheet" href="css/realizar_pedidos.css?v=<?php echo(rand()); ?>">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Ir al inicio</a></li>
            </ul>
        </nav>
    </header>
    <h1>DATOS DEL PEDIDO</h1>
    <div class= "fondo">
        <img src="imagenes/fondo4.jpg" alt="Postres">
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
                if ($resultado2->num_rows > 0) {
                    while ($fila2 = $resultado2->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila2["nombre_producto"] . "</td>";
                        echo "<td>$" . $fila2["precio_producto"] . "</td>";
                        echo "</tr>";  
                    }
                }
                ?>
            </tbody>
    </table>     
    <form method="post" action="insertar_pedido.php">
        <label for="cant_pedido">Cant en Kg:</label>
        <input type="number" name="cant_pedido" required min="0" max="10" step="0.25" value="0.00" />

        <label for="fecha_pedido">Fecha de retiro:</label>
        <input type="date" name="fecha_pedido" required><br>

        <label for="hora_pedido">Horario de retiro:</label>
        <input type="time" name="hora_pedido" required><br>
        
        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones" cols="40" rows="5" required placeholder="Ingresa tus observaciones aquí..."></textarea>
        
        <input type='submit' value='Hacer pedido'>
    </form>
    <a href="cerrar_sesion.php"> Cerrar sesión</a>
</body>
</html>
