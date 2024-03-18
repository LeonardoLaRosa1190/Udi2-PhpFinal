<?php
require_once('conexion.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cant_pedido = $_POST["cant_pedido"];
        $fecha_pedido = $_POST["fecha_pedido"];
        $hora_pedido = $_POST["hora_pedido"];
        $observaciones = $_POST["observaciones"];

        $idPedido  = $_SESSION['id_pedido'];


$sql = "UPDATE pedidos SET  cant_pedido='$cant_pedido',
                            fecha_pedido='$fecha_pedido', 
                            hora_pedido='$hora_pedido', 
                            observaciones='$observaciones' WHERE id_pedido= $idPedido ";
if ($conn->query($sql) === TRUE) {
header("Location: pedidos_realizados.php");
} else {
echo "Error al actualizar el registro: " . $conexion->error;
}
}
?>