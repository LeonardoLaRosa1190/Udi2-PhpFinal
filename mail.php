<?php
require_once('conexion.php');
session_start();

$idUsuario = $_SESSION['id_usuario'];

$sql = "SELECT id_pedido, cant_pedido, fecha_pedido, hora_pedido,observaciones, nombre_producto, precio_producto 
FROM pedidos 
INNER JOIN productos ON pedidos.id_producto = productos.id_producto 
WHERE id_usuario = '$idUsuario' ORDER BY id_pedido DESC LIMIT 1";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $total = $fila["cant_pedido"] * $fila["precio_producto"];
        $cant_pedido = $fila["cant_pedido"];
        $fecha_pedido = $fila["fecha_pedido"];
        $hora_pedido = date_format(new DateTime($fila["hora_pedido"]), 'H:i');
        $nombre_producto = $fila["nombre_producto"];
        $observaciones = $fila["observaciones"];
    }  
}

$mensaje_mail = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
        }
     table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #f4f4f4;
                }

    thead {
    background-color: #fd8da0;
    color: #fff;
}

    th {
    border: 0px;
    padding: 20px;
    text-align: left;
}
    td {
    border: 1px solid #ff3939;
    padding: 20px;
    text-align: left;
}

h2 {
    font-size: 50px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
}
h2 .nombre-usuario {
    color: #fb3a5a; 
}
h3{
    font-size: 35px;
    font-weight: bold;
    margin-bottom: 10px;
    text-align: center;
}
    </style>
</head>
<body>
    <h2>GRACIAS <span class="nombre-usuario"> {$_SESSION['usuario']} </span></h2>
    <H3>SU PEDIDO:</H3>
    <table>
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>Fecha de entrega</th>
                <th>Hora de entrega</th>
                <th>Producto</th>
                <th>Observaciones</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{$cant_pedido} Kg</td>
                <td>{$fecha_pedido}</td>
                <td>{$hora_pedido} hs</td>
                <td>{$nombre_producto}</td>
                <td>{$observaciones}</td>
                <td>\${$total}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
HTML;
?>
