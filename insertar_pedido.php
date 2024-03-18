<?php
require_once('conexion.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fecha_pedido'])) {

    $cant_pedido = $_POST['cant_pedido'];
    $fecha_pedido = $_POST['fecha_pedido'];
    $hora_pedido = $_POST['hora_pedido'];
    $observaciones = $_POST['observaciones'];

    if (isset($_SESSION['idProducto'])) {
        $idProducto = $_SESSION['idProducto'];
        $idUsuario = $_SESSION['id_usuario'];
    } else {
        echo "Error: No se ha especificado el producto.";
    }

    $sqlAgregarProducto = "INSERT INTO pedidos (cant_pedido,fecha_pedido,hora_pedido, id_producto,observaciones,id_usuario) VALUES ('$cant_pedido','$fecha_pedido','$hora_pedido','$idProducto','$observaciones','$idUsuario')";
    $conn->query($sqlAgregarProducto);
    header("Location: pedidos_realizados.php");
    exit();
}
?>
