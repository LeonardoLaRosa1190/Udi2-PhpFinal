<?php
require_once('conexion.php');
session_start();

if (isset($_SESSION['id_pedido'])) {
    $id_pedido = $_SESSION['id_pedido'];

    $sql_autoincrement = "SELECT id_pedido FROM pedidos WHERE id_pedido = '$id_pedido'";
    $result_autoincrement = $conn->query($sql_autoincrement);

    if ($result_autoincrement->num_rows > 0) {

        $fila = $result_autoincrement->fetch_assoc();
        $actual_autoincrement = $fila["id_pedido"];


        $sql = "DELETE FROM pedidos WHERE id_pedido='$id_pedido'";
        
        if ($conn->query($sql) === TRUE) {

            $sql_autoreset = "ALTER TABLE pedidos AUTO_INCREMENT = $actual_autoincrement";
            $conn->query($sql_autoreset);

            header("Location: cerrar_sesion.php");
        } else {
            echo "Error al cancelar el pedido: " . $conn->error;
        }
    } else {
        echo "No se encontró el pedido en la base de datos.";
    }
} else {
    echo "ID de compra no proporcionado.";
}
?>


