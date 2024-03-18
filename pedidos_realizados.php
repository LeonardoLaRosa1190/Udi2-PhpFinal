<?php
require_once('conexion.php');
session_start();

$idUsuario = $_SESSION['id_usuario'];

$sql = "SELECT id_pedido, cant_pedido, fecha_pedido, hora_pedido,observaciones, nombre_producto, precio_producto 
FROM pedidos 
INNER JOIN productos ON pedidos.id_producto = productos.id_producto 
WHERE id_usuario = '$idUsuario' ORDER BY id_pedido DESC LIMIT 2" ;
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="pedidos_realizados.css?v=<?php echo(rand()); ?>">
</head>
<body>
<div class= "fondo">
        <img src="imagenes/fondo5.jpg" alt="Postres">
    </div>
    <h2>GRACIAS <span class="nombre-usuario"> <?php echo $_SESSION['usuario']; ?> </span></h2>
    <H3>SU PEDIDO:</H3>
    <link rel="stylesheet" href="css/pedidos_realizados.css">
    <table>
    <thead>
        <tr>
            <th>Cantidad</th>
            <th>Fecha de entrega</th>
            <th>Hora de entrega</th>
            <th>Producto</th>
            <th>Observaciones</th>
            <th>Total</th>
            <th></th>
        </tr>
    </thead>
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $_SESSION['id_pedido'] = $fila["id_pedido"]; 
                $total = $fila["cant_pedido"] * $fila["precio_producto"];
                echo "<tr>";
                echo "<td>" . $fila["cant_pedido"] . "  Kg</td>";
                echo "<td>" . $fila["fecha_pedido"] . "</td>";
                echo "<td>" . date_format(new DateTime($fila["hora_pedido"]), 'H:i') . " hs</td>";
                echo "<td>" . $fila["nombre_producto"] . "</td>";
                echo "<td>" . $fila["observaciones"] . "</td>";
                echo "<td>$" . $total . "</td>";
                echo "<td>
                <a href='editar_pedido.php'>Editar</a></td>";
                echo "</tr>";
            }
        }
        ?>
        <tbody>

    <a href="#" class="borrar" onclick="mostrarVentanaEmergenteBorrar()">Cancelar pedido</a>
    <a href="enviar_mail.php" class="finalizar" onclick="mostrarVentanaEmergente()">¡Finalizar pedido!</a>

    <script>
        function mostrarVentanaEmergente() {
            alert('¡Pedido finalizado con éxito!');
        }

        function mostrarVentanaEmergenteBorrar() {
            var confirmacion = confirm('¿Estás seguro que deseas cancelar el pedido?');
            if (confirmacion) {
                window.location.href = 'borrar_pedido.php';
            }
            return false;
        }
    </script>
</body>
</html>

